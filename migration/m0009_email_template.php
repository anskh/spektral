<?php

declare(strict_types=1);

use Corephp\Db\Migration;

class m0009_email_template extends Migration
{
    public function __construct()
    {
        $this->table = db()->getTable('email_template');
    }

    public function up(): bool
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->table . "(
            `id` VARCHAR(100) NOT NULL,
            `nama` VARCHAR(255) NOT NULL,
            `judul` VARCHAR(255) NOT NULL,
            `pesan` text NOT NULL,
            `create_at` INT(11) NOT NULL DEFAULT UNIX_TIMESTAMP(),
            `update_at` INT(11) NULL,
            `status` INT(4) NOT NULL,
            PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";

        try {
            db()->exec($sql);
        } catch (Exception $e) {
            echo ($e->getMessage());
            return false;
        }

        return true;
    }

    public function seed(): bool
    {
        $data = [
            [
                'id' => 'new_ticket',
                'nama' => 'Pembuatan permintaan pembinaan baru',
                'judul' => '[#%ticket_id%] Permintaan pembinaan baru | SPEKTRAL',
                'pesan' => '<p>Halo %client_name%,</p>
                <p>Terimakasih telah menghubungi kami. Ini adalah jawaban otomatis sebagai konfirmasi bahwa permintaan Anda telah diterima. Petugas kami akan memprosesnya sesegera mungkin.</p>
                <p>Untuk catatan Anda, rincian tiket tercantum di bawah ini. Saat membalas, pastikan bahwa ID tiket disimpan di baris subjek untuk memastikan bahwa balasan Anda dilacak dengan tepat.</p>
                <p>ID: %ticket_id% <br />Deskripsi: %ticket_description%</p>
                <p>Anda dapat memeriksa status atau membalas tiket ini secara online di: %url%</p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ],
            [
                'id' => 'registration',
                'nama' => 'Registrasi pengguna',
                'judul' => 'Registrasi pengguna | SPEKTRAL',
                'pesan' => '<p>Halo %client_name%,</p>
                <p>Terimakasih telah registrasi. Ini adalah jawaban otomatis sebagai konfirmasi bahwa registrasi Anda telah tersimpan di kami.</p>
                <p>Klik tautan di bawah ini untuk memverifikasi akun email Anda untuk mendapatkan akses penuh pada SPEKTRAL BPS Provinsi Riau.</p>
                <p><a href=\"%url%\" target=\"_blank\">Aktifkan Sekarang</a></p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ],
            [
                'id' => 'new_ticket_supervisor_notification',
                'nama' => 'Pemberitahuan permintaan pembinaan baru',
                'judul' => 'Pemberitahuan permintaan pembinaan baru | SPEKTRAL',
                'pesan' => '<p>Halo %supervisor_name%,</p>
                <p>Permintaan pembinaan baru telah dibuat dan ditugaskan untuk Anda, silakan masuk ke backend SPEKTRAL untuk memprosesnya.</p>
                <p>ID: %ticket_id% <br />Deskripsi: %ticket_description%</p>
                <p><a href=\"%url%\" target=\"_blank\">Proses Sekarang</a></p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ],
            [
                'id' => 'supervisor_reply',
                'nama' => 'Supervisor menjawab',
                'judul' => 'Re: [#%ticket_id%] Tanggapan Petugas | SPEKTRAL',
                'pesan' => '<p>Halo %client_name%,</p>
                <p>Petugas kami telah menanggapi permintaan anda.</p>
                <p><a href=\"%url%\" target=\"_blank\">Lihat Sekarang</a></p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ],
            [
                'id' => 'client_reply',
                'nama' => 'Pengguna menyampaikan pesan',
                'judul' => 'Re: [#%ticket_id%] Tanggapan Pengguna | SPEKTRAL',
                'pesan' => '<p>Halo %supervisor_name%,</p>
                <p>Pengguna telah mengirimkan pesan pada permintaan pembinaan yang ditugaskan ke Anda.</p>
                <p><a href=\"%url%\" target=\"_blank\">Lihat Sekarang</a></p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ],
            [
                'id' => 'lost_password',
                'nama' => 'Konfirmasi lupa password',
                'judul' => 'Pemulihan password | SPEKTRAL',
                'pesan' => '<p>Halo %client_name%,</p>
                <p>Kami telah menerima permintaan anda untuk mengatur ulang password.</p>
                <p>Klik tautan di bawah ini untuk memasukkan password yang baru</p>
                <p><a href=\"%url%\" target=\"_blank\">Ubah Sekarang</a></p>
                <p>Terimakasih, BPS Provinsi Riau</p>',
                'create_at' => time(),
                'status' => 1
            ]
        ];

        try {
            db()->insert($data, $this->table, true);
        } catch (Exception $e) {
            echo ($e->getMessage());
            return false;
        }

        return true;
    }
}
