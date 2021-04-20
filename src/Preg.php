<?php

namespace fize\misc;

/**
 * 正则
 */
class Preg
{

    /**
     * 执行一个正则表达式搜索和替换
     *
     * Preg::filter() 等价于 Preg::replace() 除了它仅仅返回(可能经过转化)与目标匹配的结果
     * 参数 `$replacement` :
     *   如果这个参数是一个字符串，并且pattern 是一个数组，那么所有的模式都使用这个字符串进行替换。
     *   如果pattern和replacement 都是数组，每个pattern使用replacement中对应的 元素进行替换。
     *   如果replacement中的元素比pattern中的少， 多出来的pattern使用空字符串进行替换。
     * 参数 `$subject` :
     *   如果subject是一个数组，搜索和替换回在subject 的每一个元素上进行, 并且返回值也会是一个数组。
     * 如果没有找到匹配或者发生了错误，当subject是数组 时返回一个空数组，其他情况返回NULL。
     * @param mixed $pattern     要搜索的模式。可以使一个字符串或字符串数组。
     * @param mixed $replacement 用于替换的字符串或字符串数组。
     * @param mixed $subject     要进行搜索和替换的字符串或字符串数组。
     * @param int   $limit       每个模式在每个subject上进行替换的最大次数。默认是 -1(无限)。
     * @param int   $count       如果指定，将会被填充为完成的替换次数。
     * @return string|string[]|null 如果subject是一个数组，返回一个数组， 其他情况返回一个字符串。
     */
    public static function filter($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        return preg_filter($pattern, $replacement, $subject, $limit, $count);
    }

    /**
     * 返回匹配模式的数组条目
     *
     * 参数 `$flags` :
     *   如果设置为PREG_GREP_INVERT, 这个函数返回输入数组中与给定模式pattern不匹配的元素组成的数组。
     * @param string $pattern 要搜索的模式
     * @param array  $input   输入数组
     * @param int    $flags   标识
     * @return array
     */
    public static function grep($pattern, array $input, $flags = 0)
    {
        return preg_grep($pattern, $input, $flags);
    }

    /**
     * 返回最后一个PCRE正则执行产生的错误代码
     * @return int
     */
    public static function lastError()
    {
        return preg_last_error();
    }

    /**
     * 执行一个全局正则表达式匹配
     * @param string $pattern 要搜索的模式，字符串形式。
     * @param string $subject 输入字符串。
     * @param array  $matches 多维数组，作为输出参数输出所有匹配结果
     * @param int    $flags   数组排序通过flags指定。
     * @param int    $offset  用于从目标字符串中指定位置开始搜索(单位是字节)。
     * @return int 返回完整匹配次数（可能是0），或者如果发生错误返回FALSE。
     */
    public static function matchAll($pattern, $subject, array &$matches = null, $flags = 1, $offset = 0)
    {
        return preg_match_all($pattern, $subject, $matches, $flags, $offset);
    }

    /**
     * 执行一个正则表达式匹配
     *
     * 参数 `$matches` :
     *   如果提供了参数matches，它将被填充为搜索结果。
     *   $matches[0]将包含完整模式匹配到的文本， $matches[1] 将包含第一个捕获子组匹配到的文本，以此类推。
     * 参数 `$$offset` :
     *   可选参数 offset 用于 指定从目标字符串的某个未知开始搜索(单位是字节)。
     * 返回值将是0次（不匹配）或1次，因为Preg::match()在第一次匹配后 将会停止搜索。
     * @param string $pattern 要搜索的模式，字符串形式。
     * @param string $subject 输入字符串。
     * @param array  $matches 搜索结果
     * @param int    $flags   flags可以被设置为以下标记值： PREG_OFFSET_CAPTURE
     * @param int    $offset  偏移位置
     * @return int 返回 pattern 的匹配次数
     */
    public static function match($pattern, $subject, array &$matches = null, $flags = 0, $offset = 0)
    {
        return preg_match($pattern, $subject, $matches, $flags, $offset);
    }

    /**
     * 转义正则表达式字符
     *
     * 参数 `$delimiter` :
     *   如果指定了可选参数 delimiter，它也会被转义。
     *   这通常用于 转义PCRE函数使用的分隔符。 /是最通用的分隔符。
     * @param string $str       输入字符串
     * @param string $delimiter 分隔符
     * @return string 返回转义后的字符串。
     */
    public static function quote($str, $delimiter = null)
    {
        return preg_quote($str, $delimiter);
    }

