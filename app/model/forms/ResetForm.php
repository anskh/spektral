<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class ResetForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formReset', 'email', $isEdit);
        $this->addProperty('email', self::TYPE_STRING, self::RULE_EMAIL, 'Email');
        $this->addProperty('captcha', self::TYPE_STRING, self::RULE_CAPTCHA, 'Kode keamanan');
    }
}
