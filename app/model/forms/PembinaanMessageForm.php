<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class PembinaanMessageForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formMessagePembinaan', 'message', $isEdit);
        $this->addProperty('message', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Pesan');
    }
}
