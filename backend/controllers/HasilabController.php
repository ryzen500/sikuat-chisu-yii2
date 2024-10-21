<?php

namespace backend\controllers;

use App\Controllers\Mediator\MediatorController;
use app\models\TbHasilLab;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\base\DynamicModel;
use yii\widgets\ActiveForm;
use yii\web\Response;
use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Ramsey\Uuid\Uuid;
use yii\filters\AccessControl;

/**
 * TbPermohonanLabController implements the CRUD actions for TbPermohonanLab model.
 */
class HasilabController extends Controller
{
    /**
     * @inheritDoc
     */
    // public function behaviors()
    // {
    //     return array_merge(
    //         parent::behaviors(),
    //         [
    //             'verbs' => [
    //                 'class' => VerbFilter::className(),
    //                 'actions' => [
    //                     'delete' => ['POST'],
    //                 ],
    //             ],
    //         ]
    //     );
    // }

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
     * Lists all TbPermohonanLab models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TbHasilLab::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TbPermohonanLab model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionSave()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Validasi input dari request
        $request = Yii::$app->request->post();

        $rules = [
            [['lokasi_anatomi', 'no_sediaan', 'tanggal_daftar', 'penerima', 'pemeriksa', 'jenis_pemeriksaan', 'contoh_uji', 'tgl_contoh_uji'], 'required'],
            [['tanggal_daftar', 'tgl_contoh_uji'], 'date', 'format' => 'php:Y-m-d'],
        ];

        $model = new \yii\base\DynamicModel($request['TbHasilLab']);

        if (ActiveForm::validate($model)) {
            return ['success' => false, 'errors' => $model->errors];
        }


        // echo '<pre>';
        // var_dump($model);die;


        // Tambahkan kolom lain secara manual
        $request['no_sediaan'] = $model['no_sediaan'] ?? null;
        $request['lokasi_anatomi'] = $model['lokasi_anatomi'] ?? null;
        $request['tanggal_daftar'] = $model['tanggal_daftar'] ?? null;
        $request['penerima'] = $model['penerima'] ?? null;
        $request['pemeriksa'] = $model['pemeriksa'] ?? null;
        $request['jenis_pemeriksaan'] = $model['jenis_pemeriksaan'] ?? null;
        $request['tgl_contoh_uji'] = $model['tgl_contoh_uji'] ?? null;
        $request['kondisi_contoh_uji_id'] = $model['kondisi_contoh_uji_id'] ?? null;
        $request['contoh_uji'] = $model['contoh_uji'] ?? null;

        $request['contoh_uji_lain'] = $model['contoh_uji_lain'] ?? null;
        $request['no_reg_hasil'] = !empty($model['no_reg_hasil']) ? $model['no_reg_hasil'] : $model['no_reg_hasil'];
        $request['tanggal_hasil'] = !empty($model['tanggal_hasil']) ? $model['tanggal_hasil'] : $model['tanggal_hasil'];
        $request['hasil'] = !empty($model['hasil']) ? $model['hasil'] : $model['hasil'];
        $request['catatan'] = !empty($model['catatan']) ? $model['catatan'] : $model['catatan'];

        try {
            // Check if an ID is provided, if so, update the record, otherwise create a new one
            $id = $request['id'] ?? null;
            if ($id) {
                $model = TbHasilLab::findOne($id);
                if (!$model) {
                    return ['success' => false, 'message' => 'Record not found'];
                }
            } else {
                $model = new TbHasilLab();
                $request['id'] = Uuid::uuid4()->toString(); // Generate UUID for new records

                $model->id = Uuid::uuid4()->toString(); // Generate UUID for new records

            }

            // Load data into the model and save
            if ($model->load($request, '') && $model->save()) {

                // kirimHasilLab($request, $model);

                return [
                    'success' => true,
                    'message' => $id ? 'Berhasil mengubah data' : 'Berhasil menyimpan data',
                    'data' => $model
                ];
            }

            return ['success' => false, 'errors' => ActiveForm::validate($model)];
        } catch (\Exception $e) {
            var_dump($e);
            die;
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => 500
            ];
        }
    }

    /**
     * Creates a new TbPermohonanLab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TbHasilLab();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
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

        // echo '<pre>';
        // var_dump($model);die;
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

    /**
     * Finds the TbPermohonanLab model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return TbPermohonanLab the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbHasilLab::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
