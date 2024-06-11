<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * DokumentasiPembinaanModel
 */
class DokumentasiPembinaanModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();

        $this->addProperty('judul', self::TYPE_STRING);
        $this->addProperty('berita', self::TYPE_STRING);
        $this->addProperty('gambar', self::TYPE_STRING);
        $this->addProperty('pembinaan_id', self::TYPE_INT);
        $this->addProperty('is_active', self::TYPE_INT);
        $this->addProperty('tanggal', self::TYPE_INT);
        $this->addProperty('create_by', self::TYPE_INT);
        $this->addProperty('update_by', self::TYPE_INT);
        $this->addProperty('create_at', self::TYPE_INT);
        $this->addProperty('updated_at', self::TYPE_INT);

        parent::__construct();
    }
    
    /**
     * table
     *
     * @return string
     */
    public static function table(): string
    {
        return db()->getTable('dokumentasi_pembinaan');
    }
}