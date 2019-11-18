<?php
/** @noinspection PhpComposerExtensionStubsInspection */

namespace fize\misc;

/**
 * iconv 编码类
 */
class Iconv
{

    /**
     * windows环境下的UTF8字符串转GBK
     * @deprecated 不再直接提供该方法
     */
    const WIN_UTF8_2_GBK = 0;

    /**
     * windows环境下的GBK字符串转UTF8
     * @deprecated 不再直接提供该方法
     */
    const WIN_GBK_2_UTF8 = 1;

    /**
     * 禁止构造
     */
    private function __construct()
    {
    }

    /**
     * 获取 iconv 扩展的内部配置变量
     *
     * 参数 `$type` :
     *   可选值：all、input_encoding、output_encoding、internal_encoding
     * @param string $type 类型
     * @return array|string 返回当前内部配置变量的值。
     */
    public static function getEncoding($type = "all")
    {
        return iconv_get_encoding($type);
    }

    /**
     * 一次性解码多个 MIME 头字段
     *
     * 参数 `$mode` :
     *   可选值：ICONV_MIME_DECODE_STRICT、ICONV_MIME_DECODE_CONTINUE_ON_ERROR
     * 参数 `$charset` :
     *   如果省略了，将使用 iconv.internal_encoding。
     * @param string $encoded_headers 编码过的头字符串。
     * @param int $mode 决定了遇到畸形 MIME 头字段时的行为
     * @param string $charset 指定编码
     * @return array
     */
    public static function mimeDecodeHeaders($encoded_headers, $mode = 0, $charset = null)
    {
        if (is_null($charset)) {
            return iconv_mime_decode_headers($encoded_headers, $mode);
        }
        return iconv_mime_decode_headers($encoded_headers, $mode, $charset);
    }

    /**
     * 解码一个MIME头字段
     *
     * 参数 `$mode` :
     *   可选值：ICONV_MIME_DECODE_STRICT、ICONV_MIME_DECODE_CONTINUE_ON_ERROR
     * 参数 `$charset` :
     *   如果省略了，将使用 iconv.internal_encoding。
     * 如果在解码过程中出现一个错误,将返回FALSE .
     * @param string $encoded_header 编码头,是一个字符串.
     * @param int $mode 决定了遇到畸形 MIME 头字段时的行为
     * @param string $charset 指定编码
     * @return string 如果解码成功,返回一个被解码的MIME字段,
     */
    public static function mimeDecode($encoded_header, $mode = 0, $charset = null)
    {
        if (is_null($charset)) {
            return iconv_mime_decode($encoded_header, $mode);
        }
        return iconv_mime_decode($encoded_header, $mode, $charset);
    }

    /**
     * 编码一个MIME头
     * @param string $field_name 名
     * @param string $field_value 值
     * @param array $preferences 可选参数
     * @return string 返回编码后的字符串
     */
    public static function mimeEncode($field_name, $field_value, array $preferences = null)
    {
        return iconv_mime_encode($field_name, $field_value, $preferences);
    }

    /**
     * 为字符编码转换设定当前设置
     *
     * 参数 `$type` :
     *   可选值：input_encoding、output_encoding、internal_encoding
     * @param string $type 类型
     * @param string $charset 字符集。
     * @return bool 成功时返回 TRUE， 或者在失败时返回 FALSE。
     * @deprecated 自PHP5.6开始该方法已弃用
     */
    public static function setEncoding($type, $charset)
    {
        return iconv_set_encoding($type, $charset);
    }

    /**
     * 返回字符串的字符数统计
     *
     * 参数 `$charset` :
     *   如果省略了 charset 参数，假设 str 的编码为 iconv.internal_encoding。
     * @param string $str 该字符串
     * @param string $charset 编码
     * @return int 返回 str 字符数的统计。
     */
    public static function strlen($str, $charset = null)
    {
        if (is_null($charset)) {
            return iconv_strlen($str);
        }
        return iconv_strlen($str, $charset);
    }

