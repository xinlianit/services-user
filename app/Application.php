<?php declare(strict_types=1);


namespace App;


use Swoft\Log\Helper\CLog;
use Swoft\Log\Logger;
use Swoft\SwoftApplication;

/**
 * Class Application
 *
 * @since 2.0
 */
class Application extends SwoftApplication
{
    public function getCLoggerConfig(): array
    {
        $config = parent::getCLoggerConfig();

        $config['name']    = 'swoft'; // 名称
        $config['enable']  = true; // 是否开启
        $config['output']  = true; // 是否打印的控制台
        $config['levels']  = []; // 输入日志的级别，为空全部输出，具体日志级别配置值，可以引用 Logger::NOTICE/...
        $config['logFile'] = ''; // 控制台日志默认打印到控制台，也可以配置路径，同时写到指定文件

        return $config;
    }
}
