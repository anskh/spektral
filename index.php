<?php

declare(strict_types=1);

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('ROOT') or define('ROOT', __DIR__);

if(getcwd() !== ROOT){
    chdir(ROOT);
}

require 'vendor' . DS . 'autoload.php';

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

make(Corephp\App::class)->run();
