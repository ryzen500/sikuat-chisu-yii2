<?php

namespace backend\controllers;


use app\models\TbTerduga;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use Yii;
use Ramsey\Uuid\Uuid;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;


class TerdugaController extends Controller
{


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'], // Allow guest users (not logged in)
                    ],
                ],
            ],
        ];
    }


    /**
     * Creates a new TbPermohonanLab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TbTerduga();
        $menu = "Form Terduga TB";


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'menu' => $menu
        ]);
    }


    
    public function actionSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $request = Yii::$app->request->post();

        // Check if an ID is provided
        $id = Yii::$app->request->post('id');

        // If ID is provided, try to find the existing model, otherwise create a new one
        if ($id) {
            $model = TbTerduga::findOne($id);
            if (!$model) {
                return ['success' => false, 'message' => 'Record not found'];
            }
        } else {
            $model = new TbTerduga();
            $model->id = Uuid::uuid4()->toString(); // Generate UUID for new records
        }

        // Load data and save model
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            kirimTerdugaTB($request['TbTerduga'], $model);
            return ['success' => true];
        }

        return ['success' => false, 'errors' => ActiveForm::validate($model)];
    }

public function actionIndex()
{
    $query = TbTerduga::find()
        ->select([
            'tb_terduga.id',
            'tb_terduga.no_sediaan',
            'tb_terduga.tipe_pasien_id',
            'tb_terduga.terduga_tb_id',
            new \yii\db\Expression("CASE
                WHEN terduga_tb_id = '1' THEN 'Terduga TB SO'
                ELSE 'Terduga TB RO'
            END AS jenis_terduga"),  // Alias as 'jenis_terduga'
            new \yii\db\Expression("CASE
                WHEN tipe_pasien_id = '1' THEN 'Baru'
                WHEN tipe_pasien_id = '2' THEN 'TBC Ekstra Paru'
                WHEN tipe_pasien_id = '3' THEN 'Diobati setelah gagal kategori 1'
                WHEN tipe_pasien_id = '4' THEN 'Diobati setelah gagal kategori 2'
                WHEN tipe_pasien_id = '5' THEN 'Diobati setelah putus berobat'
                WHEN tipe_pasien_id = '6' THEN 'Diobati setelah gagal pengobatan lini 2'
                WHEN tipe_pasien_id = '7' THEN 'Pernah diobati tidak diketahui hasilnya'
                WHEN tipe_pasien_id = '8' THEN 'Tidak diketahui'
                WHEN tipe_pasien_id = '9' THEN 'Lain-lain'
                WHEN tipe_pasien_id = '10' THEN 'Diobati setelah gagal'
                ELSE 'Tidak Diketahui'
            END AS jenis_pasien"),  // Alias as 'jenis_pasien'
            'pasien.nama_pasien as nama_pasien'
        ])
        ->leftJoin('pasien', 'CAST(tb_terduga.person_id AS bigint) = pasien.id_pasien')
        ->orderBy(['tb_terduga.id' => SORT_DESC]);

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
        'pagination' => [
            'pageSize' => 50,
        ],
        'sort' => [
            'defaultOrder' => [
                'id' => SORT_DESC,
            ],
        ],
    ]);

    return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
}


    /**
     * Updates an existing TbPermohonanLab model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $menu = "Form Permohonan Lab";

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'menu' => $menu
        ]);
    }


        public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Deletes an existing TbPermohonanLab model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = TbTerduga::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
