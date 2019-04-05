<?php

namespace library\command\sync;

use library\command\Sync;

/**
 * 更新微信模块指令
 * Class UpdateWechat
 * @package app\admin\logic\update
 */
class Wechat extends Sync
{
    protected function configure()
    {
        $this->modules = ['application/wechat/'];
        $this->setName('xsync:wechat')->setDescription('synchronize update wechat module files');
    }
}