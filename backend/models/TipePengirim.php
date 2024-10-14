<?php

namespace app\models;

class TipePengirim
{
    const Bakteriologis = 'Terkonfirmasi bakteriologis';
    const klinis = 'Terdiagnosis klinis';

    public static function getValues()
    {
        return [
            'tb-bac' => self::Bakteriologis,
            'tb-clin' => self::klinis,
        ];
    }
}
