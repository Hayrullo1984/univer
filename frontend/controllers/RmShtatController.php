<?php

namespace frontend\controllers;

use Yii;
use common\models\RmShtat;
use frontend\models\RmShtatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UsBudkont;
use common\models\UsBulim;
use common\models\UsLavozim;
use common\models\UsIlmunvon;
use common\models\UsIlmdaraja;
use common\models\UsRazryad;
use common\models\UsOrg;
use common\models\UsUstama;


/**
 * RmShtatController implements the CRUD actions for RmShtat model.
 */
class RmShtatController extends Controller
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
     * Lists all RmShtat models.
     * @return mixed
     */
    public function actionIndex($date=null,$orgid=null,$status=null)
    {

        $budkont = UsBudkont::find()->all();
        $bulim = UsBulim::find()->all();
        $lavozim = UsLavozim::find()->asArray()->all();
        $unvon = UsIlmunvon::find()->all();
        $daraja = UsIlmdaraja::find()->all();
        $org = UsOrg::find()->all();
        $razryad = UsRazryad::find()->all();
        $models = RmShtat::find()->all();
        $ustama = UsUstama::find()->all();

        if (empty($date)) {
            $date = date('Y');
        }

        if (empty($orgid)) {
            $orgid = 1;
        }
        if (empty($status)) {
            $status = $budkont[0]->ID;
        }

        $v_shtat = Yii::$app->db->createCommand("CALL v_shtatka($date,$orgid,$status)")->queryAll();
        $yil = Yii::$app->db->createCommand("SELECT `YNL` FROM rm_shtat group by `YNL`")->queryAll();
        // debug($v_shtat);exit;
        // $searchModel = new RmShtatSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
// debug($yil);exit;
        if (empty($v_shtat)) {
            echo "Ma'lumot yo'q";exit;
        }
        return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
            'models'=>$models,
            'budkont'=>$budkont,
            'bulim'=>$bulim,
            'lavozim'=>$lavozim,
            'unvon'=>$unvon,
            'daraja'=>$daraja,
            'org'=>$org,
            'razryad'=>$razryad,
            'v_shtats' => $v_shtat,
            'yil' => $yil,
            
        ]);
    }

    /**
     * Displays a single RmShtat model.
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
     * Creates a new RmShtat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RmShtat();

        if ($model->load(Yii::$app->request->post())) {
            // && 
            $model->IDMARKAZ=1;
            $model->IDUSER = 1;
            // debug($model);exit;
           
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RmShtat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $ustama = $model->USTAMA_FOIZ;
        if ($model->load(Yii::$app->request->post())) {
            // && 
            $model->USTAMA_FOIZ = ($model->USTAMA_FOIZ*$ustama)+$ustama; 
            $model->save();
            return $this->redirect(['view', 'id' => $model->ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RmShtat model.
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
     * Finds the RmShtat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RmShtat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RmShtat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
