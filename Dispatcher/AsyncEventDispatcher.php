<?php
/**
 * User: kpeeters
 * Date: 27-5-14
 * Time: 14:08
  */

namespace Qwad\Bundle\AsyncEventDispatcherBundle\Dispatcher;


use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\Event;
use JMS\JobQueueBundle\Entity\Job;

class AsyncEventDispatcher
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function dispatch($eventName, Event $event = null)
    {
        if (null === $event) {
            $event = new Event();
        }

        $data = array($eventName,base64_encode(serialize($event)));

        $job = new Job('qwad:asyncevent:dispach', $data);
        $this->em->persist($job);
        $this->em->flush($job);
    }
} 