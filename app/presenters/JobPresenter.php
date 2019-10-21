<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class JobPresenter extends Nette\Application\UI\Presenter
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

    // Job:show
    public function renderShow($jobId)
    {
        $job = $this->database->table('jobs')->get($jobId);
        // $this->template->job = $this->database->table('jobs')->get($jobId);

        if (!$job) {
            $this->error('This job does not exist');
        }

        $this->template->job = $job;
    }

    // Job:create
    protected function createComponentJobCreateForm()
    {
        $form = new Form;

        $userId = $this->user->getIdentity()->user_id;

        $form->addHidden('user_id', 'user_id')
            ->setDefaultValue($userId);


        $form->addText('job_name', 'job name:')
            ->setRequired();
        $form->addText('job_city', 'City:')
            ->setRequired();
        $form->addText('job_country', 'Country:')
            ->setRequired();
        $form->addTextArea('job_website', 'Website:')
            ->setRequired();

        $form->addSubmit('send', 'Add job');
        $form->onSuccess[] = [$this, 'jobCreateFormSucceeded'];

        return $form;
    }

        // Job:create -> success
        public function jobCreateFormSucceeded(Form $form, \stdClass $values)
        {
            $job = $this->database->table('jobs')->insert($values);

            $this->flashMessage('Job was sucessfully added.', 'success');
            $this->redirect('show', $job->job_id);
        }

    // Job:edit
    public function actionEdit($jobId)
    {
        $job = $this->database->table('jobs')->get($jobId);

        if (!$job) {
            $this->error('This job does not exist');
        }

        $this->template->job = $job;
    }

    protected function createComponentJobEditForm()
    {
        $form = new Form;
        $form->addText('job_name', 'job name:')
            ->setRequired()
            ->setDefaultValue($this->template->job->job_name);
        $form->addText('job_city', 'City:')
            ->setRequired()
            ->setDefaultValue($this->template->job->job_city);
        $form->addText('job_country', 'Country:')
            ->setRequired()
            ->setDefaultValue($this->template->job->job_country);
        $form->addTextArea('job_website', 'Website:')
            ->setRequired()
            ->setDefaultValue($this->template->job->job_website);

        $form->addSubmit('send', 'Update job');
        $form->onSuccess[] = [$this, 'jobEditFormSucceeded'];

        return $form;
    }

        // Job:edit -> success
        public function jobEditFormSucceeded(Form $form, \stdClass $values)
        {
            $jobId = $this->getParameter('jobId');
 
            $job = $this->database->table('jobs')->get($jobId);
            $job->update($values);

            $this->flashMessage('Job was sucessfully updated.', 'success');
            $this->redirect('show', $job->job_id);
        }   
}
