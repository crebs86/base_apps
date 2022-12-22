<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\UserRequest;
use App\Mail\WelcomeUser;
use App\Models\UserUpdate;
use App\Traits\Helpers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use ACL, Helpers;
    /**
     * página inicial de controle de acesso de usuários
     */
    public function index(Request $request): Response
    {
        if ($this->can('ACL Editar', 'ACL Ver', 'ACL Criar', 'ACL Apagar', 'Usuario Editar', 'Usuario Ver', 'Usuario Criar', 'Usuario Apagar')) {
            if (!$request->user) {
                $users = User::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(10)->through(
                    function ($users) {
                        return $this->setUser($users);
                    }
                );
            } else {
                $users = $this->findUsers($request->user);
            }
            return Inertia::render('Admin/AclUsers', [
                'users' => $users ?? null,
                'keyword' => $request->user ?? ''
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Pesquisa por usuários na base de dados;
     * termos aproximados: name e email;
     * termos exatos: id e CPF.
     */
    private function findUsers(string $keyword): LengthAwarePaginator
    {
        $x = [
            'len' => strlen($keyword),
            'is_num' => is_numeric(str_replace('.', '', str_replace('-', '', $keyword)))
        ];
        if (!($x['is_num']) && $x['len'] < 4) {
            return [];
        }
        return User::select('id', 'name', 'email', 'cpf', 'deleted_at')
            ->where(
                function ($q) use ($keyword, $x) {
                    if ($x['is_num'] && $x['len'] < 11) {
                        return $q->where('id', str_replace('.', '', str_replace('-', '', $keyword)));
                    } elseif ($x['is_num'] && $x['len'] === 11) {
                        return $q->where('cpf', str_replace('.', '', str_replace('-', '', $keyword)));
                    }
                    return $q;
                }
            )
            ->orWhere(
                function ($q) use ($keyword, $x) {
                    if (!($x['is_num']) && $x['len'] >= 4) {
                        return $q->where('name', 'like', '%' . $keyword . '%');
                    }
                    return $q;
                }
            )
            ->orWhere(
                function ($q) use ($keyword, $x) {
                    if (!$x['is_num'] && $x['len'] >= 4) {
                        return $q->where('email', 'like', '%' . $keyword . '%');
                    }
                    return $q;
                }
            )
            ->withTrashed()
            ->paginate(50)->through(
                function ($user) {
                    return $this->setUser($user);
                }
            );
    }
    /**
     * lança dados da pesquisa do usuário em um array
     */
    private function setUser($user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cpf' => $user->cpf,
            'deleted_at' => $user->deleted_at
        ];
    }

    public function listUserAndRoles(Request $request)
    {
        return $this->showUserAndRoles($request);
    }
    /**
     * página exibe dados básicos do usuário e papéis vinculados a este
     */
    public function showUserAndRoles(Request $request): Response
    {
        if ($this->can('ACL Ver', 'ACL Editar')) {
            $userRoles = $this->getUserRoles($request->id);
            $allRoles = Role::orderBy('name')
                ->where(function ($q) {
                    if (!$this->hasRole(config('crebs86.admin_roles_edit'))) {
                        $a = [];
                        foreach (config('crebs86.admin_roles') as $v) {
                            $a[] = ['name', '<>', $v];
                        }
                        $q->where($a);
                    } else {
                        $q;
                    }
                })
                ->select(['id', 'name'])
                ->get()->toArray();

            $r = $userRoles->toArray();

            if (isset($r['roles'])) {
                $ur = $this->setCurrentRoles($allRoles, $r);
            }
            $edit = true;
            if ($userRoles->hasRole(config('crebs86.admin_roles'))) {
                $edit = $this->hasRole(config('crebs86.admin_roles_edit'));
            }

            return Inertia::render('Admin/UserRoles', [
                'user' => $userRoles,
                'userRoles' => $ur,
                'edit' => $edit,
                '_checker' => setGetKey($request->id, 'edit_user_role')
            ]);
        }
        return Inertia::render('Admin/403');
    }
    /**
     * define a situação de cada papél em relaçao ao usuário
     */
    private function setCurrentRoles($allRoles, $r): array
    {
        $ur = [];
        foreach ($allRoles as $ar) {
            $ur[] = [
                'id' => $ar['id'],
                'name' => $ar['name'],
                'has' => in_array(
                    $ar['id'],
                    array_column($r['roles'], 'id')
                ) ? true : false
            ];
        }
        return $ur;
    }
    /**
     * busca papeis de usuários
     */
    private function getUserRoles($id): User
    {
        return User::select('id', 'name', 'cpf', 'email')->where('id', $id)
            ->with(
                [
                    'roles' => function ($q) {
                        $q->select('id', 'name')->orderBy('id');
                    }
                ]
            )
            ->first();
    }
    /**
     * Sincroniza papéis dos usuários
     */
    public function editUserRole(Request $request): JsonResponse|User
    {
        $r = $request->all();
        $hasNoPrivileges = !$this->hasRole(config('crebs86.admin_roles_edit'));
        if (count(array_intersect($r['roles'], config('crebs86.admin_roles'))) > 0 && $hasNoPrivileges) {
            return response()->json('Papéis de usuário: você não possui permissão para editar papél administrador', 403);
        }
        if ($this->can('ACL Editar')) {
            if (getKeyValue($r['_checker'], 'edit_user_role') === $request->id) {
                $user = User::where('id', $request->id)->first();
                if ($user->hasRole(config('crebs86.admin_roles')) && $hasNoPrivileges) {
                    return response()->json('Papéis de usuário: você não possui permissão para editar usuário administrador', 403);
                }
                return
                    $user->syncRoles($r['roles']);
            }
            return response()->json('Payload: erro ao acessar aplicação', 403);
        }
        return response()->json('Papéis de usuário: você não possui permissão para acessar este recurso', 403);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        if ($this->can('Usuario Criar')) {
            return Inertia::render('Admin/UserCreate', [
                'branches' => Branch::orderBy('name')->select(['id', 'name'])->get()
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request, User $user): Response|RedirectResponse
    {
        if ($this->can('Usuario Criar')) {
            $pass = Str::random(8);
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'cpf' => 'nullable|cpf|unique:users',
                'branch_id' => 'nullable|exists:branches,id',
                'notes' => 'nullable|min:3|max:510'
            ], [
                'cpf.unique' => 'Este CPF já se encontra em uso'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'cpf' => $request->cpf,
                'branch_id' => $request->branch_id,
                'notes' => $request->notes,
                'password' => Hash::make($pass),
            ]);

            Mail::to($user)->send(new WelcomeUser($user, $pass));

            if ($user) {
                return redirect(route('admin.acl.usuarios.show', $user->id))->with('success', 'Usuário ' . $user->name . ' foi criado com sucesso!');
            }
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar usuário');
        }
        return Inertia::render('Admin/403');
    }
    /**
     * exibe formulário de edição do usuário selecionado
     */
    public function show(Request $request): Response
    {
        return $this->edit($request);
    }
    public function edit(Request $request): Response
    {
        if ($this->can('Usuario Ver', 'Usuario Editar', 'Usuario Apagar')) {
            if ($user = User::select('id', 'name', 'cpf', 'email', 'notes', 'branch_id', 'deleted_at', 'email_verified_at')->withTrashed()->find($request->user) ?? []) {
                return Inertia::render(
                    'Admin/UserEdit',
                    [
                        'user' => $user,
                        'branches' => Branch::orderBy('name')->select(['id', 'name'])->get(),
                        '_checker' => setGetKey($request->user, 'edit_user_account')
                    ]
                );
            }
        }
        return Inertia::render('Admin/403');
    }
    /**
     * atualiza usuário com dados recebidos do formulário
     */
    public function update(UserRequest $request): Response|RedirectResponse
    {
        if ($this->can('Usuario Editar', 'Usuario Apagar')) {

            if ((int) getKeyValue($request->_checker, 'edit_user_account') === (int) $request->user) {

                $user = User::withTrashed()
                    ->find($request->user);
                $u = collect($user)->all();
                $updated = $user->update(
                    [
                        'email' => $request->email,
                        'name' => $request->name,
                        'cpf' => $request->cpf,
                        'deleted_at' => $request->active ? null : now(),
                        'branch_id' => $request->branch_id,
                        'notes' => $request->notes
                    ]
                );
                if ($updated) {
                    $this->auditable('users') ? $this->saveUpdates($u, $user, UserUpdate::class, ['name', 'email', 'cpf', 'email_verified_at', 'deleted_at', 'branch_id', 'updated_at']) : null;
                    return redirect()->back()->with('success', 'O usuário foi atuzalizado');
                } else {
                    return redirect()->back()->with('error', 'Erro ao atualizar conta do usuário');
                }
            } else {
                return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
            }
        }
        return Inertia::render(
            'Admin/403',
            [
                'flash.error' => 'Você não possui permissão para usar este recurso'
            ]
        );
    }
    /**
     * marca e-mail como verificado
     */
    public function userVerifyEmail(Request $request): Response|RedirectResponse
    {
        if ($this->can('Usuario Editar')) {
            if ((int) getKeyValue($request->_checker, 'edit_user_account') === (int) $request->id) {
                $user = User::withTrashed()
                    ->find($request->id);
                $u = collect($user)->all();
                if ($user->update(
                    [
                        'email_verified_at' => now()
                    ]
                )) {
                    $this->auditable('users') ? $this->saveUpdates($u, $user, UserUpdate::class, ['name', 'email', 'cpf', 'email_verified_at', 'deleted_at', 'branch_id', 'updated_at']) : null;
                    return redirect()->back()->with('success', 'Email verificardo com sucesso');
                } else {
                    return redirect()->back()->with('error', 'Erro ao solicitar verificação de e-mail');
                }
            } else {
                return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
            }
        }
        return Inertia::render('Admin/403')->with('error', 'Você não possui permissão para usar este recurso');
    }

    /**
     * envia link de verificação de e-mail para o endereço cadastrado
     */
    public function requireEmailVerification(Request $request)
    {
        if ($this->can('Usuario Editar')) {
            if ((int) getKeyValue($request->_checker, 'edit_user_account') === (int) $request->id) {
                $user = User::withTrashed()
                    ->find($request->id);
                $u = collect($user)->all();
                if ($user->update(
                    [
                        'email_verified_at' => null
                    ]
                )) {
                    $this->auditable('users') ? $this->saveUpdates($u, $user, UserUpdate::class, ['name', 'email', 'cpf', 'email_verified_at', 'deleted_at', 'branch_id', 'updated_at']) : null;
                    return redirect()->back()->with('success', 'Usuário deverá fazer login e solicitar link de verificação de e-mail');
                } else {
                    return redirect()->back()->with('error', 'Erro ao solicitar verificação de e-mail');
                }
            } else {
                return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
            }
        }
        return Inertia::render('Admin/403')->with('error', 'Você não possui permissão para usar este recurso');
    }
    /**
     * página da conta do usuário
     */
    public function account(): Response
    {
        return Inertia::render('Admin/Account');
    }

    /**
     * atualiza os dados do usuário
     */
    public function updateAccount(Request $request): Response
    {
        $request->validate(
            [
                'name' => 'string|required|min:3|max:255',
                'email' => 'email|required|unique:users,id'
            ]
        );

        $account = User::find(auth()->id());
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $request->user()->email === $request->email ? $request->user()->email_verified_at : null
        ]);
        $this->auditable('users') ? $this->saveUpdates($account, $request->user(), UserUpdate::class, ['name', 'email', 'cpf', 'email_verified_at', 'deleted_at', 'branch_id', 'updated_at']) : null;

        return Inertia::render('Admin/Account', [
            'message' => 'Sua conta foi atualizada!'
        ]);
    }

    /**
     * atualiza senha
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if (Hash::check($request->current_password, auth()->user()->password)) {
            $request->user()->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            return redirect()->back()->with([
                'success' => 'Sua senha foi alterada com sucesso!'
            ]);
        } else {
            return redirect()->back()->with([
                'error' => 'Ops! Senha incorreta.'
            ]);
        }
    }
}
