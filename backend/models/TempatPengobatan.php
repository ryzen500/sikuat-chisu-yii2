<?php

namespace app\models;

class TempatPengobatan
{
    const SATU = 'Tidak Dirujuk';
    const DUA = 'Dirujuk ke Fasyankes';


    public static function getValues()
    {
        return [
            '1' => self::SATU,
            '2' => self::DUA,
        ];
    }
}
