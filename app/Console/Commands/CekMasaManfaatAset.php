<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aset;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifikasiMasaManfaatAset;
use Carbon\Carbon;

class CekMasaManfaatAset extends Command
{
    protected $signature = 'cek:masa-manfaat';
    protected $description = 'Mengirim email jika masa manfaat aset akan segera habis';

    public function handle()
    {
        $today = Carbon::now();
        $asets = Aset::all();

        foreach ($asets as $aset) {
            $tanggalPerolehan = Carbon::parse($aset->TanggalPerolehan);
            $masaManfaat = $tanggalPerolehan->addMonths($aset->MasaManfaat);

            $diffInDays = $today->diffInDays($masaManfaat, false);

            if ($diffInDays <= 30 && $diffInDays >= 0) { // Notifikasi jika kurang dari 30 hari
                $user = $aset->user;
                if ($user) {
                    Mail::to($user->email)->send(new NotifikasiMasaManfaatAset($aset));
                    $this->info("Notifikasi dikirim ke " . $user->email);
                }
            }
        }
    }
}
