<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * StatusPermintaanModel
 */
class StatusPermintaanModel extends DbModel
{    
    const STATUS_OPEN = 1;
    const STATUS_IN_PROGRESS = 2;
    const STATUS_AWAITING_REPLY = 3;
    const STATUS_APPROVED = 4;
    const STATUS_CLOSED = 5;

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
        return db()->getTable('status_permintaan');
    }
}