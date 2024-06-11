<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbViewModel;

/**
 * PembinaanMessageViewModel
 */
class PembinaanMessageViewModel extends DbViewModel
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
        return db()->getTable('pembinaan_message') . ' AS a LEFT JOIN ' . db()->getTable('user') . ' AS b ON a.user_id=b.id';
    }    
    /**
     * column
     *
     * @return string
     */
    public static function column(): string
    {
        return 'a.id,a.pembinaan_id,a.message_date,a.user_id,a.message,b.nama,b.email,b.role';
    }
}