<x-mail::message>
# Nova Conta Criada

Caro {{ $user->name }}.

Bem vindo a {{ config('app.name') }}!<br>

Uma conta foi criada para este e-mail.<br>

Se esta conta foi criada equivocadamente, favor excluir este e-mail e nenhuma outra ação será necessária.<br>

Sua senha aleatória criada é: {{ $pass }}<br>

Recomendamos escolher uma nova senha após primeiro acesso.

<x-mail::button :url="$url">
Solicitar Redefinição de Senha
</x-mail::button>

Att,<br>
{{ config('app.name') }}
</x-mail::message>
