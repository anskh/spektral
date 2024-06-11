<?php declare(strict_types=1);

use Corephp\Db\Migration;

class m0010_dokumentasi_pembinaan extends Migration
{
    public function __construct()
    {
        $this->table = db()->getTable('dokumentasi_pembinaan');
    }
    
    public function up(): bool
    { 
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->table . "(
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `pembinaan_id` INT(11) NULL,
            `judul` VARCHAR(255) NOT NULL,
            `berita` text NOT NULL,
            `tanggal` date NOT NULL,
            `gambar` VARCHAR(255) NULL,
            `is_active` INT(4) NOT NULL DEFAULT 1,
            `create_by` INT(11) NOT NULL,
            `update_by` INT(11) NULL,
            `create_at` INT(11) NOT NULL DEFAULT UNIX_TIMESTAMP(),
            `update_at` INT(11) NULL,
            PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;";

        try
        {
            db()->exec($sql);
        }catch(Exception $e){
            echo($e->getMessage());
            return false;
        }
         
        return true;
    }

    public function seed(): bool
    {
        return false;
    }
}