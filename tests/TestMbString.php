<?php /** @noinspection PhpComposerExtensionStubsInspection */


use fize\misc\MbString;
use PHPUnit\Framework\TestCase;


class TestMbString extends TestCase
{

    public function testCheckEncoding()
    {
        $rst = MbString::checkEncoding("\x00\xE3", "UTF-8");
        var_dump($rst);
        self::assertIsBool($rst);
    }

    public function testChr()
    {
        $chr = MbString::chr(49, 'UTF-8');
        var_dump($chr);
        self::assertIsString($chr);
    }

    public function testConvertCase()
    {
        $str = 'I am A Chinese!';

        $str1 = MbString::convertCase($str, MB_CASE_UPPER);
        self::assertEquals($str1, 'I AM A CHINESE!');

        $str2 = MbString::convertCase($str, MB_CASE_LOWER);
        self::assertEquals($str2, 'i am a chinese!');

        $str3 = MbString::convertCase($str, MB_CASE_TITLE);
        self::assertEquals($str3, 'I Am A Chinese!');
    }

    public function testConvertEncoding()
    {
        $str = '我是中国人!';
        $str1 = MbString::convertEncoding($str, 'UTF-8');
        var_dump($str1);
        self::assertIsString($str1);
    }

    public function testConvertKana()
    {
        $str = 'kana';
        $str = MbString::convertKana($str, "KVC");
        var_dump($str);
        self::assertIsString($str);
    }

    public function testConvertVariables()
    {
        $str1 = '1';
        $str2 = '二';
        $str3 = 'three';
        $rst = MbString::convertVariables('GBK', 'UTF-8', $str1, $str2, $str3);
        var_dump($rst);
        var_dump($str1);
        var_dump($str2);
        var_dump($str3);
        self::assertEquals($rst, 'UTF-8');
    }

    public function testDecodeMimeheader()
    {
        $mime = MbString::decodeMimeheader("Subject: =?UTF-8?B?UHLDvGZ1bmcgUHLDvGZ1bmc=?=");
        var_dump($mime);
        self::assertIsString($mime);
    }

    public function testDecodeNumericentity()
    {
        $convmap = [ 0x0, 0xffff, 0, 0xffff ];
        $msg = '';
        for ($i=0; $i < 1000; $i++) {
            //$msg .= MbString::decodeNumericentity('&#'.$i.';', $convmap, 'UTF-8');
            $msg .= MbString::decodeNumericentity('&#'.$i.';', $convmap);
        }
        var_dump($msg);
        self::assertIsString($msg);
    }

    public function testDetectEncoding()
    {
        $encoding = MbString::detectEncoding('我是中国人', "auto");
        var_dump($encoding);
        self::assertIsString($encoding);
    }

    public function testDetectOrder()
    {
        $rst1 = MbString::detectOrder("eucjp-win,sjis-win,UTF-8");
        var_dump($rst1);
        self::assertIsBool($rst1);

        $ary[] = "ASCII";
        $ary[] = "JIS";
        $ary[] = "EUC-JP";
        $rst2 = MbString::detectOrder($ary);
        var_dump($rst2);
        self::assertIsBool($rst2);

        $rst3 = MbString::detectOrder();
        var_dump($rst3);
        self::assertIsArray($rst3);
    }

    public function testEncodeMimeheader()
    {
        $name = ""; // kanji
        $mbox = "kru";
        $doma = "gtinn.mon";
        $addr = MbString::encodeMimeheader($name, "UTF-7", "Q") . " <" . $mbox . "@" . $doma . ">";
        var_dump($addr);
        self::assertIsString($addr);
    }

    public function testEncodeNumericentity()
    {
        $str1 = '待编码字符串';
        $convmap = array(0x80, 0xff, 0, 0xff);
        $str2 = MbString::encodeNumericentity($str1, $convmap, "ISO-8859-1");
        var_dump($str2);
        self::assertIsString($str2);
    }

    public function testEncodingAliases()
    {
        $encoding = 'ASCII';
        $aliases = MbString::encodingAliases($encoding);
        var_dump($aliases);
        self::assertIsArray($aliases);
    }

    public function testEregMatch()
    {
        $needle = "[";
        $haystack = "some_array[]";
        $test = MbString::eregMatch('.*'.preg_quote($needle), $haystack);
        self::assertTrue($test);
    }

    public function testEregReplaceCallback()
    {

    }

    public function testLanguage()
    {

    }

    public function testStrrpos()
    {

    }



    public function testSubstr()
    {

    }

    public function testOutputHandler()
    {

    }



    public function testRegexSetOptions()
    {

    }

    public function testEregSearchRegs()
    {

    }

    public function testRegexEncoding()
    {

    }

    public function testStrrchr()
    {

    }

    public function testStrtolower()
    {

    }





    public function testStrripos()
    {

    }

    public function testStripos()
    {

    }

    public function testEregSearchSetpos()
    {

    }



    public function testOrd()
    {

    }

    public function testScrub()
    {

    }



    public function testEregReplace()
    {

    }

    public function testListEncodings()
    {

    }

    public function testPreferredMimeName()
    {

    }

    public function testStrstr()
    {

    }



    public function testSubstrCount()
    {

    }

    public function testHttpInput()
    {

    }

    public function testStrrichr()
    {

    }



    public function testStristr()
    {

    }

    public function testSendMail()
    {

    }

    public function testSubstituteCharacter()
    {

    }



    public function testEregSearchPos()
    {

    }

    public function testEregSearch()
    {

    }

    public function testInternalEncoding()
    {

    }







    public function testSplit()
    {

    }

    public function testStrcut()
    {

    }

    public function testStrtoupper()
    {

    }

    public function testEregi()
    {

    }





    public function testStrwidth()
    {

    }

    public function testEregiReplace()
    {

    }

    public function testStrpos()
    {

    }

    public function testHttpOutput()
    {

    }



    public function testEregSearchInit()
    {

    }

    public function testStrlen()
    {

    }

    public function testEregSearchGetregs()
    {

    }

    public function testGetInfo()
    {

    }

    public function testParseStr()
    {

    }

    public function testEregSearchGetpos()
    {

    }

    public function testStrimwidth()
    {

    }

    public function testEreg()
    {

    }
}
