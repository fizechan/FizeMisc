<?php
/** @noinspection PhpComposerExtensionStubsInspection */

namespace fize\misc;

/**
 * Enchant拼写检查类
 * @deprecated 实际使用情景并不多见,待删除
 */
class Enchant
{
    /**
     * @var resource 代理
     */
    private $broker;

    /**
     * @var resource 词典
     */
    private $dict;

    /**
     * 枚举赋值提供程序
     * @return array
     */
    public function brokerDescribe()
    {
        return enchant_broker_describe($this->broker);
    }

    /**
     * 使用非空标记告诉字典是否存在
     * @param string $tag 标识
     * @return bool
     */
    public function brokerDictExists($tag)
    {
        return enchant_broker_dict_exists($this->broker, $tag);
    }

    /**
     * 释放当前字典资源
     * @return bool
     */
    public function brokerFreeDict()
    {
        return enchant_broker_free_dict($this->dict);
    }

    /**
     * 释放代理资源及其字典
     * @return bool
     */
    public function brokerFree()
    {
        return enchant_broker_free($this->broker);
    }

    /**
     * 获取给定后端目录路径。
     *
     * 参数 `$dict_type` 可选值：ENCHANT_MYSPELL 或 ENCHANT_ISPELL.
     * @param int $dict_type 字典类型
     * @return string
     */
    public function brokerGetDictPath($dict_type)
    {
        return enchant_broker_get_dict_path($this->broker, $dict_type);
    }

    /**
     * 获取代理最后的错误信息
     * @return string
     */
    public function brokerGetError()
    {
        return enchant_broker_get_error($this->broker);
    }

    /**
     * 创建一个能够请求的代理对象
     * @return resource
     */
    public function brokerInit()
    {
        $this->broker = enchant_broker_init();
        return $this->broker;
    }

    /**
     * 返回包含详细信息的可用字典列表。
     * @return array
     */
    public function brokerListDicts()
    {
        return enchant_broker_list_dicts($this->broker);
    }

    /**
     * 使用标记创建一个新字典
     * @param string $tag 标识
     * @return resource
     */
    public function brokerRequestDict($tag)
    {
        $this->dict = enchant_broker_request_dict($this->broker, $tag);
        return $this->dict;
    }

    /**
     * 使用PWL文件创建字典
     * @param string $filename PWL文件
     * @return resource
     */
    public function brokerRequestPwlDict($filename)
    {
        $this->dict = enchant_broker_request_pwl_dict($this->broker, $filename);
        return $this->dict;
    }

    /**
     * 为给定后端设置目录路径
     *
     * 参数 `$dict_type` 可选值：ENCHANT_MYSPELL 或 ENCHANT_ISPELL.
     * @param int $dict_type 字典类型
     * @param string $value 字典目录的路径。
     */
    public function brokerSetDictPath($dict_type, $value)
    {
        return enchant_broker_set_dict_path($this->broker, $dict_type, $value);
    }

    /**
     * 声明要为该语言使用的词典的首选项
     *
     * 特殊的“*”标记可以用作语言标记来声明任何没有显式声明排序的语言的默认排序。
     * @param string $tag 语言标签
     * @param string $ordering 用逗号分隔的提供程序名称列表
     * @return bool
     */
    public function brokerSetOrdering($tag, $ordering)
    {
        return enchant_broker_set_ordering($this->broker, $tag, $ordering);
    }

    /**
     * 在个人单词列表中添加一个单词
     * @param string $word 要添加的单词
     */
    public function dictAddToPersonal($word)
    {
        enchant_dict_add_to_personal($this->dict, $word);
    }

    /**
     * 在当前会话中添加一个单词
     * @param string $word 要添加的单词
     */
    public function dictAddToSession($word)
    {
        enchant_dict_add_to_session($this->dict, $word);
    }

    /**
     * 检查一个单词的拼写是否正确
     * @param string $word 要检查的单词
     * @return bool
     */
    public function dictCheck($word)
    {
        return enchant_dict_check($this->dict, $word);
    }

    /**
     * 描述单个字典
     * @return array
     */
    public function dictDescribe()
    {
        return enchant_dict_describe($this->dict);
    }

    /**
     * 返回当前拼写会话的最后一个错误
     * @return string
     */
    public function dictGetError()
    {
        return enchant_dict_get_error($this->dict);
    }

    /**
     * 在这个拼写过程中是否存在“word”
     * @param string $word 要检查的单词
     * @return bool
     */
    public function dictIsInSession($word)
    {
        return enchant_dict_is_in_session($this->dict, $word);
    }

    /**
     * 检查单词拼写是否正确，并提供建议
     * @param string $word 要检查的单词
     * @param array $suggestions 如果单词拼写不正确，这个变量将包含一个建议数组。
     * @return bool
     */
    public function dictQuickCheck($word, array &$suggestions = null)
    {
        return enchant_dict_quick_check($this->dict, $word, $suggestions);
    }

    /**
     * 为一个单词加一个改正
     * @param string $mis 要修正的单词
     * @param string $cor 使用该词替换
     */
    public function dictStoreReplacement($mis, $cor)
    {
        enchant_dict_store_replacement($this->dict, $mis, $cor);
    }

    /**
     * 如果单词拼写错误，将返回一个建议数组。
     * @param string $word 要检查的单词
     * @return array
     */
    public function dictSuggest($word)
    {
        return enchant_dict_suggest($this->dict, $word);
    }
}