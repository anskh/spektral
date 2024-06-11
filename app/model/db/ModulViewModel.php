<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbViewModel;

/**
 * ModulViewModel
 */
class ModulViewModel extends DbViewModel
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
        return db()->getTable('modul') . ' AS a LEFT JOIN ' . db()->getTable('modul_category') . ' AS b ON a.kategori=b.id';
    }    
    /**
     * column
     *
     * @return string
     */
    public static function column(): string
    {
        return 'a.id,a.nama,a.deskripsi,a.jenis,a.link,a.kategori as idkategori,b.nama as kategori';
    }
}