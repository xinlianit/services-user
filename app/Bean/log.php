<?php declare(strict_types=1);
return [
    // 日志配置
    'lineFormatter'      => [
        'format'     => '%datetime% [%level_name%] [%channel%] [%event%] [tid:%tid%] [cid:%cid%] [traceid:%traceid%] [spanid:%spanid%] [parentid:%parentid%] %messages%',
        'dateFormat' => 'Y-m-d H:i:s',
    ],
    'noticeHandler'      => [
        'class'     => \Swoft\Log\Handler\FileHandler::class,
        'logFile'   => '@runtime/logs/notice.log',
        //'logFile'   => '/tmp/swfot-notice.log',
        'formatter' => \bean('lineFormatter'),
        'levels'    => [
            \Swoft\Log\Logger::NOTICE,
            \Swoft\Log\Logger::INFO,
            \Swoft\Log\Logger::DEBUG,
            \Swoft\Log\Logger::TRACE,
        ],
    ],
    'applicationHandler' => [
        'class'     => \Swoft\Log\Handler\FileHandler::class,
        'logFile'   => '@runtime/logs/error.log',
        'formatter' => \bean('lineFormatter'),
        'levels'    => [
            \Swoft\Log\Logger::ERROR,
            \Swoft\Log\Logger::WARNING,
        ],
    ],
    'logger'             => [
        'flushRequest' => false,
        'enable'       => true,
        'json'         => false,
        'handlers'     => [
            'application' => \bean('applicationHandler'),
            'notice'      => \bean('noticeHandler'),
        ],
    ]
];