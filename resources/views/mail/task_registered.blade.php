@component('mail::message')
# Task, {{ $task->name }}

Task created with priority {{ $task->priority }}! 🚀

@component('mail::button', ['url' => url('/')])
Acessar Plataforma
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
