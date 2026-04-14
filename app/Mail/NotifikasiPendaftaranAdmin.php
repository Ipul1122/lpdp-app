<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiPendaftaranAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftar;
    public $tipe;

    public function __construct($pendaftar, $tipe)
    {
        $this->pendaftar = $pendaftar;
        $this->tipe = $tipe; // 'baru' atau 'pengajuan_ulang'
    }

    public function build()
    {
        $subject = $this->tipe === 'baru' 
            ? '🔴 Pendaftaran Tupel Baru Masuk!' 
            : '🟡 Pengajuan Ulang Berkas Tupel';

        return $this->view('admin.emails.notifikasi_admin')
                    ->subject($subject);
    }
}