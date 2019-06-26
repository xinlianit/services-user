<?php

use Swoft\Http\Server\HttpServer;
use Swoft\Task\Swoole\TaskListener;
use Swoft\Task\Swoole\FinishListener;
use Swoft\Rpc\Client\Client as ServiceClient;
use Swoft\Rpc\Client\Pool as ServicePool;
use Swoft\Rpc\Server\ServiceServer;
use Swoft\Http\Server\Swoole\RequestListener;
use Swoft\WebSocket\Server\WebSocketServer;
use Swoft\Server\Swoole\SwooleEvent;
use Swoft\Db\Database;
use Swoft\Redis\RedisDb;

return [
    'logger'             => [
        'flushRequest' => true,
        'enable'       => false,
        'json'         => false,
    ],
    'httpServer'         => [
        'class'    => HttpServer::class,
        'port'     => 19306,
        'listener' => [
            'rpc' => bean('rpcServer')
        ],
        'on'       => [
            SwooleEvent::TASK   => bean(TaskListener::class),  // Enable task must task and finish event
            SwooleEvent::FINISH => bean(FinishListener::class)
        ],
        /* @see HttpServer::$setting */
        'setting'  => [
            'task_worker_num'       => 12,
            'task_enable_coroutine' => true,
            'log_file'              => alias('@runtime/swoole.log'),
        ]
    ],
    'httpDispatcher'     => [
        'middlewares' => [
            // HTTP 中间件
            \App\Http\Middleware\HttpMiddleware::class,
            // 跨域中间件
            \App\Http\Middleware\CorsMiddleware::class
        ]
    ],
    'db'                 => [
        'class'    => Database::class,
        'dsn'      => env('DB_DSN', 'mysql:dbname=test;host=172.17.0.3'),
        'username' => env('DB_USER', 'root'),
        'password' => env('DB_PASSWORD', '123456'),
        'charset'  => 'utf8mb4',
        'prefix'   => '',
        'options'  => [
            //\PDO::ATTR_CASE => \PDO::CASE_NATURAL,
        ],
        'config'   => [
            'collation' => 'utf8mb4_general_ci',
            'strict'    => false,
            'timezone'  => '+8:00',
            'modes'     => 'NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES',
            'fetchMode' => PDO::FETCH_ASSOC,
        ]
    ],
    'db_write_read'      => [
        'class'   => Database::class,
        'charset' => 'utf8mb4',
        'prefix'  => '',
        'options' => [],
        'config'  => [
            'collation' => 'utf8mb4_general_ci',
            'strict'    => false,
            'timezone'  => '+8:00',
            'modes'     => 'NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES',
            'fetchMode' => PDO::FETCH_ASSOC,
        ],
        'writes'  => [
            [
                'dsn'      => env('DB_DSN_WRITE', 'mysql:dbname=test;host=127.0.0.1'),
                'username' => env('DB_USER_WRITE', 'root'),
                'password' => env('DB_PASSWORD_WRITE', '123456'),
            ]
        ],
        'reads'   => [
            [
                'dsn'      => env('DB_DSN_READ', 'mysql:dbname=test;host=127.0.0.1'),
                'username' => env('DB_USER_READ', 'root'),
                'password' => env('DB_PASSWORD_READ', '123456'),
            ]
        ]
    ],
    'db.pool'            => [
        'class'       => \Swoft\Db\Pool::class,
        'database'    => bean('db_write_read'),
        'minActive'   => 10,
        'maxActive'   => 20,
        'maxWait'     => 0,
        'maxWaitTime' => 0,
        'maxIdleTime' => 60
    ],
    'redis'              => [
        'class'    => RedisDb::class,
        'host'     => '127.0.0.1',
        'port'     => 36379,
        'database' => 0,
    ],
    'redis.pool'         => [
        'class'   => \Swoft\Redis\Pool::class,
        'redisdb' => bean('redis')
    ],
    'user'               => [
        'class'   => ServiceClient::class,
        'host'    => '127.0.0.1',
        'port'    => 19307,
        'setting' => [
            'timeout'         => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout'   => 10.0,
            'read_timeout'    => 0.5,
        ],
        'packet'  => bean('rpcClientPacket')
    ],
    'user.pool'          => [
        'class'  => ServicePool::class,
        'client' => bean('user')
    ],
    'test'               => [
        'class'   => ServiceClient::class,
        'host'    => '127.0.0.1',
        'port'    => 19307,
        'setting' => [
            'timeout'         => 0.5,
            'connect_timeout' => 1.0,
            'write_timeout'   => 10.0,
            'read_timeout'    => 0.5
        ],
        'packet'  => bean('rpcClientPacket')
    ],
    'test.pool'          => [
        'class'  => ServicePool::class,
        'client' => bean('test')
    ],
    'rpcServer'          => [
        'class'   => ServiceServer::class,
        'port'    => 19307,
        'setting' => [
            'worker_num' => 2,
            // 'daemonize'  => false
        ]
    ],
    'wsServer'           => [
        'class'   => WebSocketServer::class,
        'on'      => [
            // Enable http handle
            SwooleEvent::REQUEST => bean(RequestListener::class),
        ],
        'debug'   => env('SWOFT_DEBUG', 0),
        /* @see WebSocketServer::$setting */
        'setting' => [
            'log_file' => alias('@runtime/swoole.log'),
        ],
    ]
];
