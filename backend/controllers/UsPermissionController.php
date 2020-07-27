<?php

namespace backend\controllers;

use Yii;
use common\models\UsPermission;
use backend\models\UsPermission as UsPermissionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsPermissionController implements the CRUD actions for UsPermission model.
 */
class UsPermissionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
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
                        'actions' => ['create','update', 'delete','test'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                            ],
                        ],
        ];
    }

    /**
     * Lists all UsPermission models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsPermissionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTest()
    {
        $model = UsPermission::findOne(['id'=>3]);
        $auth = Yii::$app->authManager;
        $auth->removeAll();
//auth_item ga ma'lumot qo'shadi
        $createPost = $auth->createPermission($model->action_name);
        $createPost->description = $model->description;
        $auth->add($createPost);
        // add "updatePost" permission
        // $updatePost = $auth->createPermission(’updatePost’);
        // $updatePost->description = ’Update post’;
        // $auth->add($updatePost);
        // add "author" role and give this role the "createPost" permission
        //auth_item ga qo'shadi va auth_item_child ga ham qo'shadi
        $author = $auth->createRole('moderator');
        $auth->add($author);
        $auth->addChild($author, $createPost);
        // debug($auth);exit;
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $admin->description = "Bu admin aka";
        $auth->add($admin);
        $auth->addChild($admin, $createPost);
        // $auth->addChild($admin, $author);
        // Assign roles to users. 1 and 2 are IDs returned by
        // IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 3);
        $auth->assign($admin, 4);
        
        // echo "success";
    }

    /**
     * Displays a single UsPermission model.
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
     * Creates a new UsPermission model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsPermission();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UsPermission model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UsPermission model.
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
     * Finds the UsPermission model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsPermission the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsPermission::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
