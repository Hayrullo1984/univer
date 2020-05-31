<?php
namespace frontend\controllers;

use common\models\Food;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Preparation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use conquer\select2\Select2Action;
use frontend\models\ClientForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
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
                ])
                // ->andWhere(['thing.status'=>1])
                ->asArray()->all(),
            ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ClientForm();
        if($model->load(Yii::$app->request->post())){
            if(count($model->things)>=2 && count($model->things)<=5){
                $blackList = Preparation::find()
                ->alias("pr")
                ->select(["pr.food_id"])->
                joinWith("thing th")
                ->andWhere(['th.status'=>"0"])
                // ->asArray()
                ->all();
                $ls = [];
                foreach($blackList as $blist){
                    $ls[]= $blist->food_id;
                }
                $preparations = Preparation::find()
                ->joinWith("thing t")
                ->joinWith('food f')
                ->andWhere(['in','thing_id',$model->things])
                ->andWhere(['NOT IN','food_id',$ls])
                ->all();
                
                // $foods = Food::find()->all();
                $ready =[];
                 if(!empty($preparations)){
                //         return "pustoy";
            
                
                $list = [];
                $i=0;
                $name = $preparations[0]->food->name;
                    foreach ($preparations as $preparation){
                
                        if($name!=$preparation->food->name){
                            $i=0;
                        }
                        $name = $preparation->food->name;
                        $list["$name"]["count"]=++$i;
                        $list["$name"]["name"][] =$preparation->thing->name;
                        $list["$name"]["status"][] = $preparation->thing->status;
                    }
                    $newList = [];
                    foreach($list as $key=>$value)
                    {
                        if(!in_array(0,$value["status"])){
                            if($value['count'] == count($model->things))
                            $newList["tuliq"][]=$key;
                            else if($value['count']>=2)
                            $newList["qisman"][]=$key;
                        }

                    }
                    

                        if(isset($newList['tuliq'])){
                           $ready = $newList['tuliq'];   
                        }else if(!isset($newList['tuliq']) && isset($newList['qisman'])){
                            $ready = $newList['qisman'];
                        }

                    // sort($newList);
                // echo "<pre>"; 
                // print_r($preparations);exit;
               
            }
            return $this->render('index',['model'=>$model,'list'=>$ready]);
            // else{
            //     return
            // }
        }
            else{
                Yii::$app->session->setFlash('error',"Masalliqlarni soni 2 va 5 oralig'ida bo'lishi kerak");
            }
            // return $this->render('index',['model'=>$model]);            
        }
        return $this->render('index',['model'=>$model]);

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
