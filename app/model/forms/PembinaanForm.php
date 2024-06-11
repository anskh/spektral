<?php

declare(strict_types=1);

namespace App\Model\Forms;

use Corephp\Model\FormModel;

class PembinaanForm extends FormModel
{
    public function __construct(bool $isEdit = false)
    {
        parent::__construct('formPembinaan', 'deskripsi', $isEdit);
        $this->addProperty('produsen_data', self::TYPE_INT, self::RULE_NUMERIC, 'Apakah instansi termasuk produsen data?');
        $this->addProperty('deskripsi', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Deskripsi pembinaan yang diperlukan');
        $this->addProperty('jenis', self::TYPE_INT, self::RULE_NUMERIC, 'Jenis media/model pembinaan');
        $this->addProperty('surat', self::TYPE_STRING, null, 'Surat pengantar');
        $this->addProperty('tanggal', self::TYPE_STRING, self::RULE_DATE, 'Tanggal');
        $this->addProperty('lokasi', self::TYPE_STRING, self::RULE_REQUIRED, 'Tempat');
        $this->addProperty('waktu', self::TYPE_STRING, self::RULE_TIME, 'Waktu');
        $this->addProperty('nama_pic', self::TYPE_STRING, [self::RULE_MIN_LENGTH, 3], 'Nama PIC');
        $this->addProperty('email_pic', self::TYPE_STRING, self::RULE_EMAIL, 'Email PIC');
        $this->addProperty('nomor_hp_pic', self::TYPE_STRING, [[self::RULE_MIN_LENGTH, 10], self::RULE_NUMERIC], 'Nomor HP PIC');
    }
}
