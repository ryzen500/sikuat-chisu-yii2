<?php

namespace app\models;

class JenisPemeriksaan
{
    const MIKROSKOPIS = 'Pemeriksaan Mikroskopis';
    const TCM = 'Pemeriksaan Xpert (TCM)';

    public static function getValues()
    {
        return [
            'mikroskopis' => self::MIKROSKOPIS,
            'tcm' => self::TCM,
        ];
    }
}
