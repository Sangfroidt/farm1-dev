<?php

namespace App\Presenters;

use Nette;

class JobsPresenter extends Nette\Application\UI\Presenter
{
	/** @var Nette\Database\Context */
	private $database;

	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function renderDefault()
	{
		$this->template->jobs = $this->database->table('jobs')
			->order('job_id DESC')
			->limit(12);

	}
}