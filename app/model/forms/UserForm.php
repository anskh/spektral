<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class UserForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formUser', 'nama', $isEdit);
        $this->addProperty('nama', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Nama');
        $this->addProperty('nip', self::TYPE_STRING, [[self::RULE_LENGTH, 18], self::RULE_NUMERIC], 'NIP');
        $this->addProperty('jabatan', self::TYPE_STRING, [[self::RULE_MIN_LENGTH, 3]], 'Jabatan');
        $this->addProperty('instansi', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Instansi');
        $this->addProperty('tingkat', self::TYPE_STRING, self::RULE_REQUIRED, 'Tingkat');
        $this->addProperty('nomor_wa', self::TYPE_STRING, [[self::RULE_MIN_LENGTH, 10], self::RULE_NUMERIC], 'Nomor HP');
        $this->addProperty('password', self::TYPE_STRING, null, 'Password');
        $this->addProperty('repassword', self::TYPE_STRING, [self::RULE_MATCH_FIELD, 'password'], 'Ulangi Password');
        $this->addProperty('captcha', self::TYPE_STRING, self::RULE_CAPTCHA, 'Kode Keamanan');
    }
}
