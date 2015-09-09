<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\User;
use frontend\models\Project;
use frontend\models\ProjectSearch;
use frontend\models\PicSearch;
use frontend\models\Pic;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'create','view','update','delete','signup','picView',],
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
     * @inheritdoc
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
        ];
    }

    public function actionIndex()
    {
		
		
			 $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
	
	public function actionPicView()
    {
		
		
			 $searchModel = new PicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        
    }
	
	

    public function actionLogin()
    {
		
	
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
				return $this->goBack();
			
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
	
	

    public function actionSignup()
    {
        $model = new SignupForm();
        
		if ($model->load(Yii::$app->request->post())) {
			
			$a =$model->username;
			
			$connection = \Yii::$app->db;
				$sql = $connection->createCommand('SELECT  username  FROM User WHERE username = "'.$a.'"')->queryAll();
				$count = $connection->createCommand('SELECT  count(roles) as count  FROM User WHERE roles = 10')->queryAll();
					$total_encode = json_encode($count);
					$total_decode = json_decode($total_encode);
				
				
				if ($sql != null){

					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Username has already existing')
						window.location.href='index.php?r=user%2Findex';
						</SCRIPT>");
				}else{
					
					if($model->roles == 10){
						if($total_decode[0]->count >=5 ){
						echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Only 5 Admin can be Created.')
						window.location.href='index.php?r=user%2Findex';
						</SCRIPT>");
						}else{
							$user = $model->signup();
					return $this->redirect(['/user/index']);
						}
					}else{
					$user = $model->signup();
					return $this->redirect(['/user/index']);
					} 	
				}
        }else{
			
			return $this->renderAjax('signup', [
				'model' => $model,
			]);
		}
		//echo "<a href='index.php?r=user%2Findex'> Go Back</a>";
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
