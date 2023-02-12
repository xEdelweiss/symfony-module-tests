<?php

namespace App\EventSubscriber;

use App\Event\HomeVisitedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HomeVisitedEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            HomeVisitedEvent::class => 'onHomeVisited',
        ];
    }

    public function onHomeVisited(HomeVisitedEvent $event)
    {
        // this listener was created to prevent HomeVisitedEvent to become orphaned
    }
}
