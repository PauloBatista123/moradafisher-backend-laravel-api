@component('mail::message')
Recebemos sua solicitação para alterar seu email,

<br>
@component('mail::button', ['url' => route('admin.resetar', $token), 'color' => 'success' ])
Alterar senha
@endcomponent
<br>

Caso não consiga visualizar o link, copie e cole no seu navegador.
<br>
{{route('admin.resetar', $token)}}
<hr>
<span style="font-weight: 400; color:#0b503d"> Obrigado! </span><br>
<span style="font-weight: 400; color:#0b503d; font-size: 11px;">pisciculturabomjardim.com.br
<br>
<br>
<span style="font-weight: 300; color:#0b503d; font-size: 9px;">{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</span>
@endcomponent