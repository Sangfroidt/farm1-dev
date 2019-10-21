<?php

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;

class CompanyPresenter extends Nette\Application\UI\Presenter
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


    // Company:show
    public function renderShow($companyId)
    {
        $company = $this->database->table('companies')->get($companyId);
        // $this->template->company = $this->database->table('companies')->get($companyId);

        if (!$company) {
            $this->error('This company does not exist');
        }

        $this->template->company = $company;
    }

    // Company:create    
    protected function createComponentCompanyCreateForm()
    {
        $form = new Form;

        // $form->addText('user_id', 'user_id:')
        //     ->setDisabled(TRUE);
        $userId = $this->user->getIdentity()->user_id;

        $form->addHidden('user_id', 'user_id')
            ->setDefaultValue($userId);

        $form->addText('company_name', 'Company name:')
            ->setRequired();
        
        // $form->addText('company_country', 'Country:')
        //     ->setRequired();

        $form->addSelect('company_country', 'Country:', ['Afghanistan' => 'Afghanistan', 'Åland Islands' => 'Åland Islands', 'Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra', 'Angola' => 'Angola', 'Anguilla' => 'Anguilla', 'Antarctica' => 'Antarctica', 'Antigua & Barbuda' => 'Antigua & Barbuda', 'Argentina' => 'Argentina', 'Armenia' => 'Armenia', 'Aruba' => 'Aruba', 'Ascension Island' => 'Ascension Island', 'Australia' => 'Australia', 'Austria' => 'Austria', 'Azerbaijan' => 'Azerbaijan', 'Bahamas' => 'Bahamas', 'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh', 'Barbados' => 'Barbados', 'Belarus' => 'Belarus', 'Belgium' => 'Belgium', 'Belize' => 'Belize', 'Benin' => 'Benin', 'Bermuda' => 'Bermuda', 'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia', 'Bosnia & Herzegovina' => 'Bosnia & Herzegovina', 'Botswana' => 'Botswana', 'Brazil' => 'Brazil', 'British Indian Ocean Territory' => 'British Indian Ocean Territory', 'British Virgin Islands' => 'British Virgin Islands', 'Brunei' => 'Brunei', 'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso', 'Burundi' => 'Burundi', 'Cambodia' => 'Cambodia', 'Cameroon' => 'Cameroon', 'Canada' => 'Canada', 'Canary Islands' => 'Canary Islands', 'Cape Verde' => 'Cape Verde', 'Caribbean Netherlands' => 'Caribbean Netherlands', 'Cayman Islands' => 'Cayman Islands', 'Central African Republic' => 'Central African Republic', 'Ceuta & Melilla' => 'Ceuta & Melilla', 'Chad' => 'Chad', 'Chile' => 'Chile', 'China' => 'China', 'Christmas Island' => 'Christmas Island', 'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands', 'Colombia' => 'Colombia', 'Comoros' => 'Comoros', 'Congo - Brazzaville' => 'Congo - Brazzaville', 'Congo - Kinshasa' => 'Congo - Kinshasa', 'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica', 'Côte d\’Ivoire' => 'Côte d\’Ivoire', 'Croatia' => 'Croatia', 'Cuba' => 'Cuba', 'Curaçao' => 'Curaçao', 'Cyprus' => 'Cyprus', 'Czechia' => 'Czechia', 'Denmark' => 'Denmark', 'Diego Garcia' => 'Diego Garcia', 'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica', 'Dominican Republic' => 'Dominican Republic', 'Ecuador' => 'Ecuador', 'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador', 'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea', 'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia', 'Eurozone' => 'Eurozone', 'Falkland Islands' => 'Falkland Islands', 'Faroe Islands' => 'Faroe Islands', 'Fiji' => 'Fiji', 'Finland' => 'Finland', 'France' => 'France', 'French Guiana' => 'French Guiana', 'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories', 'Gabon' => 'Gabon', 'Gambia' => 'Gambia', 'Georgia' => 'Georgia', 'Germany' => 'Germany', 'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar', 'Greece' => 'Greece', 'Greenland' => 'Greenland', 'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe', 'Guam' => 'Guam', 'Guatemala' => 'Guatemala', 'Guernsey' => 'Guernsey', 'Guinea' => 'Guinea', 'Guinea-Bissau' => 'Guinea-Bissau', 'Guyana' => 'Guyana', 'Haiti' => 'Haiti', 'Honduras' => 'Honduras', 'Hong Kong SAR China' => 'Hong Kong SAR China', 'Hungary' => 'Hungary', 'Iceland' => 'Iceland', 'India' => 'India', 'Indonesia' => 'Indonesia', 'Iran' => 'Iran', 'Iraq' => 'Iraq', 'Ireland' => 'Ireland', 'Isle of Man' => 'Isle of Man', 'Israel' => 'Israel', 'Italy' => 'Italy', 'Jamaica' => 'Jamaica', 'Japan' => 'Japan', 'Jersey' => 'Jersey', 'Jordan' => 'Jordan', 'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya', 'Kiribati' => 'Kiribati', 'Kosovo' => 'Kosovo', 'Kuwait' => 'Kuwait', 'Kyrgyzstan' => 'Kyrgyzstan', 'Laos' => 'Laos', 'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon', 'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia', 'Libya' => 'Libya', 'Liechtenstein' => 'Liechtenstein', 'Lithuania' => 'Lithuania', 'Luxembourg' => 'Luxembourg', 'Macau SAR China' => 'Macau SAR China', 'Macedonia' => 'Macedonia', 'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi', 'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives', 'Mali' => 'Mali', 'Malta' => 'Malta', 'Marshall Islands' => 'Marshall Islands', 'Martinique' => 'Martinique', 'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius', 'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico', 'Micronesia' => 'Micronesia', 'Moldova' => 'Moldova', 'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia', 'Montenegro' => 'Montenegro', 'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco', 'Mozambique' => 'Mozambique', 'Myanmar (Burma)' => 'Myanmar (Burma)', 'Namibia' => 'Namibia', 'Nauru' => 'Nauru', 'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands', 'New Caledonia' => 'New Caledonia', 'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua', 'Niger' => 'Niger', 'Nigeria' => 'Nigeria', 'Niue' => 'Niue', 'Norfolk Island' => 'Norfolk Island', 'North Korea' => 'North Korea', 'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway', 'Oman' => 'Oman', 'Pakistan' => 'Pakistan', 'Palau' => 'Palau', 'Palestinian Territories' => 'Palestinian Territories', 'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay', 'Peru' => 'Peru', 'Philippines' => 'Philippines', 'Pitcairn Islands' => 'Pitcairn Islands', 'Poland' => 'Poland', 'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico', 'Qatar' => 'Qatar', 'Réunion' => 'Réunion', 'Romania' => 'Romania', 'Russia' => 'Russia', 'Rwanda' => 'Rwanda', 'Samoa' => 'Samoa', 'San Marino' => 'San Marino', 'São Tomé & Príncipe' => 'São Tomé & Príncipe', 'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal', 'Serbia' => 'Serbia', 'Seychelles' => 'Seychelles', 'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore', 'Sint Maarten' => 'Sint Maarten', 'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia', 'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia', 'South Africa' => 'South Africa', 'South Georgia & South Sandwich Islands' => 'South Georgia & South Sandwich Islands', 'South Korea' => 'South Korea', 'South Sudan' => 'South Sudan', 'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka', 'St. Barthélemy' => 'St. Barthélemy', 'St. Helena' => 'St. Helena', 'St. Kitts & Nevis' => 'St. Kitts & Nevis', 'St. Lucia' => 'St. Lucia', 'St. Martin' => 'St. Martin', 'St. Pierre & Miquelon' => 'St. Pierre & Miquelon', 'St. Vincent & Grenadines' => 'St. Vincent & Grenadines', 'Sudan' => 'Sudan', 'Suriname' => 'Suriname', 'Svalbard & Jan Mayen' => 'Svalbard & Jan Mayen', 'Swaziland' => 'Swaziland', 'Sweden' => 'Sweden', 'Switzerland' => 'Switzerland', 'Syria' => 'Syria', 'Taiwan' => 'Taiwan', 'Tajikistan' => 'Tajikistan', 'Tanzania' => 'Tanzania', 'Thailand' => 'Thailand', 'Timor-Leste' => 'Timor-Leste', 'Togo' => 'Togo', 'Tokelau' => 'Tokelau', 'Tonga' => 'Tonga', 'Trinidad & Tobago' => 'Trinidad & Tobago', 'Tristan da Cunha' => 'Tristan da Cunha', 'Tunisia' => 'Tunisia', 'Turkey' => 'Turkey', 'Turkmenistan' => 'Turkmenistan', 'Turks & Caicos Islands' => 'Turks & Caicos Islands', 'Tuvalu' => 'Tuvalu', 'U.S. Outlying Islands' => 'U.S. Outlying Islands', 'U.S. Virgin Islands' => 'U.S. Virgin Islands', 'Uganda' => 'Uganda', 'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates', 'United Kingdom' => 'United Kingdom', 'United Nations' => 'United Nations', 'United States' => 'United States', 'Uruguay' => 'Uruguay', 'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Vatican City' => 'Vatican City', 'Venezuela' => 'Venezuela', 'Vietnam' => 'Vietnam', 'Wallis & Futuna' => 'Wallis & Futuna', 'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen', 'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe'])
            ->setPrompt('Select from list...')->setRequired();

        $form->addText('company_city', 'City:')
        ->setRequired();

        // $form->addCheckboxList('company_type', 'Type:', ['Afghanistan' => 'Afghanistan', 'Åland Islands' => 'Åland Islands', 'Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra', 'Angola' => 'Angola'])
        //     // ->setPrompt('Select from list...')
        //     ->setRequired();

        $form->addTextArea('company_excerpt', 'Short description:')
            ->setRequired();

        $form->addTextArea('company_description', 'Full description:')
            ->setRequired();

        $form->addText('company_website', 'Website:')
            ->setRequired();

        $form->addText('company_twitter', 'Twitter:');

        $form->addText('company_facebook', 'Facebook:');

        $form->addText('company_instagram', 'Instagram:');

        $form->addText('company_linkedin', 'Linkedin:');

        $form->addEmail('company_email', 'Email:');

        $form->addSubmit('send', 'Add company');
        $form->onSuccess[] = [$this, 'companyCreateFormSucceeded'];

        return $form;
    }

        // Company:create -> success
        public function companyCreateFormSucceeded(Form $form, \stdClass $values)
        {
            $company = $this->database->table('companies')->insert($values);

            $this->flashMessage('Company was sucessfully added.', 'success');
            $this->redirect('show', $company->company_id);
        }

        public function actionCreate()
        {
            if (!$this->getUser()->isLoggedIn()) {
                $this->redirect('Sign:in');
            }
        }


    // Company:edit
    public function actionEdit($companyId)
    {
        $company = $this->database->table('companies')->get($companyId);

        if (!$company) {
            $this->error('This company does not exist');
        }

        $this->template->company = $company;
    }

    protected function createComponentCompanyEditForm()
    {
        $form = new Form;
        $form->addText('company_name', 'Company name:')
            ->setRequired()
            ->setDefaultValue($this->template->company->company_name);
        $form->addSelect('company_country', 'Country:', ['Afghanistan' => 'Afghanistan', 'Åland Islands' => 'Åland Islands', 'Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra', 'Angola' => 'Angola', 'Anguilla' => 'Anguilla', 'Antarctica' => 'Antarctica', 'Antigua & Barbuda' => 'Antigua & Barbuda', 'Argentina' => 'Argentina', 'Armenia' => 'Armenia', 'Aruba' => 'Aruba', 'Ascension Island' => 'Ascension Island', 'Australia' => 'Australia', 'Austria' => 'Austria', 'Azerbaijan' => 'Azerbaijan', 'Bahamas' => 'Bahamas', 'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh', 'Barbados' => 'Barbados', 'Belarus' => 'Belarus', 'Belgium' => 'Belgium', 'Belize' => 'Belize', 'Benin' => 'Benin', 'Bermuda' => 'Bermuda', 'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia', 'Bosnia & Herzegovina' => 'Bosnia & Herzegovina', 'Botswana' => 'Botswana', 'Brazil' => 'Brazil', 'British Indian Ocean Territory' => 'British Indian Ocean Territory', 'British Virgin Islands' => 'British Virgin Islands', 'Brunei' => 'Brunei', 'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso', 'Burundi' => 'Burundi', 'Cambodia' => 'Cambodia', 'Cameroon' => 'Cameroon', 'Canada' => 'Canada', 'Canary Islands' => 'Canary Islands', 'Cape Verde' => 'Cape Verde', 'Caribbean Netherlands' => 'Caribbean Netherlands', 'Cayman Islands' => 'Cayman Islands', 'Central African Republic' => 'Central African Republic', 'Ceuta & Melilla' => 'Ceuta & Melilla', 'Chad' => 'Chad', 'Chile' => 'Chile', 'China' => 'China', 'Christmas Island' => 'Christmas Island', 'Cocos (Keeling) Islands' => 'Cocos (Keeling) Islands', 'Colombia' => 'Colombia', 'Comoros' => 'Comoros', 'Congo - Brazzaville' => 'Congo - Brazzaville', 'Congo - Kinshasa' => 'Congo - Kinshasa', 'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica', 'Côte d\’Ivoire' => 'Côte d\’Ivoire', 'Croatia' => 'Croatia', 'Cuba' => 'Cuba', 'Curaçao' => 'Curaçao', 'Cyprus' => 'Cyprus', 'Czechia' => 'Czechia', 'Denmark' => 'Denmark', 'Diego Garcia' => 'Diego Garcia', 'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica', 'Dominican Republic' => 'Dominican Republic', 'Ecuador' => 'Ecuador', 'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador', 'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea', 'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia', 'Eurozone' => 'Eurozone', 'Falkland Islands' => 'Falkland Islands', 'Faroe Islands' => 'Faroe Islands', 'Fiji' => 'Fiji', 'Finland' => 'Finland', 'France' => 'France', 'French Guiana' => 'French Guiana', 'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories', 'Gabon' => 'Gabon', 'Gambia' => 'Gambia', 'Georgia' => 'Georgia', 'Germany' => 'Germany', 'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar', 'Greece' => 'Greece', 'Greenland' => 'Greenland', 'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe', 'Guam' => 'Guam', 'Guatemala' => 'Guatemala', 'Guernsey' => 'Guernsey', 'Guinea' => 'Guinea', 'Guinea-Bissau' => 'Guinea-Bissau', 'Guyana' => 'Guyana', 'Haiti' => 'Haiti', 'Honduras' => 'Honduras', 'Hong Kong SAR China' => 'Hong Kong SAR China', 'Hungary' => 'Hungary', 'Iceland' => 'Iceland', 'India' => 'India', 'Indonesia' => 'Indonesia', 'Iran' => 'Iran', 'Iraq' => 'Iraq', 'Ireland' => 'Ireland', 'Isle of Man' => 'Isle of Man', 'Israel' => 'Israel', 'Italy' => 'Italy', 'Jamaica' => 'Jamaica', 'Japan' => 'Japan', 'Jersey' => 'Jersey', 'Jordan' => 'Jordan', 'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya', 'Kiribati' => 'Kiribati', 'Kosovo' => 'Kosovo', 'Kuwait' => 'Kuwait', 'Kyrgyzstan' => 'Kyrgyzstan', 'Laos' => 'Laos', 'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon', 'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia', 'Libya' => 'Libya', 'Liechtenstein' => 'Liechtenstein', 'Lithuania' => 'Lithuania', 'Luxembourg' => 'Luxembourg', 'Macau SAR China' => 'Macau SAR China', 'Macedonia' => 'Macedonia', 'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi', 'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives', 'Mali' => 'Mali', 'Malta' => 'Malta', 'Marshall Islands' => 'Marshall Islands', 'Martinique' => 'Martinique', 'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius', 'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico', 'Micronesia' => 'Micronesia', 'Moldova' => 'Moldova', 'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia', 'Montenegro' => 'Montenegro', 'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco', 'Mozambique' => 'Mozambique', 'Myanmar (Burma)' => 'Myanmar (Burma)', 'Namibia' => 'Namibia', 'Nauru' => 'Nauru', 'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands', 'New Caledonia' => 'New Caledonia', 'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua', 'Niger' => 'Niger', 'Nigeria' => 'Nigeria', 'Niue' => 'Niue', 'Norfolk Island' => 'Norfolk Island', 'North Korea' => 'North Korea', 'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway', 'Oman' => 'Oman', 'Pakistan' => 'Pakistan', 'Palau' => 'Palau', 'Palestinian Territories' => 'Palestinian Territories', 'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay', 'Peru' => 'Peru', 'Philippines' => 'Philippines', 'Pitcairn Islands' => 'Pitcairn Islands', 'Poland' => 'Poland', 'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico', 'Qatar' => 'Qatar', 'Réunion' => 'Réunion', 'Romania' => 'Romania', 'Russia' => 'Russia', 'Rwanda' => 'Rwanda', 'Samoa' => 'Samoa', 'San Marino' => 'San Marino', 'São Tomé & Príncipe' => 'São Tomé & Príncipe', 'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal', 'Serbia' => 'Serbia', 'Seychelles' => 'Seychelles', 'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore', 'Sint Maarten' => 'Sint Maarten', 'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia', 'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia', 'South Africa' => 'South Africa', 'South Georgia & South Sandwich Islands' => 'South Georgia & South Sandwich Islands', 'South Korea' => 'South Korea', 'South Sudan' => 'South Sudan', 'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka', 'St. Barthélemy' => 'St. Barthélemy', 'St. Helena' => 'St. Helena', 'St. Kitts & Nevis' => 'St. Kitts & Nevis', 'St. Lucia' => 'St. Lucia', 'St. Martin' => 'St. Martin', 'St. Pierre & Miquelon' => 'St. Pierre & Miquelon', 'St. Vincent & Grenadines' => 'St. Vincent & Grenadines', 'Sudan' => 'Sudan', 'Suriname' => 'Suriname', 'Svalbard & Jan Mayen' => 'Svalbard & Jan Mayen', 'Swaziland' => 'Swaziland', 'Sweden' => 'Sweden', 'Switzerland' => 'Switzerland', 'Syria' => 'Syria', 'Taiwan' => 'Taiwan', 'Tajikistan' => 'Tajikistan', 'Tanzania' => 'Tanzania', 'Thailand' => 'Thailand', 'Timor-Leste' => 'Timor-Leste', 'Togo' => 'Togo', 'Tokelau' => 'Tokelau', 'Tonga' => 'Tonga', 'Trinidad & Tobago' => 'Trinidad & Tobago', 'Tristan da Cunha' => 'Tristan da Cunha', 'Tunisia' => 'Tunisia', 'Turkey' => 'Turkey', 'Turkmenistan' => 'Turkmenistan', 'Turks & Caicos Islands' => 'Turks & Caicos Islands', 'Tuvalu' => 'Tuvalu', 'U.S. Outlying Islands' => 'U.S. Outlying Islands', 'U.S. Virgin Islands' => 'U.S. Virgin Islands', 'Uganda' => 'Uganda', 'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates', 'United Kingdom' => 'United Kingdom', 'United Nations' => 'United Nations', 'United States' => 'United States', 'Uruguay' => 'Uruguay', 'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Vatican City' => 'Vatican City', 'Venezuela' => 'Venezuela', 'Vietnam' => 'Vietnam', 'Wallis & Futuna' => 'Wallis & Futuna', 'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen', 'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe'])
            ->setPrompt('Select from list...')
            ->setRequired()
            ->setDefaultValue($this->template->company->company_country);
        $form->addText('company_city', 'City:')
            ->setRequired()
            ->setDefaultValue($this->template->company->company_city);
        $form->addTextArea('company_website', 'Website:')
            ->setRequired()
            ->setDefaultValue($this->template->company->company_website);

        $form->addSubmit('send', 'Update company');
        $form->onSuccess[] = [$this, 'companyEditFormSucceeded'];

        return $form;
    }

         // Company:edit -> success
         public function companyEditFormSucceeded(Form $form, \stdClass $values)
         {
            $companyId = $this->getParameter('companyId');
 
            $company = $this->database->table('companies')->get($companyId);
            $company->update($values);

            $this->flashMessage('Company was sucessfully updated.', 'success');
            $this->redirect('show', $company->company_id);
         }

   
 
}
