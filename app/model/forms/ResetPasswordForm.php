<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class ResetPasswordForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formResetPassword', 'password', $isEdit);
        $this->addProperty('password', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 6], 'Password Baru');
        $this->addProperty('repassword', self::TYPE_STRING, [self::RULE_MATCH_FIELD, 'password'], 'Ulangi Password Baru');
        $this->addProperty('captcha', self::TYPE_STRING, self::RULE_CAPTCHA, 'Kode keamanan');
    }
}
