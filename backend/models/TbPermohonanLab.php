<?php

namespace app\models;

use backend\Concerns\WorkingWithTBModels;
use backend\Contracts\TBInterface;
use Yii;

/**
 * This is the model class for table "tb_permohonan_lab".
 *
 * @property string $id
 * @property string|null $KD_PELAYANAN
 * @property string|null $KD_PASIEN
 * @property string|null $KD_PUSKESMAS
 * @property string $no_sediaan
 * @property string $lokasi_anatomi
 * @property string $tanggal_permohonan
 * @property string $pengirim
 * @property string|null $alasan
 * @property string|null $faskes_tujuan
 * @property string $tanggal_pengambilan
 * @property string $tanggal_pengiriman
 * @property string $jenis_pemeriksaan
 * @property int|null $followup_ke
 * @property int|null $periksa_ulang_ke
 * @property string $contoh_uji
 * @property string|null $contoh_uji_lain
 * @property string|null $nomor_permohonan
 * @property string|null $satusehat_response
 * @property string|null $ID_KUNJUNGAN
 * @property string|null $ID_SERVICEREQUEST_SATUSEHAT
 * @property string|null $ID_SPECIMEN_SATUSEHAT
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TbPermohonanLab extends \yii\db\ActiveRecord implements TBInterface
{
    use WorkingWithTBModels;
    public $alasan_pemeriksaan;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_permohonan_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'no_sediaan', 'lokasi_anatomi', 'tanggal_permohonan', 'pengirim', 'tanggal_pengambilan', 'tanggal_pengiriman', 'jenis_pemeriksaan', 'contoh_uji'], 'required'],
            [[ 'alasan','alasan_pemeriksaan', 'satusehat_response'], 'string'],
            [['tanggal_permohonan', 'faskes','tanggal_pengambilan', 'tanggal_pengiriman', 'created_at', 'updated_at'], 'safe'],
            [['followup_ke', 'periksa_ulang_ke'], 'default', 'value' => null],
            [['followup_ke', 'periksa_ulang_ke'], 'integer'],
            [['KD_PELAYANAN', 'KD_PASIEN', 'KD_PUSKESMAS'], 'string', 'max' => 20],
            [['no_sediaan', 'lokasi_anatomi', 'pengirim', 'faskes_tujuan', 'jenis_pemeriksaan', 'contoh_uji', 'contoh_uji_lain', 'nomor_permohonan', 'ID_KUNJUNGAN', 'ID_SERVICEREQUEST_SATUSEHAT', 'ID_SPECIMEN_SATUSEHAT'], 'string', 'max' => 255],
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
            'no_sediaan' => 'No Sediaan',
            'lokasi_anatomi' => 'Lokasi Anatomi',
            'tanggal_permohonan' => 'Tanggal Permohonan',
            'pengirim' => 'Pengirim',
            'alasan' => 'Alasan',
            'faskes_tujuan' => 'Faskes Tujuan',
            'tanggal_pengambilan' => 'Tanggal Pengambilan',
            'tanggal_pengiriman' => 'Tanggal Pengiriman',
            'jenis_pemeriksaan' => 'Jenis Pemeriksaan',
            'followup_ke' => 'Followup Ke',
            'periksa_ulang_ke' => 'Periksa Ulang Ke',
            'contoh_uji' => 'Contoh Uji',
            'contoh_uji_lain' => 'Contoh Uji Lain',
            'nomor_permohonan' => 'Nomor Permohonan',
            'satusehat_response' => 'Satusehat Response',
            'ID_KUNJUNGAN' => 'Id Kunjungan',
            'ID_SERVICEREQUEST_SATUSEHAT' => 'Id Servicerequest Satusehat',
            'ID_SPECIMEN_SATUSEHAT' => 'Id Specimen Satusehat',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }



}
