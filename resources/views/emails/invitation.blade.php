<x-mail::message>
# Olá! Tudo bem?

Você foi convidado como **{{ $role }}** para utilizar o sistema {{ config('app.name') }}

<x-mail::button :url="$url">
    Crie sua conta!
</x-mail::button>

Esperamos você!<br>
{{ config('app.name') }}
</x-mail::message>
