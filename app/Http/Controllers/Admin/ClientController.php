<?php

namespace App\Http\Controllers\Admin;

use App\Traits\ACL;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
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
        if ($this->can('Clientes Ver', 'Clientes Editar', 'Clientes Apagar', 'Clientes Criar')) {
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
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function show(Client $client)
    {
        if ($this->can('Clientes Ver', 'Clientes Editar', 'Clientes Apagar', 'Clientes Criar')) {

            return Inertia::render('Admin/Client', [
                'client' => $client,
                'branch' => $client->branch_id ? Branch::where('id', $client->branch_id)->first()->name : [],
                'edit' => false
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
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Inertia\Response
     */
    public function destroy(Client $client)
    {
        //
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
