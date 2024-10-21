<?php

namespace app\models;
use backend\Concerns\WorkingWithTBModels;

use backend\Contracts\TBInterface;

use Yii;

/**
 * This is the model class for table "tb_terduga".
 *
 * @property string $id
 * @property string|null $no_sediaan
 * @property string|null $person_id
 * @property string|null $terduga_tb_id
 * @property string|null $tipe_pasien_id
 * @property string $status_dm_id
 * @property string $status_hiv_id
 * @property string $imunisasi_bcg_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class TbTerduga extends \yii\db\ActiveRecord implements TBInterface
{

    public $jenis_terduga,$jenis_pasien,$nama_pasien;

    use WorkingWithTBModels;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_terduga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status_dm_id', 'status_hiv_id', 'imunisasi_bcg_id'], 'required'],
            [['id'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['no_sediaan', 'status_dm_id', 'status_hiv_id', 'imunisasi_bcg_id'], 'string', 'max' => 255],
            [['person_id', 'terduga_tb_id', 'tipe_pasien_id'], 'string', 'max' => 20],
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
            'no_sediaan' => 'No Sediaan',
            'person_id' => 'Person ID',
            'terduga_tb_id' => 'Terduga Tb ID',
            'tipe_pasien_id' => 'Tipe Pasien ID',
            'status_dm_id' => 'Status Dm ID',
            'status_hiv_id' => 'Status Hiv ID',
            'imunisasi_bcg_id' => 'Imunisasi Bcg ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
