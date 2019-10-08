<?php
/**
 * 针对apache服务器的相关扩展
 *
 * @author FizeChan
 * @version V1.0.0.20170119
 * @todo 尚未测试
 */

namespace fize\misc;

class Apache
{

    /**
     * 在本次请求结束后终止 apache 子进程
     * 如果 PHP 以 Apache 1 模块方式运行，且 Apache 的版本是非多线程的，以及激活了 PHP 指令. child_terminate，则返回 TRUE。
     * 如果不满足上述条件则返回 FALSE 并生成一条 E_WARNING 级的错误信息。
     * @return bool
     */
    public static function childTerminate()
    {
        return apache_child_terminate();
    }

    /**
     * 获得已加载的Apache模块列表
     * @return array
     */
    public static function getModules()
    {
        return apache_get_modules();
    }

    /**
     * 获得Apache版本信息
     * @return string
     */
    public static function getVersion()
    {
        return apache_get_version();
    }

    /**
     * 获取 Apache subprocess_env 变量
     * @param string $variable Apache 环境变量名
     * @param bool $walk_to_top 是否获取对Apache各层可用的顶层变量
     * @return string
     */
    public static function getenv($variable, $walk_to_top = false)
    {
        return apache_getenv($variable, $walk_to_top);
    }

    /**
     * 对指定的 URI 执行部分请求并返回所有有关信息
     * @param string $filename
     * @return object
     */
    public static function lookupURI($filename)
    {
        return apache_lookup_uri($filename);
    }

    /**
     * 取得或设置 apache 请求记录
     * @param string $note_name note名。
     * @param string $note_value note值。
     * @return string 如果未能获取记录，则返回 FALSE。
     */
    public static function note($note_name, $note_value = null)
    {
        if (is_null($note_value)) {
            return apache_note($note_name);
        } else {
            return apache_note($note_name, $note_value);
        }
    }

    /**
     * 获取全部 HTTP 请求头信息
     * @return array
     */
    public static function requestHeaders()
    {
        return apache_request_headers();
    }

    /**
     * 重置 Apache 写入计时器
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public static function resetTimeout()
    {
        return apache_reset_timeout();
    }

    /**
     * 获得全部 HTTP 响应头信息
     * @return array
     */
    public static function responseHeaders()
    {
        return apache_response_headers();
    }

    /**
     * 设置 Apache 子进程环境变量
     * @param string $variable 将被设置的环境变量。
     * @param string $value 新 variable 值。
     * @param bool $walk_to_top 是否将所设置的顶层变量应用到所有 Apache 层。
     * @return bool
     */
    public static function setenv($variable, $value, $walk_to_top = false)
    {
        return apache_setenv($variable, $value, $walk_to_top);
    }
}