<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class DokumentasiForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formDokumentasi', 'judul', $isEdit);
        $this->addProperty('judul', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Judul');
        $this->addProperty('berita', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Isi Berita');
        $this->addProperty('is_active', self::TYPE_INT, $isEdit ? [self::RULE_IN_LIST, [0,1]] : null, 'Aktif');
        $this->addProperty('gambar', self::TYPE_STRING, null, 'File Gambar');
        $this->addProperty('pembinaan_id', self::TYPE_INT, null, 'ID Permintaan Pembinaan');
        $this->addProperty('tanggal', self::TYPE_STRING, self::RULE_DATE, 'Tanggal');
    }
}
