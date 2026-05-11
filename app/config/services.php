<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\Pdo\Mysql;

$di = new FactoryDefault();

$di->set(
    'view',
    function () {
        $view = new View();

        $view->setViewsDir('../app/views/');

        return $view;
    }
);

$di->set(
    'db',
    function () {
        return new Mysql([
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'phalcon_auth'
        ]);
    }
);

session_start();

return $di;