<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class ModulForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formModul', 'nama', $isEdit);
        $this->addProperty('nama', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Nama');
        $this->addProperty('deskripsi', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Deskripsi');
        $this->addProperty('kategori', self::TYPE_INT, self::RULE_NUMERIC, 'Kategori');
        $this->addProperty('link', self::TYPE_STRING, null, 'File');
    }
}
