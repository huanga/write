<?php
use Phalcon\Logger\Adapter\File as FileLogger;

return array(
    'error' => array(
        'logger'     => new FileLogger(ROOT_PATH . '/log/' . APPLICATION_ENV . '.log'),
        'controller' => 'error',
        'action'     => 'index'
    )
);