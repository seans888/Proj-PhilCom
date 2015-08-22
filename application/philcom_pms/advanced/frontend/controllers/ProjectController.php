<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Project;
use frontend\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\models\Logs;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\web\JsonParser;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		
		
		 // validate if there is a editable input saved via AJAX
    if (Yii::$app->request->post('hasEditable')) {
        // instantiate your book model for saving
        $projectId = Yii::$app->request->post('editableKey');
        $model = Project::findOne($projectId);

        // store a default json response as desired by editable
        //$out = Json::encode(['output'=>'', 'message'=>'']);
	
		$username = Yii::$app->user->identity->username;
		$status = $model->projectname;
		
		
				
				
		
        // fetch the first entry in posted data (there should 
        // only be one entry anyway in this array for an 
        // editable submission)
        // - $posted is the posted data for Book without any indexes
        // - $post is the converted array for single model validation
        $post = [];
        $posted = current($_POST['Project']);
        $post['Project'] = $posted;
		$a = $posted;
		
			   
				
	
		
		
        // load model like any single model validation
        if ($model->load($post) ) {
            // can save model or do something before saving model
			// $logC->save();
			//$model->save();
			
				
			
            $output = '';
			

			
			$logC = new Logs;
				$logC->logs_employee_name = $username;
				$logC->milestone_date = date('Y-m-d');
				$logC->project_id = $projectId;
			
			
			 $b = json_encode($a);
			// $c = json_decode($b);
	
			echo $b;
			$c = json_decode($b);
			foreach ($c as $key => $value) {
						
				}
				//echo $value;
			if ($key == "pic_id"){
				$connection = \Yii::$app->db;
				$sql = $connection->createCommand('SELECT  pic_fullName  FROM pic WHERE id ='.$value)->queryAll();
				 $encode = json_encode($sql);
				 $decode = json_decode($encode);
				 
					foreach($decode as $key2 => $value2){
						$picName = $decode[$key2]->pic_fullName;
					} 
					
					$logC->milestone=  $key . ' | ' .$picName . ' UPDATED';
					
					
			}else if($key == "sitename_id"){
				$connection = \Yii::$app->db;
				$sql3 = $connection->createCommand('SELECT  sitename  FROM sitename WHERE id ='.$value)->queryAll();
				 $encode3 = json_encode($sql3);
				 $decode3 = json_decode($encode3);
				 
					foreach($decode3 as $key3 => $value3){
						$sitename = $decode3[$key3]->sitename;
					} 
					
					$logC->milestone=  $key . ' | ' .$sitename . ' UPDATED';
				
			}else if($key == "account_id"){
				$connection = \Yii::$app->db;
				$sql4 = $connection->createCommand('SELECT  acct_name  FROM account WHERE id ='.$value)->queryAll();
				 $encode4 = json_encode($sql4);
				 $decode4 = json_decode($encode4);
				 
					foreach($decode4 as $key4 => $value4){
						$acctName = $decode4[$key4]->acct_name;
					} 
					
					$logC->milestone=  $key . ' | ' .$acctName . ' UPDATED';
			} else{
				$logC->milestone=  $key . ' | ' .$value . ' UPDATED';
			}
			
		$logC->save();
			$model->save();
          //  $out = Json::encode(['output'=>$output, 'message'=>'']);
        } 
		
        return;
    }
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['project/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
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
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	
}
