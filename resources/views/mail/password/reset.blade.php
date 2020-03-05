@component('mail::message')
# Olá

Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.

@component('mail::button', ['url' => $url])
Redefinir Senha
@endcomponent

Se você não solicitou uma redefinição de senha, nenhuma ação adicional será necessária.

{{ config('app.name') }}
@endcomponent
