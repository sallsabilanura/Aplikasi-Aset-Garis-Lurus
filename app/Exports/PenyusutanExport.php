<?php

namespace App\Exports;

use App\Models\Penyusutan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenyusutanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $tahun;

    public function __construct($tahun = null)
    {
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Penyusutan::with(['aset', 'user'])
            ->when($this->tahun, function ($query) {
                $query->where('TahunPenyusutan', $this->tahun);
            })
            ->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Aset',
            'Kode Aset',
            'Qty',
            'Tahun Penyusutan',
            'Nilai Awal',
            'Penyusutan Tahunan',
            'Nilai Akhir',
            'Nama Instansi',
        ];
    }

    public function map($penyusutan): array
    {
        static $i = 0;
        return [
            ++$i,
            $penyusutan->aset->NamaAset ?? '-',
            $penyusutan->aset->KodeAset ?? '-',
            $penyusutan->aset->Kuantitas ?? '-',
            $penyusutan->TahunPenyusutan,
            'Rp ' . number_format($penyusutan->NilaiAwal, 0, ',', '.'),
            'Rp ' . number_format($penyusutan->PenyusutanTahunan, 0, ',', '.'),
            'Rp ' . number_format($penyusutan->NilaiAkhir, 0, ',', '.'),
            $penyusutan->user->name ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // 🎨 Header biru
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '2196F3'], // 💙 biru
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // 🧱 Border untuk semua cell
        $sheet->getStyle('A1:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        return [];
    }
}
