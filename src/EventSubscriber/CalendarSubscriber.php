<?php

namespace App\EventSubscriber;

use App\Repository\PointRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public function __construct(private PointRepository       $pointRepository,
                                private UrlGeneratorInterface $router
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // You may want to make a custom query from your database to fill the calendar
        $points = $this->pointRepository->findAll();


        foreach ($points as $p) {
            $pointEvent = new Event(
                $p->getNom(),
                $p->getBeginAt(),
                $p->getEndAt()
            );
            $pointEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
//            $pointEvent->addOption(
//                'url',
//                $this->router->generate('app_event_show', [
//                    'id' => $p->getId(),
//                ])
//            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($pointEvent);
        }

        $calendar->addEvent(new Event(
            'Event 1',
            new \DateTime('Tuesday this week'),
            new \DateTime()
        ));

//         If the end date is null or not defined, it creates a all day event
        $calendar->addEvent(new Event(
            'All day event',
            new \DateTime('Friday this week')
        ));
    }

}
