<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbViewModel;

/**
 * PembinaanViewModel
 */
class PembinaanViewModel extends DbViewModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table =  static::table();

        parent::__construct();
    }
    
    /**
     * table
     *
     * @return string
     */
    public static function table(): string
    {
        return db()->getTable('pembinaan') . ' AS a LEFT JOIN ' . db()->getTable('pembinaan_category') . ' AS b ON a.jenis=b.id LEFT JOIN ' . db()->getTable('status_permintaan') . ' AS c ON a.status=c.id LEFT JOIN ' . db()->getTable('user') . ' AS d ON a.create_by=d.id';
    }    
    /**
     * column
     *
     * @return string
     */
    public static function column(): string
    {
        return 'a.id,a.produsen_data,a.deskripsi,a.jenis,a.tanggal,a.waktu,a.lokasi,a.surat,a.email_pic,a.nama_pic,a.nomor_hp_pic,a.status,a.create_by,a.create_at,b.nama as jenis_pembinaan,c.nama as status_permintaan,d.nama as nama_pendaftar,d.email as email_pendaftar,d.nip,d.instansi,d.tingkat';
    }
}