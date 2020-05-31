<?php

namespace backend\controllers;

use Yii;
use common\models\Preparation;
use common\models\search\PreparationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use conquer\select2\Select2Action;

/**
 * PreparationController implements the CRUD actions for Preparation model.
 */
class PreparationController extends Controller
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
                        'actions' => ['index','logout', 'view','create','update','delete'],
                        'roles' => ['@'],
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

    public function actions()
    {
        return [
            'ajax' => [
                'class' => Select2Action::className(),
                'dataCallback' => [$this, 'dataCallback'],
            ],
        ];
    }
    /**
     *
     * @param string $q
     * @return array
     */
    public function dataCallback($q)
    {
        $query = new \yii\db\ActiveQuery(\common\models\Thing::className());
        return
            [
                'results' =>  $query->select([
                    'thing.id as id',
                    'thing.name as text',
                ])->asArray()->all(),
            ];
    }

    /**
     * Lists all Preparation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreparationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Preparation model.
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
     * Creates a new Preparation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Preparation();
        $searchModel = new PreparationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $things = $model->thing_id;
                $food_id = $model->food_id;
                foreach($things as $thing){
                    
                    $model_insert = new Preparation();
                    $model_insert->food_id = $food_id;
                    $model_insert->thing_id = $thing;
                    $model_insert->save();
                }
                // echo "<pre>";
                // print_r($things);exit;
                //  $model->save();
                return $this->redirect(['create',
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Preparation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new PreparationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        if ($model->load(Yii::$app->request->post())) {
            $model->thing_id = $model->thing_id[0];
            // echo "<pre>";
            // print_r($model->save());exit;
            // && 
            $model->save();
            return $this->redirect(['view', 'id' => $model->id,'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,]);
        }

        return $this->render('update', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing Preparation model.
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
     * Finds the Preparation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Preparation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Preparation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
