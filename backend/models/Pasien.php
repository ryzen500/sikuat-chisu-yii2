<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property int $id_pasien
 * @property string $nama_pasien
 * @property string $alamat_pasien
 * @property string|null $no_asuransi_pasien
 * @property string|null $jenis_asuransi_pasien
 * @property string $nik_pasien
 * @property string|null $status_kewarganegaraan
 * @property string|null $paspor
 * @property string|null $kewarganegaraan
 * @property int $provinsi_id
 * @property int $kabupaten_id
 * @property int $kecamatan_id
 * @property int $desa_id
 * @property int|null $kode_pos
 * @property int $no_telepon
 * @property string|null $jenis_no_telepon
 * @property string|null $surat_elektronik
 * @property string $gol_darah
 * @property string $nama_ayah
 * @property string $nama_ibu
 * @property string|null $nama_pasangan
 * @property string $jenis_kelamin
 * @property string $tempat_lahir
 * @property string $tgl_lahir
 * @property string|null $tgl_kematian
 * @property string $agama
 * @property string $pendidikan_terakhir
 * @property string|null $status_pernikahan
 * @property string|null $jenis_pekerjaan
 * @property string|null $suku
 * @property string|null $ket_identitas_pasien
 * @property string $kd_pasien
 * @property int $puskesmas_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pasien', 'alamat_pasien', 'nik_pasien', 'provinsi_id', 'kabupaten_id', 'kecamatan_id', 'desa_id', 'no_telepon', 'gol_darah', 'nama_ayah', 'nama_ibu', 'jenis_kelamin', 'tempat_lahir', 'tgl_lahir', 'agama', 'pendidikan_terakhir', 'kd_pasien', 'puskesmas_id'], 'required'],
            [['provinsi_id', 'kabupaten_id', 'kecamatan_id', 'desa_id', 'kode_pos', 'no_telepon', 'puskesmas_id'], 'default', 'value' => null],
            [['provinsi_id', 'kabupaten_id', 'kecamatan_id', 'desa_id', 'kode_pos', 'no_telepon', 'puskesmas_id'], 'integer'],
            [['tgl_lahir', 'tgl_kematian', 'created_at', 'updated_at'], 'safe'],
            [['nama_pasien', 'alamat_pasien', 'no_asuransi_pasien', 'jenis_asuransi_pasien', 'nik_pasien', 'status_kewarganegaraan', 'paspor', 'kewarganegaraan', 'jenis_no_telepon', 'surat_elektronik', 'gol_darah', 'nama_ayah', 'nama_ibu', 'nama_pasangan', 'jenis_kelamin', 'tempat_lahir', 'agama', 'pendidikan_terakhir', 'status_pernikahan', 'jenis_pekerjaan', 'suku', 'ket_identitas_pasien', 'kd_pasien'], 'string', 'max' => 255],
        ];
    }

    public static function getLokasiAnatomiOptions()
    {
        // Assuming you have a table column 'person_id' and 'person_name'
        $pasienList = self::find()->select(['id_pasien', 'nama_pasien'])->all();
        return \yii\helpers\ArrayHelper::map($pasienList, 'id_pasien', 'nama_pasien');
    }


      // Static function to return patient type options
    public static function getTipePasienOptions()
    {
        return [
            ''  => '--Pilih Tipe Pasien--',
            '1' => 'Baru',
            '2' => 'TBC Ekstra Paru',
            '3' => 'Diobati setelah gagal kategori 1',
            '4' => 'Diobati setelah gagal kategori 2',
            '5' => 'Diobati setelah putus berobat',
            '6' => 'Diobati setelah gagal pengobatan lini 2',
            '7' => 'Pernah diobati tidak diketahui hasilnya',
            '8' => 'Tidak diketahui',
            '9' => 'Lain-lain',
            '10' => 'Diobati setelah gagal',
        ];
    }

        // Static function to return updated patient type options
    public static function getTerdugaTbOptions()
    {
        return [
            ''  => '--Pilih Tipe Pasien--',
            '1' => 'Terduga TB SO',
            '2' => 'Terduga TB RO',
        ];
    }

      public static function getYesNoOptions()
    {
        return [
            '1' => 'Ya',
            '2' => 'Tidak',
            '3' => 'Tidak Diketahui',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pasien' => 'Id Pasien',
            'nama_pasien' => 'Nama Pasien',
            'alamat_pasien' => 'Alamat Pasien',
            'no_asuransi_pasien' => 'No Asuransi Pasien',
            'jenis_asuransi_pasien' => 'Jenis Asuransi Pasien',
            'nik_pasien' => 'Nik Pasien',
            'status_kewarganegaraan' => 'Status Kewarganegaraan',
            'paspor' => 'Paspor',
            'kewarganegaraan' => 'Kewarganegaraan',
            'provinsi_id' => 'Provinsi ID',
            'kabupaten_id' => 'Kabupaten ID',
            'kecamatan_id' => 'Kecamatan ID',
            'desa_id' => 'Desa ID',
            'kode_pos' => 'Kode Pos',
            'no_telepon' => 'No Telepon',
            'jenis_no_telepon' => 'Jenis No Telepon',
            'surat_elektronik' => 'Surat Elektronik',
            'gol_darah' => 'Gol Darah',
            'nama_ayah' => 'Nama Ayah',
            'nama_ibu' => 'Nama Ibu',
            'nama_pasangan' => 'Nama Pasangan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'tgl_kematian' => 'Tgl Kematian',
            'agama' => 'Agama',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
            'status_pernikahan' => 'Status Pernikahan',
            'jenis_pekerjaan' => 'Jenis Pekerjaan',
            'suku' => 'Suku',
            'ket_identitas_pasien' => 'Ket Identitas Pasien',
            'kd_pasien' => 'Kd Pasien',
            'puskesmas_id' => 'Puskesmas ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
