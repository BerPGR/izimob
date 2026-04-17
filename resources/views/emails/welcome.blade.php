<x-mail::message>
# Bem vindo, {{ $user->name }}!

Sua solicitação de acesso a plataforma foi aprovada.
Agora você pode gerenciar o sistema de sua imobiliária!

<x-mail::button :url="url('/auth')">
    Acessar conta
</x-mail::button>

<x-mail::panel>
Seu plano atual é o **Gratuito**. Faça um upgrade para liberar mais recursos.
</x-mail::panel>

<br/>
{{ config('app.name') }}
</x-mail::message>
