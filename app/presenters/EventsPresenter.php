<?php

namespace App\Presenters;

use Nette;

class EventsPresenter extends Nette\Application\UI\Presenter
{
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function renderDefault()
	{
		$this->template->events = $this->database->table('events')
			->order('event_id DESC')
			->limit(12);

	}
}