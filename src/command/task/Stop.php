<?php

namespace library\command\task;

use library\command\Task;

/**
 * Class TaskStop
 * @package library\command\task
 */
class Stop extends Task
{

    protected function configure()
    {
        $this->setName('xtask:stop')->setDescription('stop message queue daemon');
    }

    protected function execute(\think\console\Input $input, \think\console\Output $output)
    {
        if (($pid = $this->checkProcess()) > 0) {
            $this->closeProcess($pid);
            $output->info("message queue daemon {$pid} closed successfully.");
        } else {
            $output->info('The message queue daemon is not running.');
        }
    }

}