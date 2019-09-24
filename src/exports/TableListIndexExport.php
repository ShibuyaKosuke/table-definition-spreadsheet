<?php


namespace Shibuyakosuke\TableDefinition\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Shibuyakosuke\TableDefinition\Helpers\InformationSchema;
use Shibuyakosuke\TableDefinition\Traits\ExcelMacro;

class TableListIndexExport implements FromView, WithEvents
{
    use ExcelMacro;

    private $database;
    private $tables;

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
     * TableListIndexExport constructor.
     * @param string $database
     */
    public function __construct(string $database)
    {
        $this->database = $database;
        $this->tables = InformationSchema::getTables($database);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('table-definition-spreadsheet::table_index', [
            'tables' => $this->tables,
        ]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->styleCells(
                    [
                        'start' => ['column' => 1, 'row' => 2],
                        'end' => ['column' => 3, 'row' => 2]
                    ],
                    [
                        'borders' => $this->border,
                        'fill' => $this->fill
                    ]
                );
                $event->sheet->styleCells(
                    [
                        'start' => ['column' => 1, 'row' => 2],
                        'end' => ['column' => 3, 'row' => 2 + $this->tables->count()]
                    ],
                    [
                        'borders' => $this->border
                    ]
                );
                $event->sheet->setColWidth(1, 4);
                $event->sheet->setColWidth(2, 30);
                $event->sheet->setColWidth(3, 30);
            }
        ];
    }
}