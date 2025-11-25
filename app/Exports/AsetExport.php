<?php

namespace App\Exports;

use App\Models\Aset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AsetExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
protected $kategoriId;
protected $tahun;

public function __construct($kategoriId = null, $tahun = null)
{
    $this->kategoriId = $kategoriId;
    $this->tahun = $tahun;
}

public function collection()
{
    $query = Aset::with(['kategori','user']);

    if ($this->kategoriId) {
        $query->where('KategoriID', $this->kategoriId);
    }
    if ($this->tahun) {
        $query->whereYear('TanggalPerolehan', $this->tahun);
    }

    return $query->get();
}

    public function headings(): array
    {
        return [
            'No',
            'Nama Aset',
            'Kode Aset',
            'Kategori',
            'Dana',
            'Kuantitas',
            'Nilai Perolehan',
            'Nilai Residu',
            'Masa Manfaat',
            'Tanggal Perolehan',
            'Status',
            'Keterangan',
            'Lokasi Aset',
            'Nama Instansi'
        ];
    }

    public function map($aset): array
    {
        static $no = 1;
        return [
            $no++,
            $aset->NamaAset,
            $aset->KodeAset,
            $aset->kategori->NamaKategori ?? '-',
            $aset->Dana,
            $aset->Kuantitas,
            'Rp ' . number_format($aset->NilaiPerolehan, 0, ',', '.'),
            'Rp ' . number_format($aset->NilaiResidu, 0, ',', '.'),
            $aset->MasaManfaat,
            $aset->TanggalPerolehan,
            $aset->Status,
            $aset->Program,
            $aset->LokasiAset,
            $aset->user->name ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        // Header biru
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

        // Border untuk semua cell
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