    /**
     * 使用回调执行正则表达式搜索和替换
     *
     * 参数 `$limit` :
     *   每个主题字符串中每个模式的最大可能替换。默认为-1(没有限制)。
     * @param array $patterns_and_callbacks 关联数组将模式(键)映射到回调(值)。
     * @param mixed $subject                要搜索和替换字符串的字符串或数组。
     * @param int   $limit                  最大可能替换次数
     * @param int   $count                  返回被替换的次数
     * @return string|string[]|null
     */
    public static function replaceCallbackArray(array $patterns_and_callbacks, $subject, $limit = -1, &$count = null)
    {
        return preg_replace_callback_array($patterns_and_callbacks, $subject, $limit, $count);
    }

    /**
     * 执行一个正则表达式搜索并且使用一个回调进行替换
     *
     * 参数 `$limit` :
     *   对于每个模式用于每个 subject 字符串的最大可替换次数。 默认是-1（无限制）。
     * @param mixed          $pattern  要搜索的模式，可以使字符串或一个字符串数组。
     * @param callable|array $callback 一个回调函数，在每次需要替换时调用
     * @param mixed          $subject  要搜索替换的目标字符串或字符串数组。
     * @param int            $limit    最大可替换次数
     * @param int            $count    如果指定，这个变量将被填充为替换执行的次数。
     * @return string|string[]|null 如果subject是一个数组， preg_replace_callback()返回一个数组，其他情况返回字符串。 错误发生时返回 NULL。
     */
    public static function replaceCallback($pattern, $callback, $subject, $limit = -1, &$count = null)
    {
        return preg_replace_callback($pattern, $callback, $subject, $limit, $count);
    }

    /**
     * 执行一个正则表达式的搜索和替换
     *
     * 参数 `$replacement` :
     *   如果这个参数是一个字符串，并且pattern 是一个数组，那么所有的模式都使用这个字符串进行替换。
     *   如果pattern和replacement 都是数组，每个pattern使用replacement中对应的 元素进行替换。
     *   如果replacement中的元素比pattern中的少， 多出来的pattern使用空字符串进行替换。
     * 参数 `$limit` :
     *   每个模式在每个subject上进行替换的最大次数。默认是 -1(无限)。
     * 如果匹配被查找到，替换后的subject被返回，其他情况下 返回没有改变的 subject。如果发生错误，返回 NULL 。
     * @param mixed $pattern     要搜索的模式。可以使一个字符串或字符串数组。
     * @param mixed $replacement 用于替换的字符串或字符串数组。
     * @param mixed $subject     要进行搜索和替换的字符串或字符串数组。
     * @param int   $limit       替换的最大次数
     * @param int   $count       如果指定，将会被填充为完成的替换次数。
     * @return string|string[]|null 如果subject是一个数组， preg_replace()返回一个数组， 其他情况下返回一个字符串。
     */
    public static function replace($pattern, $replacement, $subject, $limit = -1, &$count = null)
    {
        return preg_replace($pattern, $replacement, $subject, $limit, $count);
    }

    /**
     * 通过一个正则表达式分隔字符串
     *
     * 参数 `$limit` ：
     *   如果指定，将限制分隔得到的子串最多只有limit个，返回的最后一个 子串将包含所有剩余部分。
     *   limit值为-1， 0或null时都代表"不限制"。
     *   作为php的标准，你可以使用null跳过对flags的设置。
     * 参数 `$flags` ：
     *   可以是任何下面标记的组合(以位或运算 | 组合)：
     *   PREG_SPLIT_NO_EMPTY、PREG_SPLIT_DELIM_CAPTURE、PREG_SPLIT_OFFSET_CAPTURE
     * @param string $pattern 用于搜索的模式
     * @param string $subject 输入字符串
     * @param int    $limit   最大次数
     * @param int    $flags   flags 标识
     * @return array 返回一个使用 pattern 边界分隔 subject 后得到 的子串组成的数组。
     */
    public static function split($pattern, $subject, $limit = -1, $flags = 0)
    {
        return preg_split($pattern, $subject, $limit, $flags);
    }
}
