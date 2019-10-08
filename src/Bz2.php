<?php
/**
 * bzip2文件操作类
 * @author FizeChan
 * @version V1.0.0.20170217
 */

namespace fize\misc;

class Bz2
{

    /**
     * bzip2 文件指针。
     * @var resource
     */
    private $bz = null;

    /**
     * 自定义错误，含键名 errno,errstr
     * @var array
     */
    private $_err = array();

    /**
     * windows环境下的UTF8字符串转GBK
     */
    const WIN_UTF8_2_GBK = 0;

    /**
     * windows环境下的GBK字符串转UTF8
     */
    const WIN_GBK_2_UTF8 = 1;

    /**
     * 构造
     * @param string $file 待打开的文件的文件名，或者已经存在的资源流。支持中文，指定文件不存在时将尝试创建
     * @param string $mode 和 fopen() 函数类似，但仅仅支持 'r'（读）和 'w'（写）。
     */
    public function __construct($file, $mode)
    {
        $file = self::stringSerialize($file, self::WIN_UTF8_2_GBK);
        $this->bz = self::open($file, $mode);
        if (empty($this->bz)) {
            $this->_err = array(
                'errno' => -1,
                'errstr' => '打开bzip2文件时发生错误'
            );
        }
    }

    /**
     * 析构函数
     */
    public function __destruct()
    {
        if ($this->bz) {
            $this->close();
        }
    }

    /**
     * 对要使用的路径进行中文兼容性处理
     * Windows、Linux系统针对中文字符创的兼容性处理
     * Windows由于使用GBK编码会导致中文路径乱码，进行UTF-8字符串转GBK字符串后再建立
     * @param string $path 待处理字符串
     * @param string $direction 方向 WIN_UTF8_2_GBK,WIN_GBK_2_UTF8
     * @return string 处理后字符串
     */
    private static function stringSerialize($path, $direction)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            if ($direction == self::WIN_UTF8_2_GBK) {
                $path = iconv('UTF-8', 'GBK', $path);
            } else if ($direction == self::WIN_GBK_2_UTF8) {
                $path = iconv('GBK', 'UTF-8', $path);
            }
        }
        return $path;
    }

    /**
     * 关闭bzip2文件
     * @return type
     */
    private function close()
    {
        return bzclose($this->bz);
    }

    /**
     * 把一个字符串压缩成 bzip2 编码数据
     * @param string $source 待压缩的字符串。
     * @param int $blocksize 指定压缩时使用的块大小，应该是一个 1-9 的数字。9 可以有最高的压缩比，但会使用更多的资源。
     * @param int $workfactor 控制压缩阶段出现最坏的重复性高的情况下输入数据时的行为。 该值可以是在 0 至 250 之间，0是一个特殊的情况。
     * @return mixed 压缩后的字符串，或者在出现错误时返回错误号。
     */
    public static function compress($source, $blocksize = 4, $workfactor = 0)
    {
        return bzcompress($source, $blocksize, $workfactor);
    }

    /**
     * 返回一个 bzip2 错误码
     * @return int
     */
    public function errno()
    {
        if (!empty($this->_err)) {
            return $this->_err['errno'];
        }
        return bzerrno($this->bz);
    }

    /**
     * 返回包含 bzip2 错误号和错误字符串的一个 array
     * @return array
     */
    public function error()
    {
        if (!empty($this->_err)) {
            return $this->_err;
        }
        return bzerror($this->bz);
    }

    /**
     * 返回一个 bzip2 的错误字符串
     * @return string
     */
    public function errstr()
    {
        if (!empty($this->_err)) {
            return $this->_err['errstr'];
        }
        return bzerrstr($this->bz);
    }

    /**
     * 强制写入所有写缓冲区的数据
     * @return boolean 成功时返回 TRUE， 或者在失败时返回 FALSE。
     */
    public function flush()
    {
        return bzflush($this->bz);
    }

    /**
     * 打开一个经 bzip2 压缩过的文件
     * @param string $filename 待打开的文件的文件名，或者已经存在的资源流。
     * @param string $mode 和 fopen() 函数类似，但仅仅支持 'r'（读）和 'w'（写）。 其他任何模式都会导致 bzopen 返回 FALSE。
     * @return resource 如果打开失败，bzopen() 会返回 FALSE，否则返回一个指向最新打开文件的指针。
     */
    public static function open($filename, $mode)
    {
        return bzopen($filename, $mode);
    }

    /**
     * 从文件读取数据。 读取到 length（未经压缩的长度）个字节，或者到文件尾，取决于先到哪个。
     * @param int $length 如果没有提供， bzread()  一次会读入 1024 个字节（未经压缩的长度）。 一次最大可读入 8192 个未压缩的字节。
     * @return string 返回解压的数据，在错误时返回 FALSE。
     */
    public function read($length = 1024)
    {
        return bzread($this->bz, $length);
    }

    /**
     * 二进制安全地写入 bzip2 文件,注意不能多次调用该方法，bz2文件是一次性写入并覆盖的
     * @param string $data 要写入的数据。
     * @param int $length 如果提供了这个参数，将仅仅写入 length（未压缩）个字节，若 data 小于该指定的长度则写入全部数据。
     * @return int 返回写入的数据字节数，错误时返回 FALSE 。
     */
    public function write($data, $length = null)
    {
        if ($length === null) {
            $rst = bzwrite($this->bz, $data);
        } else {
            $rst = bzwrite($this->bz, $data, $length);
        }
        return $rst;
    }
}