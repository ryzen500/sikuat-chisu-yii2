<?php

namespace app\models;

use backend\Concerns\WorkingWithTBModels;
use backend\Contracts\TBInterface;
use Yii;

/**
 * This is the model class for table "tb_kasus".
 *
 * @property string $id
 * @property string|null $KD_PELAYANAN
 * @property string|null $KD_PASIEN
 * @property string|null $KD_PUSKESMAS
 * @property string|null $tanggal_hasil
 * @property string|null $thorax_tanggal
 * @property string|null $thorax_hasil
 * @property string|null $thorax_kesan
 * @property string|null $lokasi_anatomi
 * @property string|null $hasil_diagnosis
 * @property string|null $tindak_lanjut
 * @property string|null $tempat_pengobatan
 * @property string|null $dirujuk_ke
 * @property int|null $ID_KUNJUNGAN
 * @property string|null $tipe_diagnosis
 * @property string|null $satusehat_response
 */
class TbKasus extends \yii\db\ActiveRecord implements TBInterface
{
    use WorkingWithTBModels;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_kasus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id'], 'required'],
            [[ 'satusehat_response'], 'string'],
            [['tanggal_hasil', 'thorax_tanggal'], 'safe'],
            [['ID_KUNJUNGAN'], 'default', 'value' => null],
            [['ID_KUNJUNGAN'], 'integer'],
            [['KD_PELAYANAN', 'KD_PASIEN', 'KD_PUSKESMAS', 'tipe_diagnosis'], 'string', 'max' => 20],
            [['thorax_hasil', 'thorax_kesan', 'lokasi_anatomi', 'hasil_diagnosis', 'tindak_lanjut', 'tempat_pengobatan', 'dirujuk_ke'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'KD_PELAYANAN' => 'Kd Pelayanan',
            'KD_PASIEN' => 'Kd Pasien',
            'KD_PUSKESMAS' => 'Kd Puskesmas',
            'tanggal_hasil' => 'Tanggal Hasil',
            'thorax_tanggal' => 'Thorax Tanggal',
            'thorax_hasil' => 'Thorax Hasil',
            'thorax_kesan' => 'Thorax Kesan',
            'lokasi_anatomi' => 'Lokasi Anatomi',
            'hasil_diagnosis' => 'Hasil Diagnosis',
            'tindak_lanjut' => 'Tindak Lanjut',
            'tempat_pengobatan' => 'Tempat Pengobatan',
            'dirujuk_ke' => 'Dirujuk Ke',
            'ID_KUNJUNGAN' => 'Id Kunjungan',
            'tipe_diagnosis' => 'Tipe Diagnosis',
            'satusehat_response' => 'Satusehat Response',
        ];
    }
}
