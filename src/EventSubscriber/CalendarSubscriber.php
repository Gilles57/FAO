<?php

namespace App\EventSubscriber;

use App\Repository\EvenementRepository;
use CalendarBundle\CalendarEvents;
use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    private $eventRepo;
    private $router;

    public function __construct(
        EvenementRepository $eventRepo,
        UrlGeneratorInterface $router
    ) {
        $this->eventRepo = $eventRepo;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
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

        $events = $this->eventRepo
            ->createQueryBuilder('e')
            ->where('e.beginAt BETWEEN :start and :end OR e.endAt BETWEEN :start and :end')
            ->setParameter('start', $start->format('Y-m-d H:i:s'))
            ->setParameter('end', $end->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        foreach ($events as $event) {
            // this create the events with your data (here booking data) to fill calendar
            $bookingEvent = new Event(
                $event->getVille()->getNom(),
                $event->getBeginAt(),
                $event->getEndAt() // If the end date is null or not defined, a all day event is created.
            );

            $bookingEvent->setOptions([
                'backgroundColor' => 'red',
                'borderColor' => 'red',
            ]);
//            $bookingEvent->addOption(
//                'url',
//                $this->router->generate('app_booking_show', [
//                    'id' => $event->getId(),
//                ])
//            );

            // finally, add the event to the CalendarEvent to fill the calendar
            $calendar->addEvent($bookingEvent);
//
//        $event = new Event(
//            'toto',
//            new \DateTimeImmutable('now'),
//            new \DateTimeImmutable('now + 2 days'),
//        );
//
//        // finally, add the event to the CalendarEvent to fill the calendar
//        $calendar->addEvent($event);
        }
    }
}
