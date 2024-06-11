<?php

declare(strict_types=1);

use Corephp\Db\MigrationContainer;
use Corephp\Helper\Config;

defined('ROOT') or define('ROOT', __DIR__);

if(getcwd() !== ROOT){
    chdir(ROOT);
}

require ROOT . '/vendor/autoload.php';

Dotenv\Dotenv::createImmutable(ROOT)->load();

if(!empty($_ENV['CORE_ENVIRONMENT'])){
    define('CORE_ENVIRONMENT', $_ENV['CORE_ENVIRONMENT']);
}else{
    define('CORE_ENVIRONMENT', 'development');
}

if(!empty($_ENV['CORE_CONNECTION'])){
    define('CORE_CONNECTION', $_ENV['CORE_CONNECTION']);
}else{
    define('CORE_CONNECTION', 'default');
}

$action = null;
if ($argc > 1) {
    $action = $argv[1];
}

if (!in_array($action, ['up', 'down', 'seed'], true)) {
    die('Argument is invalid. Available arguments are up, seed, or down');
}

// init config
Config::init('app/config');

// build migration
$container = make(MigrationContainer::class, ['args' => [$action]]);
$container->applyMigration();
