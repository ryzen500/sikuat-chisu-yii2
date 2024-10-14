<?php

namespace app\models;

use backend\Concerns\WorkingWithTBModels;
use backend\Contracts\TBInterface;
use Yii;

/**
 * This is the model class for table "tb_hasil_lab".
 *
 * @property string $id
 * @property string|null $KD_PELAYANAN
 * @property string|null $KD_PASIEN
 * @property string|null $KD_PUSKESMAS
 * @property string|null $tgl_contoh_uji
 * @property string|null $kondisi_contoh_uji
 * @property string|null $tanggal_daftar
 * @property string|null $pemeriksa dokter pemeriksa
 * @property string|null $contoh_uji
 * @property string|null $contoh_uji_lain
 * @property string|null $tanggal_hasil
 * @property string|null $no_reg_hasil
 * @property string|null $hasil
 * @property string|null $catatan
 * @property string|null $tcm_xdr
 * @property string|null $xdr_mtb
 * @property string|null $xdr_h
 * @property string|null $xdr_ht
 * @property string|null $xdr_fq
 * @property string|null $xdr_fqt
 * @property string|null $xdr_amk
 * @property string|null $xdr_km
 * @property string|null $xdr_cm
 * @property string|null $xdr_eto
 * @property string|null $lpa_lini1
 * @property string|null $lini1_mtb
 * @property string|null $lini1_inh
 * @property string|null $lini1_inhh
 * @property string|null $lini1_rif
 * @property string|null $lini1_eto
 * @property string|null $lini1_pto
 * @property string|null $lpa_lini2
 * @property string|null $lini2_mtb
 * @property string|null $lini2_lfx
 * @property string|null $lini2_mfx
 * @property string|null $lini2_mfx_dt
 * @property string|null $lini2_amk
 * @property string|null $lini2_km
 * @property string|null $lini2_cm
 * @property string|null $biakan_metode
 * @property string|null $kepekaan_ht
 * @property string|null $kepekaan_h
 * @property string|null $kepekaan_km
 * @property string|null $kepekaan_cm
 * @property string|null $kepekaan_lfx
 * @property string|null $kepekaan_mfxt
 * @property string|null $kepekaan_mfx
 * @property string|null $kepekaan_amk
 * @property string|null $kepekaan_eto
 * @property string|null $kepekaan_lzd
 * @property string|null $kepekaan_dlm
 * @property string|null $kepekaan_cfz
 * @property string|null $kepekaan_bdq
 * @property string|null $kepekaan_ofl
 * @property string|null $kepekaan_s
 * @property string|null $kepekaan_e
 * @property string|null $kepekaan_z
 * @property int|null $ID_KUNJUNGAN
 * @property string|null $bdmax_mtb
 * @property string|null $bdmax_rif
 * @property string|null $bdmax_inh
 * @property string|null $bdmax_katg
 * @property string|null $bdmax_apr
 * @property string|null $pcr_mtb
 * @property string|null $pcr_rif
 * @property string|null $pcr_inh
 * @property string|null $pcr_ntm
 * @property string|null $pcr_katg
 * @property string|null $pcr_apr
 * @property string|null $satusehat_response
 * @property string|null $jenis_pemeriksaan
 * @property string|null $penerima
 * @property string|null $ID_DIAGNOSTICREPORT_SATUSEHAT
 */
