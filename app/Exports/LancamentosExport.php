<?php

namespace App\Exports;

use App\Models\Lancamento;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LancamentosExport implements FromCollection, ShouldAutoSize, WithStyles, WithHeadings
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lancamento::orderBy('id')->get()->map(function($lancamento){
            return [
            'id' => $lancamento->id,
            'tipo' =>$lancamento->tipo,
            'funcionario' =>$lancamento->funcionario->nome,
            'peso' => number_format($lancamento->peso, 2, ',', '.'),
            'created_at' => \Carbon\Carbon::parse($lancamento->created_at)->format('d/m/Y H:i'),
            'updated_at' => \Carbon\Carbon::parse($lancamento->updated_at)->format('d/m/Y H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
           'ID',
           'Tipo',
           'Funcionário',
           'Peso',
           'Data de Inclusão',
           'Última alteração',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setRGB('51d2b7');

        $sheet->getStyle('A1:N1')
                ->getFont()
                ->setBold(true)
                ->getColor()
                ->setRGB('ffffff');

    }
}
