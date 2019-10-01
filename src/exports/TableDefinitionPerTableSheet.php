<?php

namespace Shibuyakosuke\TableDefinition\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Shibuyakosuke\TableDefinition\Helpers\Sheet;

/**
 * Class TableDefinitionPerTableSheet
 * @package Shibuyakosuke\TableDefinition\Exports
 */
class TableDefinitionPerTableSheet extends Sheet implements FromView, WithTitle, WithEvents
{
    /**
     * Cell Border setting
     * @var array
     */
    private $border = [
        'outline' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
        'horizontal' => [
            'borderStyle' => Border::BORDER_THIN
        ],
        'vertical' => [
            'borderStyle' => Border::BORDER_DOTTED
        ],
    ];

    /**
     * Cell Background-color setting
     * @var array
     */
    private $fill = [
        'fillType' => Fill::FILL_SOLID,
        'color' => [
            'argb' => 'FFD3F9D8'
        ],
    ];

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->table->TABLE_NAME;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('table-definition-spreadsheet::information_schema', [
            'columns' => $this->columns,
            'table' => $this->table,
            'constraints' => $this->constraints,
            'referencing' => $this->referencing
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                foreach ($this->getRanges('th', $this->columns, $this->constraints, $this->referencing) as $rangeByColAndRow) {
                    $event->sheet->styleCells(
                        $rangeByColAndRow,
                        [
                            'borders' => $this->border,
                            'fill' => $this->fill
                        ]
                    );
                }
                foreach ($this->getRanges('table', $this->columns, $this->constraints, $this->referencing) as $rangeByColAndRow) {
                    $event->sheet->styleCells(
                        $rangeByColAndRow,
                        [
                            'borders' => $this->border,
                        ]
                    );
                }

                // Set column width
                $event->sheet->setColWidth(1, 9);
                $event->sheet->setColWidth(2, 18);
                $event->sheet->setColWidth(3, 18);
                $event->sheet->setColWidth(4, 18);
                $event->sheet->setColWidth(5, 18);
                $event->sheet->setColWidth(6, 18);
                $event->sheet->setColWidth(7, 18);
                $event->sheet->setColWidth(8, 18);
            },
        ];
    }
}