class TbHasilLab extends \yii\db\ActiveRecord implements TBInterface
{
    use WorkingWithTBModels;
    public $no_sediaan,$lokasi_anatomi,$kondisi_contoh_uji_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_hasil_lab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'kondisi_contoh_uji', 'pemeriksa', 'contoh_uji', 'hasil', 'catatan', 'tcm_xdr', 'satusehat_response', 'jenis_pemeriksaan', 'penerima', 'ID_DIAGNOSTICREPORT_SATUSEHAT'], 'string'],
            [['tgl_contoh_uji', 'tanggal_daftar', 'tanggal_hasil'], 'safe'],
            [['ID_KUNJUNGAN'], 'default', 'value' => null],
            [['ID_KUNJUNGAN'], 'integer'],
            [['KD_PELAYANAN', 'KD_PASIEN', 'KD_PUSKESMAS'], 'string', 'max' => 20],
            [['contoh_uji_lain', 'no_reg_hasil', 'xdr_mtb', 'xdr_h', 'xdr_ht', 'xdr_fq', 'xdr_fqt', 'xdr_amk', 'xdr_km', 'xdr_cm', 'xdr_eto', 'lpa_lini1', 'lini1_mtb', 'lini1_inh', 'lini1_inhh', 'lini1_rif', 'lini1_eto', 'lini1_pto', 'lpa_lini2', 'lini2_mtb', 'lini2_lfx', 'lini2_mfx', 'lini2_mfx_dt', 'lini2_amk', 'lini2_km', 'lini2_cm', 'biakan_metode', 'kepekaan_ht', 'kepekaan_h', 'kepekaan_km', 'kepekaan_cm', 'kepekaan_lfx', 'kepekaan_mfxt', 'kepekaan_mfx', 'kepekaan_amk', 'kepekaan_eto', 'kepekaan_lzd', 'kepekaan_dlm', 'kepekaan_cfz', 'kepekaan_bdq', 'kepekaan_ofl', 'kepekaan_s', 'kepekaan_e', 'kepekaan_z', 'bdmax_mtb', 'bdmax_rif', 'bdmax_inh', 'bdmax_katg', 'bdmax_apr', 'pcr_mtb', 'pcr_rif', 'pcr_inh', 'pcr_ntm', 'pcr_katg', 'pcr_apr'], 'string', 'max' => 45],
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
            'tgl_contoh_uji' => 'Tgl Contoh Uji',
            'kondisi_contoh_uji' => 'Kondisi Contoh Uji',
            'tanggal_daftar' => 'Tanggal Daftar',
            'pemeriksa' => 'Pemeriksa',
            'contoh_uji' => 'Contoh Uji',
            'contoh_uji_lain' => 'Contoh Uji Lain',
            'tanggal_hasil' => 'Tanggal Hasil',
            'no_reg_hasil' => 'No Reg Hasil',
            'hasil' => 'Hasil',
            'catatan' => 'Catatan',
            'tcm_xdr' => 'Tcm Xdr',
            'xdr_mtb' => 'Xdr Mtb',
            'xdr_h' => 'Xdr H',
            'xdr_ht' => 'Xdr Ht',
            'xdr_fq' => 'Xdr Fq',
            'xdr_fqt' => 'Xdr Fqt',
            'xdr_amk' => 'Xdr Amk',
            'xdr_km' => 'Xdr Km',
            'xdr_cm' => 'Xdr Cm',
            'xdr_eto' => 'Xdr Eto',
            'lpa_lini1' => 'Lpa Lini1',
            'lini1_mtb' => 'Lini1 Mtb',
            'lini1_inh' => 'Lini1 Inh',
            'lini1_inhh' => 'Lini1 Inhh',
            'lini1_rif' => 'Lini1 Rif',
            'lini1_eto' => 'Lini1 Eto',
            'lini1_pto' => 'Lini1 Pto',
            'lpa_lini2' => 'Lpa Lini2',
            'lini2_mtb' => 'Lini2 Mtb',
            'lini2_lfx' => 'Lini2 Lfx',
            'lini2_mfx' => 'Lini2 Mfx',
            'lini2_mfx_dt' => 'Lini2 Mfx Dt',
            'lini2_amk' => 'Lini2 Amk',
            'lini2_km' => 'Lini2 Km',
            'lini2_cm' => 'Lini2 Cm',
            'biakan_metode' => 'Biakan Metode',
            'kepekaan_ht' => 'Kepekaan Ht',
            'kepekaan_h' => 'Kepekaan H',
            'kepekaan_km' => 'Kepekaan Km',
            'kepekaan_cm' => 'Kepekaan Cm',
            'kepekaan_lfx' => 'Kepekaan Lfx',
            'kepekaan_mfxt' => 'Kepekaan Mfxt',
            'kepekaan_mfx' => 'Kepekaan Mfx',
            'kepekaan_amk' => 'Kepekaan Amk',
            'kepekaan_eto' => 'Kepekaan Eto',
            'kepekaan_lzd' => 'Kepekaan Lzd',
            'kepekaan_dlm' => 'Kepekaan Dlm',
            'kepekaan_cfz' => 'Kepekaan Cfz',
            'kepekaan_bdq' => 'Kepekaan Bdq',
            'kepekaan_ofl' => 'Kepekaan Ofl',
            'kepekaan_s' => 'Kepekaan S',
            'kepekaan_e' => 'Kepekaan E',
            'kepekaan_z' => 'Kepekaan Z',
            'ID_KUNJUNGAN' => 'Id Kunjungan',
            'bdmax_mtb' => 'Bdmax Mtb',
            'bdmax_rif' => 'Bdmax Rif',
            'bdmax_inh' => 'Bdmax Inh',
            'bdmax_katg' => 'Bdmax Katg',
            'bdmax_apr' => 'Bdmax Apr',
            'pcr_mtb' => 'Pcr Mtb',
            'pcr_rif' => 'Pcr Rif',
            'pcr_inh' => 'Pcr Inh',
            'pcr_ntm' => 'Pcr Ntm',
            'pcr_katg' => 'Pcr Katg',
            'pcr_apr' => 'Pcr Apr',
            'satusehat_response' => 'Satusehat Response',
            'jenis_pemeriksaan' => 'Jenis Pemeriksaan',
            'penerima' => 'Penerima',
            'ID_DIAGNOSTICREPORT_SATUSEHAT' => 'Id Diagnosticreport Satusehat',
        ];
    }
}
