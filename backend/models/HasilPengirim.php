<?php

namespace app\models;

class HasilPengirim
{
    const Positif = 'Positif';
    const Negatif = 'Negatif';
    const TDL = 'Dr. Citra';

    public static function getValues()
    {
        return [
            'positif' => self::Positif,
            'negatif' => self::Negatif,
            'TDL' => self::TDL,
        ];
    }
}
