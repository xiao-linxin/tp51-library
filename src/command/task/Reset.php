<?php

namespace library\command\task;

use library\command\Task;

/**
 * 守护进程重启
 * Class TaskRestart
 * @package library\command\task
 */
class Reset extends Task
{

    protected function configure()
    {
        $this->setName('xtask:reset')->setDescription('reset message queue daemon');
    }
    
    protected function execute(\think\console\Input $input, \think\console\Output $output)
    {
        if (($pid = $this->checkProcess()) > 0) {
            $this->closeProcess($pid);
            $output->info("message queue daemon {$pid} closed successfully!");
        }
        $this->createProcess();
        if ($pid = $this->checkProcess()) {
            $output->info("message queue daemon {$pid} created successfully!");
        } else {
            $output->error('message queue daemon creation failed, try again later!');
        }
    }
}