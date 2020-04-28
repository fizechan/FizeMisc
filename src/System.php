<?php

namespace fize\misc;

/**
 * 系统相关
 */
class System
{

    /**
     * 产生一条回溯跟踪(backtrace)
     *
     * 参数 `$options` :
     *   DEBUG_BACKTRACE_PROVIDE_OBJECT:是否填充 "object" 的索引;
     *   DEBUG_BACKTRACE_IGNORE_ARGS:是否忽略 "args" 的索引;
     * 参数 `$limit` :
     *   这个参数能够用于限制返回堆栈帧的数量。 默认为 (limit=0) ，返回所有的堆栈帧。
     * @param int $options 选项
     * @param int $limit   限制返回堆栈帧的数量
     * @return array
     */
    public static function debugBacktrace($options = 0, $limit = 0)
    {
        return debug_backtrace($options, $limit);
    }

    /**
     * 打印一条回溯。
     *
     * 参数 `$options` :
     *   DEBUG_BACKTRACE_IGNORE_ARGS 是否忽略 "args" 的索引
     * 参数 `$limit` :
     *   这个参数能够用于限制返回堆栈帧的数量。 默认为 (limit=0) ，返回所有的堆栈帧。
     * @param int $options 选项
     * @param int $limit   限制返回堆栈帧的数量
     */
    public static function debugPrintBacktrace($options = 0, $limit = 0)
    {
        debug_print_backtrace($options, $limit);
    }

    /**
     * 将一个字符串表示一个内部Zend值输出
     * @param mixed $variable 值
     */
    public static function debugZvalDump($variable)
    {
        debug_zval_dump($variable);
    }

    /**
     * 清除最近的错误
     * @since PHP7.0
     */
    public static function errorClearLast()
    {
        error_clear_last();
    }

    /**
     * 获取最后发生的错误
     * @return array
     */
    public static function errorGetLast()
    {
        return error_get_last();
    }

    /**
     * 发送错误信息到某个地方
     *
     * 参数 `$destination` :
     *   它的含义描述于以上，由 message_type 参数所决定。
     * @param string $message       应该被记录的错误信息。
     * @param int    $message_type  设置错误应该发送到何处0-4
     * @param string $destination   目标
     * @param string $extra_headers 额外的头。当 message_type 设置为 1 的时候使用
     * @return bool
     */
    public static function errorLog($message, $message_type = null, $destination = null, $extra_headers = null)
    {
        return error_log($message, $message_type, $destination, $extra_headers);
    }

    /**
     * 设置应该报告何种 PHP 错误
     * @param int $level 新的 error_reporting 级别
     * @return int 返回旧的 error_reporting 级别，或者在 level 参数未给出时返回当前的级别。
     */
    public static function errorReporting($level = null)
    {
        return error_reporting($level);
    }

    /**
     * 还原之前的错误处理函数
     * @return bool
     */
    public static function restoreErrorHandler()
    {
        return restore_error_handler();
    }

    /**
     * 恢复之前定义过的异常处理函数
     * @return bool
     */
    public static function restoreExceptionHandler()
    {
        return restore_exception_handler();
    }

    /**
     * 设置一个用户定义的错误处理函数
     * @param callable $error_handler 用户的函数
     * @param int      $error_types   指定错误类型
     * @return mixed
     */
    public static function setErrorHandler(callable $error_handler, $error_types = 30719)
    {
        return set_error_handler($error_handler, $error_types);
    }

    /**
     * 设置一个用户定义的异常处理函数。
     * @param callable $exception_handler 用户的函数
     * @return mixed
     */
    public static function set_exception_handler(callable $exception_handler)
    {
        return set_exception_handler($exception_handler);
    }

    /**
     * 产生一个用户级别的 error/warning/notice 信息
     * @param string $error_msg  该 error 的特定错误信息
     * @param int    $error_type 该 error 所特定的错误类型
     * @return bool
     */
    public static function triggerError($error_msg, $error_type = 1024)
    {
        return trigger_error($error_msg, $error_type);
    }

    /**
     * 产生一个用户级别的 error/warning/notice 信息
     *
     * 是 triggerError() 方法的别名
     * @param string $error_msg  该 error 的特定错误信息
     * @param int    $error_type 该 error 所特定的错误类型
     * @return bool
     */
    public static function userError($error_msg, $error_type = 1024)
    {
        return user_error($error_msg, $error_type);
    }
}
