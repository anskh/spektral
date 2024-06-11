<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * PembinaanMessageModel
 */
class PembinaanMessageModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();

        $this->addProperty('pembinaan_id', self::TYPE_INT);
        $this->addProperty('message_date', self::TYPE_INT);
        $this->addProperty('user_id', self::TYPE_INT);
        $this->addProperty('message', self::TYPE_STRING);

        parent::__construct();
    }
    
    /**
     * table
     *
     * @return string
     */
    public static function table(): string
    {
        return db()->getTable('pembinaan_message');
    }
}