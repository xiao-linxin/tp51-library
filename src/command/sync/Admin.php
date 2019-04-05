<?php

namespace library\command\sync;

use library\command\Sync;

/**
 * 系统模块更新指令
 * Class UpdateAdmin
 * @package app\admin\logic\update
 */
class Admin extends Sync
{
    protected function configure()
    {
        $this->modules = ['application/admin/', 'think'];
        $this->setName('xsync:admin')->setDescription('synchronize update admin module files');
    }
}