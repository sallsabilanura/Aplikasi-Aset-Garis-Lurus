<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BarangExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = Barang::with(['aset', 'lokasis', 'user']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('NamaBarang', 'like', '%' . $this->search . '%')
                  ->orWhere('DanaDari', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Aset',
            'Tanggal',
            'Harga (Rp)',
            'Dana Dari',
            'Lokasi & Kuantitas',
            'Nama Instansi',
        ];
    }

    public function map($barang): array
    {
        static $no = 0;
        $no++;

        $lokasiData = $barang->lokasis->map(function($lokasi) {
            return strtoupper($lokasi->LokasiBarang) . ' (' . $lokasi->Kuantitas . ' unit)';
        })->implode(', ');

        return [
            $no,
            $barang->aset->NamaAset ?? '-',
            $barang->aset->TanggalPerolehan,
            'Rp ' . number_format($barang->aset->NilaiPerolehan, 2, ',', '.'),
            $barang->aset->Dana,
            $lokasiData ?: '-',
            $barang->user->name ?? 'Tidak Diketahui',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();    // baris terakhir
        $lastColumn = $sheet->getHighestColumn(); // kolom terakhir

        // 🎨 Style untuk header (baris 1)
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '2196F3'], // hijau soft
            ],
            'alignment' => [
                'horizontal' => 'center',
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
