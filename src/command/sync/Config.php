<?php

namespace library\command\sync;

use library\command\Sync;

/**
 * 更新系统配置指令
 * Class UpdateConfig
 * @package library\command\update
 */
class Config extends Sync
{
    protected function configure()
    {
        $this->modules = ['config/'];
        $this->setName('xsync:config')->setDescription('synchronize update config php files');
    }
}