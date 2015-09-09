<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Pic;
use frontend\models\PicSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * PicController implements the CRUD actions for Pic model.
 */
class PicController extends Controller
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
     * Lists all Pic models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PicSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		
    if (Yii::$app->request->post('hasEditable')) {

        $picId = Yii::$app->request->post('editableKey');
        $model = Pic::findOne($picId);

        $post = [];
        $posted = current($_POST['Pic']);
        $post['Pic'] = $posted;
		
	
        if ($model->load($post)) {
           	
			
            $output = '';
			$model->save();
			
            $out = Json::encode(['output'=>$output, 'message'=>'']);
			
        } 
		echo $out;
        return $this->refresh();
    }
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		
		
	}

    /**
     * Displays a single Pic model.
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
     * Creates a new Pic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pic();
		if ($model->load(Yii::$app->request->post()) ) {
				 
			$a =$model->pic_fullName;
	   
			$connection = \Yii::$app->db;
				$sql = $connection->createCommand('SELECT  pic_fullName  FROM Pic WHERE pic_fullName = "'.$a.'"')->queryAll();
				
				if ($sql != null){
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('This Person has already existing in the database')
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
     * Updates an existing Pic model.
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
     * Deletes an existing Pic model.
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
     * Finds the Pic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pic::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
