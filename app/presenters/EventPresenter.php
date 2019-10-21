<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class EventPresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Database\Context */
    private $database;

    /** @var User */
    private $user;

    public function __construct(Nette\Database\Context $database, User $user)
    {
        $this->database = $database;
        $this->user = $user;
    }

    // Event:show
    public function renderShow($eventId)
    {
        $event = $this->database->table('events')->get($eventId);
        // $this->template->event = $this->database->table('events')->get($eventId);

        if (!$event) {
            $this->error('This event does not exist');
        }

        $this->template->event = $event;
    }

    // Event:create

    protected function createComponentEventCreateForm()
    {
        $form = new Form;
        $userId = $this->user->getIdentity()->user_id;

        $form->addHidden('user_id', 'user_id')
            ->setDefaultValue($userId);


        $form->addText('event_name', 'Event name:')
            ->setRequired();
        $form->addText('event_city', 'City:')
            ->setRequired();
        $form->addText('event_country', 'Country:')
            ->setRequired();
        $form->addTextArea('event_website', 'Website:')
            ->setRequired();

        $form->addSubmit('send', 'Add event');
        $form->onSuccess[] = [$this, 'eventCreateFormSucceeded'];

        return $form;
    }

        // Event:create -> success
        public function eventCreateFormSucceeded(Form $form, \stdClass $values)
        {
            $event = $this->database->table('events')->insert($values);

            $this->flashMessage('Event was sucessfully added.', 'success');
            $this->redirect('show', $event->event_id);
        }

    // Event:edit
    public function actionEdit($eventId)
    {
        $event = $this->database->table('events')->get($eventId);

        if (!$event) {
            $this->error('This event does not exist');
        }

        $this->template->event = $event;
    }

    protected function createComponentEventEditForm()
    {
        $form = new Form;
        $form->addText('event_name', 'Event name:')
            ->setRequired()
            ->setDefaultValue($this->template->event->event_name);
        $form->addText('event_city', 'City:')
            ->setRequired()
            ->setDefaultValue($this->template->event->event_city);
        $form->addText('event_country', 'Country:')
            ->setRequired()
            ->setDefaultValue($this->template->event->event_country);
        $form->addTextArea('event_website', 'Website:')
            ->setRequired()
            ->setDefaultValue($this->template->event->event_website);

        $form->addSubmit('send', 'Update event');
        $form->onSuccess[] = [$this, 'eventEditFormSucceeded'];

        return $form;
    }

        // Event:edit -> success
        public function eventEditFormSucceeded(Form $form, \stdClass $values)
        {
            $eventId = $this->getParameter('eventId');
 
            $event = $this->database->table('events')->get($eventId);
            $event->update($values);

            $this->flashMessage('Event was sucessfully updated.', 'success');
            $this->redirect('show', $event->event_id);
        }   
}
