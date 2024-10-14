<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satusehat".
 *
 * @property string $id
 * @property string $resource
 * @property string $resource_id
 * @property string $url
 * @property string $data
 * @property string $kunjungan
 * @property string $pasien
 * @property string $faskes
 * @property string $table_name
 * @property string $table_id
 * @property string $episode_of_care_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Satusehat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'satusehat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource', 'resource_id', 'url', 'data', 'kunjungan', 'pasien',  'table_name', 'table_id', 'episode_of_care_id'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['resource', 'resource_id', 'url', 'kunjungan', 'pasien', 'faskes', 'table_name', 'table_id', 'episode_of_care_id'], 'string', 'max' => 255],
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
            'resource' => 'Resource',
            'resource_id' => 'Resource ID',
            'url' => 'Url',
            'data' => 'Data',
            'kunjungan' => 'Kunjungan',
            'pasien' => 'Pasien',
            'faskes' => 'Faskes',
            'table_name' => 'Table Name',
            'table_id' => 'Table ID',
            'episode_of_care_id' => 'Episode Of Care ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
