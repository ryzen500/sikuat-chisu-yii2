<?php

namespace app\models;

class TindakLanjut
{
    const KOSONG = 'Belum Mulai Pengobatan';
    const SATU = 'Akan diobati/dirujuk';
    const DUA = 'Lost to follow up sebelum Pengobatan';
    const TIGA = 'Meninggal Sebelum Pengobatan';
    const EMPAT = 'Menolak Pengobatan';
    const LIMA = 'Pengobatan Pencegahan';
    const ENAM = 'Melanjutkan Pengobatan Sebelumnya';


    public static function getValues()
    {
        return [
            '0' => self::KOSONG,
            '1' => self::SATU,
            '2' => self::DUA,
            '3' => self::TIGA,
            '4' => self::EMPAT,
            '5' => self::LIMA,
            '6' => self::ENAM,
        ];
    }
}
