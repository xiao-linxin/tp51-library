<?php

namespace library\command\task;

use library\command\Task;

/**
 * Class TaskStart
 * @package library\command\task
 */
class Start extends Task
{

    protected function configure()
    {
        $this->setName('xtask:start')->setDescription('start message queue daemon');
    }
    
    protected function execute(\think\console\Input $input, \think\console\Output $output)
    {
        if (($pid = $this->checkProcess()) > 0) {
            $output->info("The message queue daemon {$pid} already exists!");
        } else {
            $this->createProcess();
            if (($pid = $this->checkProcess()) > 0) {
                $output->info("message queue daemon {$pid} created successfully!");
            } else {
                $output->error('message queue daemon creation failed, try again later!');
            }
        }
    }

}