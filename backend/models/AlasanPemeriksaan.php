<?php

namespace app\models;

class AlasanPemeriksaan
{
    const PEMERIKSAAN_ULANG = 'Pemeriksaan Ulang';
    const PEMERIKSAAN_DIAGNOSIS = 'Pemeriksaan Diagnosis';
    const AKHIR_PENGOBATAN = 'Akhir Pengobatan';
    const PEMERIKSAAN_DIAGNOSIS_BASELINE = 'Pemeriksaan diagnosis baseline';

    public static function getValues()
    {
        return [
            'pemeriksaan_ulang' => self::PEMERIKSAAN_ULANG,
            'pemeriksaan_diagnosis' => self::PEMERIKSAAN_DIAGNOSIS,
            'akhir_pengobatan' => self::AKHIR_PENGOBATAN,
            'pemeriksaan_diagnosis_baseline' => self::PEMERIKSAAN_DIAGNOSIS_BASELINE,
        ];
    }
}
