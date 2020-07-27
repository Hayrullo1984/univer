<?php

namespace frontend\controllers;

use Yii;
use common\models\UsOylikosh;
use frontend\models\UsOylikoshSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UsRazryad;

/**
 * UsOylikoshController implements the CRUD actions for UsOylikosh model.
 */
class UsOylikoshController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view',],
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create','update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                            ],
                        ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UsOylikosh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsOylikoshSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsOylikosh model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UsOylikosh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsOylikosh();

        if ($model->load(Yii::$app->request->post())) {
             // &&
            if (empty($model->NEWOKLAD)) {
                $model->NEWOKLAD=0;
            }
            if (empty($model->YNL)) {
            
             $model->YNL = Yii::$app->formatter->asDate($model->SANA,"php:Y");
            }
            $oklad = UsRazryad::find()->select('OKLAD')->andWhere(['ID'=>$model->IDRAZRYAD,'YNL'=>Yii::$app->formatter->asDate($model->SANA,"php:Y")])->one();
            $model->OKLAD = (UsOylikosh::find()->andWhere(['IDRAZRYAD'=>$model->IDRAZRYAD,'YNL'=>$model->YNL])->sum('OKLAD')+$oklad->OKLAD)*($model->FOIZ/100);
             // debug($model);exit; 
            if ($model->validate()) { 
             $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsOylikosh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->YNL = Yii::$app->formatter->asDate($model->SANA,"php:Y");
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsOylikosh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UsOylikosh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsOylikosh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsOylikosh::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
