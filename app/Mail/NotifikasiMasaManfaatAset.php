<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Aset;

class NotifikasiMasaManfaatAset extends Mailable
{
    use Queueable, SerializesModels;

    public $aset;

    public function __construct(Aset $aset)
    {
        $this->aset = $aset;
    }

    public function build()
    {
        return $this->subject('Peringatan Masa Manfaat Aset')
                    ->view('emails.notifikasi_aset');
    }
}
