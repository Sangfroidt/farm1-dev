<?php

namespace App\Model;

use Nette;
use Nette\Application\UI\Form;

class EventsManager
// class EventsManager extends ???
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    // List events
    public function createComponentEventsShow($eventsCategory, $eventsLocation, $eventsSorting)
    {
        $this->template->events = $this->database->table('events') 
            ->where('event_type = ?', $eventsCategory)
            ->where('event_country = ?', $eventsLocation)
            ->order($eventsSorting)
            ->limit(12);
    }
}