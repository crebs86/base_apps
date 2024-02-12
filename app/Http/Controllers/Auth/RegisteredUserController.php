<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        if (json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
            return Setting::where('name', 'general')->first();
        })->settings)->canRegister[1]) {
            return Inertia::render('Auth/Register', [
                'requireCpf' => json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
                    return Setting::where('name', 'general')->first();
                })->settings)->requireCpf[1]
            ]);
        }
        return Inertia::render('Admin/404');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => [
                $this->cpfNull($request->cpf,),
                Rule::unique('users'),
                Rule::requiredIf(fn () => json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
                    return Setting::where('name', 'general')->first();
                })->settings)->requireCpf[1])
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'cpf.unique' => 'Este CPF já se encontra em uso',
            'cpf.required' => 'Informe seu CPF'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'password' => Hash::make($request->password),
        ]);

        try {
            event(new Registered($user));
        } catch (Exception $e) {
            return '<strong>Servidor de e-mail pode não estar configurado: </strong><br/>' . $e->getMessage() . '<br/><br/>Alguns recursos da aplicação não funcionarão corretamente sem um servidor de email configurado.';
        }
        Auth::login($user);

        if (json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
            return Setting::where('name', 'general')->first();
        })->settings)->mustVerifyEmail[1]) {
            return redirect()->route('verification.notice');
        }

        return redirect()->route('admin.acl.users.edit', $user->id);
    }

    private function cpfNull($cpf): string
    {
        if (
            json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
                return Setting::where('name', 'general')->first();
            })->settings)->requireCpf[1]
            ||
            (!json_decode(cache()->remember('settings', 60 * 60 * 2, function () {
                return Setting::where('name', 'general')->first();
            })->settings)->requireCpf[1] && $cpf)
        ) {
            return 'cpf';
        } else {
            return 'nullable';
        }
    }
}
