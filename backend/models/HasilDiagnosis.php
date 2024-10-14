<?php

namespace app\models;

class HasilDiagnosis
{
    const Positif = 'TBC SO';
    const Negatif = 'TBC RO';
    const BUKAN_TBC = 'Bukan TBC';

    public static function getValues()
    {
        return [
            '1' => self::Positif,
            '2' => self::Negatif,
            '3' => self::BUKAN_TBC,
        ];
    }
}
