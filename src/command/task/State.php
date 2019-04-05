<?php

namespace library\command\task;

use library\command\Task;

/**
 * Class TaskState
 * @package library\command\task
 */
class State extends Task
{

    protected function configure()
    {
        $this->setName('xtask:state')->setDescription('view message queue daemon');
    }
    
    protected function execute(\think\console\Input $input, \think\console\Output $output)
    {
        if (($pid = $this->checkProcess()) > 0) {
            $output->info("message queue daemon {$pid} is runing.");
        } else {
            $output->info('The message queue daemon is not running.');
        }
    }

}