<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * PembinaanModel
 */
class PembinaanModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();

        $this->addProperty('produsen_data', self::TYPE_INT);
        $this->addProperty('deskripsi', self::TYPE_STRING);
        $this->addProperty('jenis', self::TYPE_INT);
        $this->addProperty('tanggal', self::TYPE_STRING);
        $this->addProperty('waktu', self::TYPE_STRING);
        $this->addProperty('surat', self::TYPE_STRING);
        $this->addProperty('lokasi', self::TYPE_STRING);
        $this->addProperty('email_pic', self::TYPE_STRING);
        $this->addProperty('nama_pic', self::TYPE_STRING);
        $this->addProperty('nomor_hp_pic', self::TYPE_STRING);
        $this->addProperty('status', self::TYPE_INT);
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
        return db()->getTable('pembinaan');
    }
}