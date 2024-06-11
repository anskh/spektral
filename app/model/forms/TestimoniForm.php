<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class TestimoniForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formTestimoni', 'pesan', $isEdit);
        $this->addProperty('pesan', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Pesan');
        $this->addProperty('rating', self::TYPE_INT, [[self::RULE_MIN, 1], [self::RULE_MAX, 5]], 'Rating');
        $this->addProperty('captcha', self::TYPE_STRING, self::RULE_CAPTCHA, 'Kode Keamanan');
    }
}
