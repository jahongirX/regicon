<?php


namespace frontend\controllers;


use common\components\StaticFunctions;
use common\models\SiteUser;
use common\models\Task;
use common\models\TaskSearch;
use Yii;
use yii\db\Query;
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
        $branches = (new Query())->select('id')->from('site_user')->where(['creator'=>$user->id]);
        $dataProvider->query->andWhere(['user_id'=>$branches]);
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
        $user = SiteUser::findOne(Yii::$app->user->getId());

        $branches = SiteUser::find()->where(['creator'=>$user->id])->all();
//        print_r($branches);die;

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
            'model' => $model,
            'branches' => $branches
        ]);
    }

    public function actionView(){
        $id = Yii::$app->request->get('id');
        $model = Task::findOne($id);
        return $this->render('view',[
            'model' => $model
        ]);

    }

    public function actionClose(){
        $id = Yii::$app->request->get('id');
        $model = Task::findOne($id);
        $model->status = 5;
        if($model->save()){
            return $this->redirect('view',[
                'id'=>$id
            ]);
        }
    }

    public function actionClosed(){
        $user = SiteUser::findOne(Yii::$app->user->getId());
        if($user->rank > 10){
            return $this->goBack();
        }

        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $branches = (new Query())->select('id')->from('site_user')->where(['creator'=>$user->id]);
        $dataProvider->query->andWhere(['user_id'=>$branches]);
        $dataProvider->query->orderBy(['id'=>SORT_DESC])->andWhere(['status'=>5]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];

        return $this->render('closed',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeadline(){
        $user = SiteUser::findOne(Yii::$app->user->getId());
        if($user->rank > 10){
            return $this->goBack();
        }

        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $branches = (new Query())->select('id')->from('site_user')->where(['creator'=>$user->id]);
        $dataProvider->query->andWhere(['user_id'=>$branches]);
        $dataProvider->query->orderBy(['id'=>SORT_DESC])->andWhere(['status'=>3]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];

        return $this->render('closed',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}