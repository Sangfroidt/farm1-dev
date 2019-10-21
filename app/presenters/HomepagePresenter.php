<?php

namespace App\Presenters;

use Nette;
use Nette\Security\User;

class HomepagePresenter extends Nette\Application\UI\Presenter
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

	public function renderDefault()
	{
		$this->template->companies = $this->database->table('companies')
			->order('company_id DESC')
			->limit(12);
	
		$this->template->events = $this->database->table('events')
			->order('event_id DESC')
			->limit(12);
	
		$this->template->jobs = $this->database->table('jobs')
			->order('job_id DESC')
			->limit(12);
	}
}








// final class HomepagePresenter extends BasePresenter
// {
// 	public function renderDefault()
// 	{
// 		$this->template->anyVariable = 'any value';
// 	}
// }
