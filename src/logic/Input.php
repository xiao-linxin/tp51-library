<?php

namespace library\logic;

use library\Controller;

/**
 * 输入管理器
 * Class Input
 * @package library\logic
 */
class Input extends Logic
{

    /**
     * 验证器规则
     * @var array
     */
    protected $rule;

    /**
     * 待验证的数据
     * @var array
     */
    protected $data;

    /**
     * 验证结果消息
     * @var array
     */
    protected $info;

    /**
     * Validate constructor.
     * @param array $data 验证数据
     * @param array $rule 验证规则
     * @param array $info 验证消息
     */
    public function __construct($data, $rule = [], $info = [])
    {
        list($this->rule, $this->info) = [$rule, $info];
        $this->data = $this->parse($data);
    }

    /**
     * 解析输入数据
     * @param array|string $data
     * @param array $result
     * @return array
     */
    private function parse($data, $result = [])
    {
        if (is_array($data)) return $data;
        if (is_string($data)) {
            foreach (explode(',', $data) as $field) {
                if (strpos($field, '|') === false) {
                    $array = explode('.', $field);
                    $result[array_pop($array)] = input($field);
                } else {
                    list($key, $value) = explode('|', $field);
                    $array = explode('.', $key);
                    $result[array_pop($array)] = input($key, $value);
                }
            }
            return $result;
        }
    }

    /**
     * 应用初始化
     * @param Controller $controller
     * @return array
     */
    public function init(Controller $controller)
    {
        $this->controller = $controller;
        $validate = \think\Validate::make($this->rule, $this->info);
        if ($validate->check($this->data)) return $this->data;
        $this->controller->error($validate->getError());
    }

}