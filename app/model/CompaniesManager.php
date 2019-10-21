<?php

namespace App\Model;

use Nette;
use Nette\Application\UI\Form;

class CompaniesManager
// class CompaniesManager extends ???
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    // List companies
    public function createComponentCompaniesShow($companiesCategory, $companiesLocation, $companiesSorting)
    {
        $this->template->companies = $this->database->table('companies')
            ->where('company_status = 1')
            ->where('company_type = ?', $companiesCategory)
            ->where('company_country = ?', $companiesLocation)
            ->order($companiesSorting)
            ->limit(12);
    }
}