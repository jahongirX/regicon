<?php


namespace frontend\controllers;


use common\components\StaticFunctions;
use common\models\SiteUser;
use common\models\Task;
use common\models\TaskSearch;
use Yii;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

class MyController extends AppController
{
    public function actionView(){
        $id = Yii::$app->request->get('id');
        $model = Task::findOne($id);

        if(!empty($model) && $model->status == 0 && $model->view_status == 0){
            $model->view_status = 1;
            $model->status = 2;
            $model->save();
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())){
            $answerFile = UploadedFile::getInstance($model, 'answer_file');
            if($answerFile){
                $model->answer_file = StaticFunctions::saveFile($answerFile, $model->id, 'task','answerfile_');
            }
            $model->status = 4;
            if($model->save()){
                Yii::$app->session->setFlash('answer-success','Javob muvaffaqiyatli yuborildi!');
                $this->refresh();
            }
        }

        return $this->render('view',[
            'model' => $model
        ]);

    }

    public function actionAll(){
        $user = SiteUser::findOne(Yii::$app->user->getId());

        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['id'=>SORT_DESC])->andWhere(['user_id'=>$user->id]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];
        return $this->render('all',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionClosed(){
        $user = SiteUser::findOne(Yii::$app->user->getId());

        $searchModel = new TaskSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['id'=>SORT_DESC])->andWhere(['user_id'=>$user->id])->andWhere(['status'=>4]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];
        return $this->render('closed',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}