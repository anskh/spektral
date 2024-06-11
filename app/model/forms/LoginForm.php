<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class LoginForm extends FormModel
{    
    /**
     * __construct
     *
     * @param  mixed $isEdit
     * @return void
     */
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formLogin', 'email', $isEdit);
        $this->addProperty('email', self::TYPE_STRING, self::RULE_EMAIL, 'Email');
        $this->addProperty('password', self::TYPE_STRING, self::RULE_REQUIRED, 'Password');
        $this->addProperty('captcha', self::TYPE_STRING, self::RULE_CAPTCHA, 'Kode Keamanan');
    }
}