    /**
     * 查找字符串首次出现的位置
     *
     * 参数 `$charset` :
     *   如果省略了 charset 参数，假设 str 的编码为 iconv.internal_encoding。
     * @param string $haystack 要寻找的字符
     * @param string $needle 被查找的字符串
     * @param int $offset 偏移
     * @param string $charset 编码
     * @return int
     */
    public static function strpos($haystack, $needle, $offset = 0, $charset = null)
    {
        if (is_null($charset)) {
            return iconv_strpos($haystack, $needle, $offset);
        }
        return iconv_strpos($haystack, $needle, $offset, $charset);
    }

    /**
     * 从右查找字符串首次出现的位置
     *
     * 参数 `$charset` :
     *   如果省略了 charset 参数，假设 str 的编码为 iconv.internal_encoding。
     * @param string $haystack 要寻找的字符
     * @param string $needle 被查找的字符串
     * @param string $charset 编码
     * @return int
     */
    public static function strrpos($haystack, $needle, $charset = null)
    {
        if (is_null($charset)) {
            return iconv_strrpos($haystack, $needle);
        }
        return iconv_strrpos($haystack, $needle, $charset);
    }

    /**
     * 截取字符串的部分
     *
     * 参数 `$charset` :
     *   如果省略了 charset 参数，假设 str 的编码为 iconv.internal_encoding。
     * 如果 str 比 offset 字符数更短，将会返回 FALSE。 如果 str 是 offset 个字符的长度，将返回空字符串。
     * @param string $str 原始字符串。
     * @param int $offset 偏移
     * @param int $length 指定长度
     * @param string $charset 编码
     * @return string 返回 offset 和 length 参数指定的 str 的部分。
     */
    public static function substr($str, $offset, $length = null, $charset = null)
    {
        if (is_null($length)) {
            return iconv_substr($str, $offset);
        }
        if (is_null($charset)) {
            return iconv_substr($str, $offset, $length);
        }
        return iconv_substr($str, $offset, $length, $charset);
    }

    /**
     * 将字符串 str 从 in_charset 转换编码到 out_charset。
     * @deprecated 建议直接使用iconv原生函数
     * @param string $in_charset 输入的字符集。
     * @param string $out_charset 输出的字符集。
     * @param string $str 要转换的字符串。
     * @return string
     */
    public static function iconv($in_charset, $out_charset, $str)
    {
        return iconv($in_charset, $out_charset, $str);
    }

    /**
     * 对要使用的字符串进行中文兼容性处理
     *
     * Windows、Linux系统针对中文字符创的兼容性处理
     * Windows由于使用GBK编码会导致中文路径乱码，进行UTF-8字符串转GBK字符串后再建立
     * @param string $str 待处理字符串
     * @param string $direction 方向 WIN_UTF8_2_GBK,WIN_GBK_2_UTF8
     * @return string 处理后字符串
     * @deprecated PHP7中已对中文乱码进行了处理，该方法将废弃
     */
    public static function serialize($str, $direction)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            if ($direction == self::WIN_UTF8_2_GBK) {
                $str = iconv('UTF-8', 'GBK', $str);
            } else if ($direction == self::WIN_GBK_2_UTF8) {
                $str = iconv('GBK', 'UTF-8', $str);
            }
        }
        return $str;
    }

    /**
     * 方向 WIN_UTF8_2_GBK
     * @param string $str 待处理字符串
     * @return string
     * @deprecated PHP7中已对中文乱码进行了处理，该方法将废弃
     */
    public static function winUtf8ToGbk($str)
    {
        return self::serialize($str, self::WIN_UTF8_2_GBK);
    }

    /**
     * 方向 WIN_GBK_2_UTF8
     * @param string $str 待处理字符串
     * @return string
     * @deprecated PHP7中已对中文乱码进行了处理，该方法将废弃
     */
    public static function winGbkToUtf8($str)
    {
        return self::serialize($str, self::WIN_GBK_2_UTF8);
    }
}