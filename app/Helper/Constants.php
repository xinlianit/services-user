<?php
/**
 * 全局常量库
 *
 * @link     http://www.zhaoliangji.com/
 * @author   找靓机 PHP DEV TEAM jry(jirenyou@aliyun.com)
 * @datetime 2019/6/13 16:57
 */

/**
 * 状态码
 * 200：成功
 */
define('STATUS_CODE_SUCCESS', 200);

/**
 * API 状态码
 * 0：失败
 * 1：成功
 */
define('API_CODE_FAILURE', 0);
define('API_CODE_SUCCESS', 1);

/**
 * 数据格式
 * 1：字符串
 * 2：数组
 * 3：JSON
 * 4：对象
 */
define('DATA_FORMAT_STRING', 1);
define('DATA_FORMAT_ARRAY', 2);
define('DATA_FORMAT_JSON', 3);
define('DATA_FORMAT_OBJECT', 4);