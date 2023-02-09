<?php

namespace App\Http\Livewire\Export;

use App\Jobs\ProcessLancamentoExport;
use App\Models\Lancamento as ModelsLancamento;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Lancamento extends Component
{
     //cliente
     public $numberLancamentos;
     public $batchLancamentoId;
     public $numberContasAReceber;
     public $exporting_client = false;
     public $exportgin_client_finished = false;

     public function render()
     {
         return view('livewire.export.lancamento');
     }

     public function mount()
     {
         $this->numberLancamentos = ModelsLancamento::count();
     }

     public function export_clients()
     {
         $this->exporting_client = true;
         $this->exportgin_client_finished = false;

         $batch = Bus::batch([
             new ProcessLancamentoExport(),
         ])->dispatch();

         $this->batchLancamentoId = $batch->id;

     }

     public function baixar_clientes_arquivo(){
         return Storage::download('public/lancamentos.xlsx');
     }

     public function exportProgress()
     {
         Artisan::call('queue:work --once');

         $this->exportgin_client_finished = Bus::findBatch($this->batchLancamentoId)->finished();

         if($this->exportgin_client_finished){
             $this->exporting_client = false;
         }
     }
}
