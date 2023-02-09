@component('mail::message')
Olá {{ Auth()->user()->name }}.

Você está recebendo seu token de acesso ao 2º fator de autenticação do sistema.

<span style="font-weight: 400; font-size: 14;">{{$access_token->token}}</span>

@component('mail::button', ['url' => 'bomjardim.com'])
Entrar
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
