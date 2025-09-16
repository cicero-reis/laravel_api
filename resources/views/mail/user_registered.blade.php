@component('mail::message')

Seja bem-vindo à nossa aplicação! {{ $user->name }} 🚀

@component('mail::button', ['url' => url('/')])
Acessar Plataforma
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
