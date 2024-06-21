<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class EmailForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formEmail', 'nama', $isEdit);
        $this->addProperty('nama', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Nama');
        $this->addProperty('email', self::TYPE_STRING, self::RULE_EMAIL, 'Email');
        $this->addProperty('pesan', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Pesan');
        $this->addProperty('server', self::TYPE_STRING, null, 'Server');
        $this->addProperty('user', self::TYPE_STRING, null, 'User');
        $this->addProperty('password', self::TYPE_STRING, null, 'Password');
        $this->addProperty('port', self::TYPE_INT, null, 'Port');
    }
}
