@component('mail::message')
Prezado(a) <span style="font-weight: 700; color:#0b503d">{{ Auth()->user()->name }}<span>,

<br>
Verificamos que sua senha foi alterada com sucesso em nosso sistema.
<br>
<br>
Sua senha expira em <b>30 dias</b>. Caso necessite fazer uma nova alteração, acesse seu perfil e altere seus dados.

<br>
<br>
<hr>
<span style="font-weight: 400; color:#0b503d"> Obrigado! </span><br>
<span style="font-weight: 400; color:#0b503d; font-size: 11px;">pisciculturabomjardim.com.br
<br>
<br>
<span style="font-weight: 300; color:#0b503d; font-size: 9px;">{{ \Carbon\Carbon::now()->format('d/m/Y H:i:s')}}</span>
@endcomponent