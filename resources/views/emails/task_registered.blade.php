@component('mail::message')
# Task, {{ $task->name }}

Seja bem-vindo à nossa aplicação! 🚀

@component('mail::button', ['url' => url('/')])
Acessar Plataforma
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
