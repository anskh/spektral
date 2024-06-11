<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * ModulCategoryModel
 */
class ModulCategoryModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();
        $this->autoIncrement = false;

        $this->addProperty('id', self::TYPE_INT);
        $this->addProperty('nama', self::TYPE_STRING);
        $this->addProperty('deskripsi', self::TYPE_STRING);
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
        return db()->getTable('modul_category');
    }
}