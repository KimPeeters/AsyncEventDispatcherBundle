<?php

namespace Qwad\Bundle\AsyncEventDispatcherBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('qwad:asyncevent:dispach')
            ->setDescription('Do not use!!')
            ->addArgument('eventname', InputArgument::REQUIRED, '')
            ->addArgument('event', InputArgument::REQUIRED, '')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $eventname = $input->getArgument('eventname');
        $event = $input->getArgument('event');
        $event = base64_decode($event);
        $event = unserialize($event);
        $this->getContainer()->get('event_dispatcher')->dispatch($eventname,$event);
    }
}
