<?php


namespace frontend\controllers;


use common\components\StaticFunctions;
use common\models\SiteUser;
use common\models\Task;
use common\models\TaskSearch;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class TaskController extends AppController
{

    public function actionIndex(){
        $user = SiteUser::findOne(Yii::$app->user->getId());
        if($user->rank > 10){
            return $this->goBack();
        }

        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['id'=>SORT_DESC]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd(){
        $model = new Task();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }


        if($model->load(Yii::$app->request->post())){
            $model->deadline = date('Y-m-d',strtotime($model->deadline));
            $taskFile = UploadedFile::getInstance($model, 'file');
            if(!empty($model->user_id)){
                foreach ($model->user_id as $item) {
                    $task = new Task();
                    $task->description = $model->description;
                    $task->user_id = $item;
                    $task->category_id = $model->category_id;
                    $task->type_id = $model->type_id;
                    $task->deadline = $model->deadline;

                    if($task->save()){
                        $task->registration_id = date("dmY-") . $task->id;
                        if($taskFile)
                        {
                            $task->file = StaticFunctions::saveFile($taskFile, $task->id, 'task','file_');
                        }
                        $task->view_status = 0;
                        $task->deadline_status = 0;
                        $task->status = 0;
                    }

                    if($task->save()){

                    }else{
                        return print_r($task->errors);
                    }
                }

                return $this->redirect('/task/index');
            }
        }

        return $this->render('add',[
            'model' => $model
        ]);
    }
}