<?php

namespace library\command\sync;

use library\command\Sync;

/**
 * 更新插件指令
 * Class UpdatePlugs
 * @package app\admin\logic\update
 */
class Plugs extends Sync
{
    protected function configure()
    {
        $this->modules = ['public/static/'];
        $this->setName('xsync:plugs')->setDescription('synchronize update plugs static files');
    }
}