<?php

namespace App\Presenters;

use Nette;
use Nette\Security\User;

class DashboardPresenter extends Nette\Application\UI\Presenter
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
		if ($this->user->isLoggedIn()) {
			$userId = $this->user->getIdentity()->user_id;
		
			$this->template->companies = $this->database->table('companies')
				->order('company_id DESC')
				->limit(1)
				->where('user_id = ?', $userId);
		
			$this->template->events = $this->database->table('events')
				->order('event_id DESC')
				->limit(5)
				->where('user_id = ?', $userId);
		
			$this->template->jobs = $this->database->table('jobs')
				->order('job_id DESC')
				->limit(5)
				->where('user_id = ?', $userId);
		} else {
			$this->flashMessage('You need to be logged in.', 'error');
			$this->redirect('Sign:in');	
		}



		
	}
}








// final class HomepagePresenter extends BasePresenter
// {
// 	public function renderDefault()
// 	{
// 		$this->template->anyVariable = 'any value';
// 	}
// }
