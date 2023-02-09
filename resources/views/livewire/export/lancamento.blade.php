<div>
    <div class="card-body d-flex justify-content-center align-items-center flex-column">
    @if($exporting_client && !$exportgin_client_finished)
        <div class="mb-1 text-center text-gray-600" wire:poll='exportProgress'>
            <i class="fa-solid fa-cloud-arrow-down text-gray-500 fa-fade" style='font-size: 48px;'></i>
            <h5>Relatório de Lançamentos...</h5>
            <h6>{{$numberLancamentos}} registros encontrados</h6>
            <p class=" text-muted">Exportando relatório... aguarde!!</p>
        @elseif($exportgin_client_finished)
        <div class="mb-1 text-center text-gray-600">
            <i class="fa-solid fa-circle-chevron-down text-gray-500 fa-shake" style='font-size: 48px;'></i>
            <h5>Relatório de Lançamentos Pronto!!</h5>
            <h6>{{$numberLancamentos}} registros exportados</h6>
            <p><button class="btn btn-sm btn-primary" wire:click='baixar_clientes_arquivo'>Baixar arquivo...</button></p>
        @else
        <a role="button" class="pointer-event text-decoration-none text-center text-gray-600" wire:click.prevent='export_clients'
        >
            <div class=" mb-1">
                <i class="fa-solid fa-download text-primary" style='font-size: 48px;'></i>
            </div>
            <h5>Relatório de Lançamentos</h5>
            <h6>{{$numberLancamentos}} registros encontrados</h6>
        </a>
        @endif
    </div>
</div>
