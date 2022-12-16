<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Branch;
use App\Traits\Helpers;
use App\Models\BranchUpdate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\BranchRequest;

class BranchController extends Controller
{
    use ACL, Helpers;
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Branch $branch): Response
    {
        if ($this->can('Unidade Ver', 'Unidade Editar', 'Unidade Apagar', 'Unidade Criar')) {
            return Inertia::render('Admin/Branches', [
                'branches' => $branch->withTrashed()->get(['id', 'name', 'cnpj', 'email', 'address', 'deleted_at'])
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch $branch
     * @return \Inertia\Response
     */
    public function show(Branch $branch): Response
    {
        if ($this->can('Unidade Ver', 'Unidade Editar', 'Unidade Apagar')) {
            return Inertia::render('Admin/Branch', [
                'edit' => false,
                'branch' => $branch,
                '_checker' => setGetKey($branch->id, 'edit_branch')
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch $branch
     * @return \Inertia\Response
     */
    public function edit(Branch $branch): Response
    {
        if ($this->can('Unidade Editar')) {
            return Inertia::render('Admin/Branch', [
                'edit' => true,
                'branch' => $branch,
                '_checker' => setGetKey($branch->id, 'edit_branch')
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Admin\BranchRequest $request
     * @param  \App\Models\Branch  $branch
     * @return \Inertia\Response|Illuminate\Http\RedirectResponse
     */
    public function update(BranchRequest $request, Branch $branch): Response|RedirectResponse
    {
        if ((int) getKeyValue($request->_checker, 'edit_branch') === (int) $request->id) {
            if ($this->can('Unidade Editar')) {
                $u = collect($branch)->all();
                if ($branch->update($request->validated())) {
                    $this->saveUpdates($u, $branch, BranchUpdate::class, ['name', 'email', 'cnpj', 'address', 'deleted_at', 'updated_at', 'cep', 'phones', ' notes']);
                    return redirect()->back()->with('success', 'Unidade alterada com sucesso!');
                }
                return redirect()->back()->with('error', 'Ocorreu um erro ao salvar os dados da unidade');
            }
        } else {
            return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Remove the specified resource from storage.
     * @param App\Http\Requests\Admin\BranchRequest $request
     * @param  \App\Models\Branch $branch
     * @return \Inertia\Response|Illuminate\Http\RedirectResponse
     */
    public function destroy(Branch $branch, Request $request): Response|RedirectResponse
    {
        if ((int) getKeyValue($request->_checker, 'edit_branch') === (int) $request->id) {
            if ($this->can('Unidade Apagar')) {
                $u = collect($branch)->all();
                if ($branch->delete()) {
                    $this->saveUpdates($u, $branch, BranchUpdate::class, ['name', 'email', 'cnpj', 'address', 'deleted_at', 'updated_at', 'cep', 'phones', ' notes']);
                    return redirect()->back()->with('success', 'Unidade foi desativada com sucesso!');
                }
                return redirect()->back()->with('error', 'Ocorreu um erro ao desativar unidade');
            }
        } else {
            return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
        }
        return Inertia::render('Admin/403');
    }
    /**
     * Restore the especified resource
     * @param  \App\Models\Branch $branch
     * @return \Inertia\Response|Illuminate\Http\RedirectResponse
     */
    public function restore(Branch $branch, Request $request): Response|RedirectResponse
    {
        if ((int) getKeyValue($request->_checker, 'edit_branch') === (int) $request->id) {
            if ($this->can('Unidade Apagar', 'Unidade Editar')) {
                $u = collect($branch)->all();
                if ($branch->restore()) {
                    $this->saveUpdates($u, $branch, BranchUpdate::class, ['name', 'email', 'cnpj', 'address', 'deleted_at', 'updated_at', 'cep', 'phones', ' notes']);
                    return redirect()->back()->with('success', 'Unidade restaurada com sucesso!');
                }
                return redirect()->back()->with('error', 'Ocorreu um erro ao restaurar unidade');
            }
        } else {
            return redirect()->back()->with('error', 'Payload: erro ao acessar aplicação');
        }
        return Inertia::render('Admin/403');
    }
}
