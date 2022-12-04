<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Branch;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientController extends Controller
{
    use ACL;
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        if ($this->can('Cliente Ver', 'Cliente Editar', 'Cliente Apagar', 'Cliente Criar')) {
            if (!$request->client) {
                $client = Client::orderBy('updated_at', 'desc')->orderBy('id', 'desc')->paginate(20)->through(
                    function ($client) {
                        return $this->setClient($client);
                    }
                );
            } else {
                $client = $this->findClients($request->client);
            }

            return Inertia::render('Admin/Clients', [
                'clients' => $client,
                'keyword' => $request->client ?? ''
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
        if ($this->can('Cliente Criar')) {
            return Inertia::render('Admin/ClientCreate', [
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
    public function store(ClientRequest $request, Client $client)
    {
        if ($this->can('Cliente Criar')) {
            if ($c = $client->create($request->validated())) {
                return redirect(route('clients.show', $c->id))->with('success', 'Cliente criado com sucesso!');
            }
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar cliente');
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function show(Client $client): Response
    {
        if ($this->can('Cliente Ver', 'Cliente Editar', 'Cliente Apagar')) {

            return Inertia::render('Admin/Client', [
                'client' => $client,
                'edit' => false,
                'branches' => Branch::orderBy('name')->select(['id', 'name'])->get()
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function edit(Client $client): Response
    {
        if ($this->can('Cliente Editar')) {

            return Inertia::render('Admin/Client', [
                'client' => $client,
                'edit' => true,
                'branches' => Branch::orderBy('name')->select(['id', 'name'])->get()
            ]);
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        if ($this->can('Cliente Editar', 'Cliente Apagar')) {
            if ($client->update($request->validated())) {
                return redirect()->back()->with('success', 'Cliente alterado com sucesso!');
            }
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar os dados do cliente');
        }
        return Inertia::render('Admin/403');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function destroy(Client $client)
    {
        if ($this->can('Cliente Apagar')) {
        }
    }

    private function findClients(string $keyword): LengthAwarePaginator
    {
        $x = [
            'len' => strlen($keyword),
            'is_num' => is_numeric(str_replace('.', '', str_replace('-', '', $keyword)))
        ];
        if (!($x['is_num']) && $x['len'] < 4) {
            return [];
        }
        return Client::select('id', 'name', 'email', 'cpf')
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
            ->paginate(50)->through(
                function ($client) {
                    return $this->setClient($client);
                }
            );
    }
    /**
     * lança dados da pesquisa do cliente em um array
     */
    private function setClient($client): array
    {
        return [
            'id' => $client->id,
            'name' => $client->name,
            'email' => $client->email,
            'cpf' => $client->cpf
        ];
    }
}
