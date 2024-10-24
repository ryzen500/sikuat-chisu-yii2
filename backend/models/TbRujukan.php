<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_rujukan".
 *
 * @property string $id
 * @property string|null $id_asal
 * @property string|null $nama_asal
 * @property string|null $satusehat_asal
 * @property string|null $id_tujuan
 * @property string|null $nama_tujuan
 * @property string|null $satusehat_tujuan
 */
class TbRujukan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

     
    public static function tableName()
    {
        return 'tb_rujukan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'string'],
            [['id_asal', 'satusehat_asal', 'id_tujuan', 'satusehat_tujuan'], 'string', 'max' => 40],
            [['nama_asal', 'nama_tujuan'], 'string', 'max' => 64],
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
            'id_asal' => 'Id Asal',
            'nama_asal' => 'Nama Asal',
            'satusehat_asal' => 'Satusehat Asal',
            'id_tujuan' => 'Id Tujuan',
            'nama_tujuan' => 'Nama Tujuan',
            'satusehat_tujuan' => 'Satusehat Tujuan',
        ];
    }


        public static function getDataRujukanFaskes()
    {

            $condition = Yii::$app->session->get('faskes');
        // var_dump($condition);die;
        // Assuming you have a table column 'person_id' and 'person_name'
        $pasienList = self::find()->select(['satusehat_asal', 'nama_asal'])->where(['satusehat_asal'=>$condition 
        ])->all();
        return \yii\helpers\ArrayHelper::map($pasienList, 'satusehat_asal', 'nama_asal');
    }


        public static function getDataRujukanFaskesTujuan()
    {
        // Assuming you have a table column 'person_id' and 'person_name'
        $pasienList = self::find()->select(['satusehat_tujuan', 'nama_tujuan'])->all();
        return \yii\helpers\ArrayHelper::map($pasienList, 'satusehat_tujuan', 'nama_tujuan');
    }

}
