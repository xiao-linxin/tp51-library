<?php

namespace library\command;

use think\console\Command;

/**
 * 清理无效的会话文件
 * Class Session
 * @package library\command
 */
class Sess extends Command
{

    protected function configure()
    {
        $this->setName('xclean:session')->setDescription('clean up invalid session files');
    }

    protected function execute(\think\console\Input $input, \think\console\Output $output)
    {
        $output->writeln('Start cleaning up invalid session files');
        foreach (glob(config('session.path') . 'sess_*') as $file) {
            list($fileatime, $filesize) = [fileatime($file), filesize($file)];
            if ($filesize < 1 || $fileatime < time() - 3600) {
                $output->writeln('clear session file -> [ ' . date('Y-m-d H:i:s', $fileatime) . ' ] ' . basename($file) . " {$filesize}");
                @unlink($file);
            }
        }
        $output->writeln('Complete cleaning of invalid session files');
    }

}