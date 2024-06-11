<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class EditTestimoniForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formEditTestimoni', 'is_active', $isEdit);
        $this->addProperty('is_active', self::TYPE_INT, [self::RULE_IN_LIST, [0,1]], 'Status');
    }
}
