<?php
/** @noinspection PhpComposerExtensionStubsInspection */


use fize\misc\Enchant;
use PHPUnit\Framework\TestCase;

/**
 * Class TestEnchant
 * @todo 待测试
 */
class TestEnchant extends TestCase
{

    public function testBrokerDescribe()
    {
        $enchant = new Enchant();
        $enchant->brokerInit();
        $describe = $enchant->brokerDescribe();
        var_dump($describe);
        self::assertIsArray($describe);
    }

    public function testBrokerDictExists()
    {
        $tag = 'en_US';
        $enchant = new Enchant();
        $enchant->brokerInit();
        $exists = $enchant->brokerDictExists($tag);
        var_dump($exists);
        self::assertTrue($exists);
    }

    public function testBrokerSetDictPath()
    {

    }

    public function testDictSuggest()
    {

    }

    public function testDictGetError()
    {

    }

    public function testDictAddToPersonal()
    {

    }

    public function testBrokerFreeDict()
    {

    }

    public function testBrokerGetDictPath()
    {
        $enchant = new Enchant();
        $enchant->brokerInit();
        $enchant->brokerSetDictPath(ENCHANT_MYSPELL, __DIR__ . '/data/dict/myspell');

        $dict_path = $enchant->brokerGetDictPath(ENCHANT_MYSPELL);
        var_dump($dict_path);

        self::assertNotEmpty($dict_path);
    }

    public function testBrokerListDicts()
    {
        $enchant = new Enchant();
        $enchant->brokerInit();
        $dicts = $enchant->brokerListDicts();
        var_dump($dicts);
    }

    public function testDictQuickCheck()
    {

    }

    public function testBrokerSetOrdering()
    {

    }

    public function testBrokerGetError()
    {

    }

    public function testDictAddToSession()
    {

    }

    public function testBrokerFree()
    {

    }

    public function testDictCheck()
    {

    }

    public function testBrokerInit()
    {
        $enchant = new Enchant();
        $broker = $enchant->brokerInit();
        self::assertIsResource($broker);
    }

    public function testBrokerRequestDict()
    {
        $tag = 'en_US';

    }

    public function testBrokerRequestPwlDict()
    {

    }

    public function testDictIsInSession()
    {

    }

    public function testDictDescribe()
    {

    }

    public function testDictStoreReplacement()
    {

    }
}
