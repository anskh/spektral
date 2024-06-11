<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbViewModel;

/**
 * DokumentasiPembinaanViewModel
 */
class DokumentasiPembinaanViewModel extends DbViewModel
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
        return db()->getTable('dokumentasi_pembinaan') . ' AS a LEFT JOIN ' . db()->getTable('user') . ' AS b ON a.create_by=b.id';
    }    
    /**
     * column
     *
     * @return string
     */
    public static function column(): string
    {
        return 'a.id,a.judul,a.berita,a.gambar,a.tanggal,a.is_active,a.create_by,a.create_at,b.nama';
    }
}