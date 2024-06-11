<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbViewModel;

/**
 * TestimoniViewModel
 */
class TestimoniViewModel extends DbViewModel
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
        return db()->getTable('testimoni') . ' AS a LEFT JOIN ' . db()->getTable('user') . ' AS b ON a.userid=b.id';
    }    
    /**
     * column
     *
     * @return string
     */
    public static function column(): string
    {
        return 'a.id,a.userid,a.pesan,a.rating,a.is_active,a.create_at,a.update_at,b.nama,b.instansi,b.jabatan';
    }
}