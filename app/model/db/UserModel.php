<?php declare(strict_types=1);

namespace App\Model\Db;

use Corephp\Model\DbModel;

/**
 * UserModel
 */
class UserModel extends DbModel
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
        $this->addProperty('email', self::TYPE_STRING);
        $this->addProperty('password', self::TYPE_STRING);
        $this->addProperty('nip', self::TYPE_STRING);
        $this->addProperty('jabatan', self::TYPE_STRING);
        $this->addProperty('instansi', self::TYPE_STRING);
        $this->addProperty('tingkat', self::TYPE_STRING);
        $this->addProperty('nomor_wa', self::TYPE_STRING);
        $this->addProperty('role', self::TYPE_STRING);
        $this->addProperty('token', self::TYPE_STRING);
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
        return db()->getTable('user');
    }
    
    /**
     * whereRole
     *
     * @param  mixed $role
     * @return array
     */
    public static function whereRole(string $role): array
    {
        return static::findColumn('`email`', "`role` LIKE '%{$role}%'");
    }
}