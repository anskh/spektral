<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * TestimoniModel
 */
class TestimoniModel extends DbModel
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = static::table();

        $this->addProperty('pesan', self::TYPE_STRING);
        $this->addProperty('user_id', self::TYPE_INT);
        $this->addProperty('rating', self::TYPE_INT);
        $this->addProperty('is_active', self::TYPE_INT);
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
        return db()->getTable('testimoni');
    }
}