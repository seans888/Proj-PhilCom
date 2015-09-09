<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Sitename;
use frontend\models\SitenameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use frontend\models\Project;

/**
 * SitenameController implements the CRUD actions for Sitename model.
 */
class SitenameController extends Controller
{
    public function behaviors()
    {
        return [
			'access'=>[
				'class'=>AccessControl::classname(),
				'only'=>['create','update','index'],
				'rules'=>[
					[
						'allow'=>true,
						'roles'=>['@']
					],
				]
			],
		
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Sitename models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SitenameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sitename model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Sitename model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sitename();

       
			
			 if ($model->load(Yii::$app->request->post()) ) {
				 
			$a =$model->sitecode;
			$b =$model->sitename;
	   
			$connection = \Yii::$app->db;
				$sql = $connection->createCommand('SELECT  sitecode  FROM Sitename WHERE sitecode = "'.$a.'"')->queryAll();
				$sql2 = $connection->createCommand('SELECT  sitename  FROM Sitename WHERE sitename = "'.$b.'"')->queryAll();
				
				if ($sql != null || $sql2 != null){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Sitecode or Sitename has already existing')
						window.location.href='index.php?r=project%2Findex';
						</SCRIPT>");
				}else{
					
					$model->save();
					return $this->redirect(['project/index']);
				}
				
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
		//echo "<a href='index.php?r=project%2Findex'> Go Back</a>";
    }

    /**
     * Updates an existing Sitename model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Sitename model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Sitename model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sitename the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sitename::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionGetSite()
	{
		//find the site code from the sitename table
		//$sitecode = Sitename::findOne($siteId);
		
		$connection = \Yii::$app->db;
		$customers = $connection->createCommand('SELECT count(status) as quantity , status  FROM project GROUP BY status')->queryAll();
		//------------------------------ 
		//$customers = Project::find()->all();
		echo Json::encode($customers);
	}
	
	
}
