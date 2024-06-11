<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * ModulModel
 */
class ModulModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();

        $this->addProperty('nama', self::TYPE_STRING);
        $this->addProperty('deskripsi', self::TYPE_STRING);
        $this->addProperty('jenis', self::TYPE_STRING);
        $this->addProperty('kategori', self::TYPE_INT);
        $this->addProperty('link', self::TYPE_STRING);
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
        return db()->getTable('modul');
    }
}