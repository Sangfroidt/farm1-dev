<?php

namespace App\Model;

use Nette;
use Nette\Application\UI\Form;

class JobsManager
// class JobsManager extends ???
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    // List jobs
    public function createComponentJobsShow($jobsCategory, $jobsLocation, $jobsSorting)
    {
        $this->template->jobs = $this->database->table('jobs')
            ->order($jobsSorting)
            ->where('job_type = ?', $jobsCategory)
            ->where('job_country = ?', $jobsLocation)
            ->limit(12);
    }
}
