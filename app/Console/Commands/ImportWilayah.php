<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Wilayah;


class ImportWilayah extends Command
{
    protected $signature = 'wilayah:import';
    protected $description = 'Import data wilayah dari file Excel';

    public function handle()
    {
        $filePath = public_path('kode_bengkulu.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan di: $filePath");
            return;
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $count = 0;

        foreach ($rows as $row) {
            if (empty($row[0]))
                continue;


            [$kode, $nama] = array_map('trim', explode(',', $row[0]));

            $jenis = null;

            if (preg_match('/^\d{2}$/', $kode)) {
                $jenis = 'Provinsi';
            } elseif (preg_match('/^\d{2}\.\d{2}$/', $kode)) {
                $jenis = 'Kabupaten/Kota';
            } elseif (preg_match('/^\d{2}\.\d{2}\.\d{2}$/', $kode)) {
                $jenis = 'Kecamatan';
            } elseif (preg_match('/^\d{2}\.\d{2}\.\d{2}\.\d{4}$/', $kode)) {
                $jenis = 'Kelurahan/Desa';
            }

            if ($jenis) {
                Wilayah::updateOrCreate(
                    ['kode' => $kode],
                    ['nama' => $nama, 'jenis' => $jenis]
                );
                $count++;
            }
        }

        $this->info("Import selesai. Total data: $count");
    }
}
