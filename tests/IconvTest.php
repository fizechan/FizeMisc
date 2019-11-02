<?php
/** @noinspection PhpComposerExtensionStubsInspection */


use fize\misc\Iconv;
use PHPUnit\Framework\TestCase;

class IconvTest extends TestCase
{
    public function testGetEncoding()
    {
        $encoding = Iconv::getEncoding();
        var_dump($encoding);
        self::assertIsArray($encoding);

        $encoding = Iconv::getEncoding('input_encoding');
        var_dump($encoding);
        self::assertIsString($encoding);

        $encoding = Iconv::getEncoding('output_encoding');
        var_dump($encoding);
        self::assertIsString($encoding);

        $encoding = Iconv::getEncoding('internal_encoding');
        var_dump($encoding);
        self::assertIsString($encoding);
    }

    public function testMimeDecodeHeaders()
    {
        $sUrl = 'http://www.baidu.com';
        $oCurl = curl_init();
        $header[] = "Content-type: application/x-www-form-urlencoded";
        $user_agent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36";
        curl_setopt($oCurl, CURLOPT_URL, $sUrl);
        curl_setopt($oCurl, CURLOPT_HTTPHEADER,$header);
        curl_setopt($oCurl, CURLOPT_HEADER, true);
        curl_setopt($oCurl, CURLOPT_NOBODY, true);
        curl_setopt($oCurl, CURLOPT_USERAGENT,$user_agent);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($oCurl, CURLOPT_POST, false);
        $sContent = curl_exec($oCurl);
        $headerSize = curl_getinfo($oCurl, CURLINFO_HEADER_SIZE);
        $header = substr($sContent, 0, $headerSize);
        curl_close($oCurl);
        echo $header;

        $headers = Iconv::mimeDecodeHeaders($header);
        var_dump($headers);
        self::assertIsArray($headers);
    }

    public function testMimeDecode()
    {
        $mime = Iconv::mimedecode("Subject: =?UTF-8?B?UHLDvGZ1bmcgUHLDvGZ1bmc=?=", 0, "ISO-8859-1");
        var_dump($mime);
        self::assertIsString($mime);
    }

    public function testMimeEncode()
    {
        $preferences = [
            "input-charset" => "ISO-8859-1",
            "output-charset" => "UTF-8",
            "line-length" => 76,
            "line-break-chars" => "\n"
        ];
        $preferences["scheme"] = "B";
        $mime = Iconv::mimeEncode("Subject", "Prüfung Prüfung", $preferences);
        var_dump($mime);
        self::assertIsString($mime);
    }

    public function testSetEncoding()
    {
        $result = Iconv::setEncoding('input_encoding', 'UTF-8');
        self::assertTrue($result);

        $result = Iconv::setEncoding('output_encoding', 'UTF-8');
        self::assertTrue($result);

        $result = Iconv::setEncoding('internal_encoding', 'UTF-8');
        self::assertTrue($result);
    }

    public function testStrlen()
    {
        $str1 = '我是中国人!';
        $len1 = Iconv::strlen($str1);
        var_dump($len1);
        self::assertEquals($len1, 6);

        $str2 = '我是中国人！';
        $len2 = Iconv::strlen($str2);
        var_dump($len2);
        self::assertEquals($len2, 6);

        $str3 = 'ABCEDF123456';
        $len3 = Iconv::strlen($str3);
        var_dump($len3);
        self::assertEquals($len3, 12);
    }

    public function testStrpos()
    {
        $str1 = '我是中国人！';
        $pos1 = Iconv::strpos($str1, '中国');
        self::assertEquals($pos1, 2);

        $str2 = 'abcABC123';
        $pos2 = Iconv::strpos($str2, 'C1');
        self::assertEquals($pos2, 5);
    }

    public function testStrrpos()
    {
        $str1 = '我是中国人,我有颗中国心！';
        $pos1 = Iconv::strrpos($str1, '中国');
        self::assertEquals($pos1, 9);

        $str2 = 'abcABC123C123';
        $pos2 = Iconv::strrpos($str2, 'C1');
        self::assertEquals($pos2, 9);
    }

    public function testSubstr()
    {
        $str1 = '我是中国人!';
        $sub1 = Iconv::substr($str1, 2, 2);
        var_dump($sub1);
        self::assertEquals($sub1, '中国');

        $str3 = 'ABCEDF123456';
        $sub2 = Iconv::substr($str3, 6, 6);
        var_dump($sub2);
        self::assertEquals($sub2, '123456');
    }

    public function testIconv()
    {
        $str1 = '我是中国人！';
        $str2 = iconv('UTF-8', 'GBK', $str1);
        $str3 = iconv('GBK', 'UTF-8', $str2);
        self::assertNotEquals($str1, $str2);
        self::assertEquals($str1, $str3);
    }

    public function testSerialize()
    {

    }

    public function testWinUtf8ToGbk()
    {

    }

    public function testWinGbkToUtf8()
    {

    }

}
