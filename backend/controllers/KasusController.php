<?php

namespace backend\controllers;

use app\models\TbKasus;
use yii\bootstrap5\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\Response;
use Yii;

/**
 * TbPermohonanLabController implements the CRUD actions for TbPermohonanLab model.
 */
class KasusController extends Controller
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
            'query' => TbKasus::find(),
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

    /**
     * Creates a new TbPermohonanLab model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TbKasus();
        $menu = "Form Kasus";

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
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
            $model = TbKasus::findOne($id);
            if (!$model) {
                return ['success' => false, 'message' => 'Record not found'];
            }
        } else {
            $model = new TbKasus();
            $model->id = Uuid::uuid4()->toString(); // Generate UUID for new records
        }

        // Load data and save model
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            kirimHasilDiagnosa($request, $model);
            return ['success' => true];
        }

        return ['success' => false, 'errors' => ActiveForm::validate($model)];
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
        $menu = "Form Kasus";


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'menu' => $menu
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
     * @return TbKasus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TbKasus::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
