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
use yii\filters\AccessControl;
//use yii\web\JsonParser;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
	
		$firstname = Yii::$app->user->identity->firstname;
		$lastname = Yii::$app->user->identity->lastname;
		$status = $model->projectname;
		
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
				$logC->logs_employee_name = $firstname." ".$lastname;
				date_default_timezone_set('Asia/Manila');
				$logC->milestone_date = date('Y-m-d'). " ".date("h:i:sa");
				$logC->project_id = $projectId;
			
			
			 $b = json_encode($a);
			// $c = json_decode($b);
	
			echo $b;
			$c = json_decode($b);
			foreach ($c as $key => $value) {
						
				}
				//echo $value;
			//------------------------------------- For Status----------------------------------------
			
			if($key == "percentage_of_completion"){
			
			
				
				if($model->percentage_of_completion == 90 ){
					$model->status = "PHYSICALLY COMPLETED";				
				}else if($model->percentage_of_completion == 91){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 92){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 93){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 94){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 95){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 96){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 97){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 98){
					$model->status = "PHYSICALLY COMPLETED";
				}else if($model->percentage_of_completion == 99){
					$model->status = "PHYSICALLY COMPLETED";
				}	
			
					
				if($model->percentage_of_completion == 100  ){
					$model->status = "ACCEPTED";				
				}
			}
			
				
				

			//----------------------------------------------------------------------------------------	
			
			
			if($key == "status"){			
			
				if($model->status == "CANCELED"){
				$model->percentage_of_completion = 0;
				} 
				if ($model->status == "PHYSICALLY COMPLETED"){
					$model->percentage_of_completion = 90;
				}
				if ($model->status == "ACCEPTED"){
					$model->percentage_of_completion = 100;
				}
			}
			
			
			//-------------------------------------For Site Code --------------------------------------
			
			
			if($key == "sitename_id"){
			
			$sitecode = $model->sitename_id;
			$projectCode = $model->projectcode;
			
			$connection = \Yii::$app->db;
				$sql5 = $connection->createCommand('SELECT  sitecode  FROM sitename WHERE id ='.$value)->queryAll();
				 $encode5 = json_encode($sql5);
				 $decode5 = json_decode($encode5);
				 
					foreach($decode5 as $key5 => $value5){
						$sitecode = $decode5[$key5]->sitecode;
					}
					//echo $sitecode;
					$projectExplode = explode("-",$projectCode);
					
					
					foreach ($projectExplode as $key6 => $value6){
						$date = $projectExplode[1];
						$idCode = $projectExplode[2];
					}
					$mergeProjectCode =   $sitecode."-".$date."-".$idCode;
					 
					 
					 $model->projectcode = $mergeProjectCode;
			
			}
			
			
			//----------------------------------------------------------------------------------------
				
			if ($key == "pic_id"){
				$connection = \Yii::$app->db;
				$sql = $connection->createCommand('SELECT  pic_fullName  FROM pic WHERE id ='.$value)->queryAll();
				 $encode = json_encode($sql);
				 $decode = json_decode($encode);
				 
					foreach($decode as $key2 => $value2){
						$picName = $decode[$key2]->pic_fullName;
					} 
					
					$logC->milestone=  "Person in charge " . ' | ' .$picName . ' UPDATED';
					
					
			}else if($key == "sitename_id"){
				$connection = \Yii::$app->db;
				$sql3 = $connection->createCommand('SELECT  sitename  FROM sitename WHERE id ='.$value)->queryAll();
				 $encode3 = json_encode($sql3);
				 $decode3 = json_decode($encode3);
				 
					foreach($decode3 as $key3 => $value3){
						$sitename = $decode3[$key3]->sitename;
					} 
					
					$logC->milestone=  "Sitename" . ' | ' .$sitename . ' UPDATED';
				
			}else if($key == "account_id"){
				$connection = \Yii::$app->db;
				$sql4 = $connection->createCommand('SELECT  acct_name  FROM account WHERE id ='.$value)->queryAll();
				 $encode4 = json_encode($sql4);
				 $decode4 = json_decode($encode4);
				 
					foreach($decode4 as $key4 => $value4){
						$acctName = $decode4[$key4]->acct_name;
					} 
					
					$logC->milestone=  "Account" . ' | ' .$acctName . ' UPDATED'; 
			} else if($key == "contractor"){
				$logC->milestone=  "Contractor" . ' | ' .$value . ' UPDATED';
			}else if($key == "date_of_flob"){
				$logC->milestone=  "Date of Mobilization" . ' | ' .$value . ' UPDATED';
			}else if($key == "date_of_completion"){
				$logC->milestone=  "Date of Completion" . ' | ' .$value . ' UPDATED';
			}else if($key == "percentage_of_completion"){
				$logC->milestone=  "% of Completion" . ' | ' .$value . ' UPDATED';
			}else if($key == "remarks"){
				$logC->milestone=  "Remarks" . ' | ' .$value . ' UPDATED';
			}else{
				$logC->milestone=  $key . ' | ' .$value . ' UPDATED';
			}
			
			$logC->save();
			$model->save();
			//return $this->redirect(['project/index']);
			return $this->refresh();
          //  $out = Json::encode(['output'=>$output, 'message'=>'']);
        } 
		
        
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
