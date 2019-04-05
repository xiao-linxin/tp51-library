<?php

namespace library\command\sync;

use library\command\Sync;

/**
 * Class UpdateService
 * @package app\admin\logic\update
 */
class Service extends Sync
{
    protected function configure()
    {
        $this->modules = ['application/service/'];
        $this->setName('xsync:service')->setDescription('synchronize update service module files');
    }
}