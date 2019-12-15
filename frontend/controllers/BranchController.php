<?php


namespace frontend\controllers;


use common\models\SiteUser;
use common\models\SiteUserSearch;
use frontend\models\SignupForm;
use Yii;
use yii\widgets\ActiveForm;

class BranchController extends AppController
{
    public function actionIndex(){

        $user = SiteUser::findOne(Yii::$app->user->getId());
        if($user->rank > 10){
            return $this->goBack();
        }

        $searchModel = new SiteUserSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['creator'=>Yii::$app->user->getId()]);
        $dataProvider->pagination->pageSize = Yii::$app->params['pagination'];

        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd(){

        $user = SiteUser::findOne(Yii::$app->user->getId());
        if($user->rank > 10){
            return $this->goBack();
        }

        $model = new SignupForm();

        $user = SiteUser::findOne(Yii::$app->user->getId());

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())){

            if($user->rank == 10){
                $model->rank = 100;
                $model->creator = $user->id;
                $model->company_id = $user->company_id;
            }

            if($model->signup()){
                Yii::$app->session->setFlash('add-branch-success',"Filial muvaffaqiyatli qo'shildi!");
                return $this->redirect('/branch/index');
            }

        }

        return $this->render('add',[
            'model' => $model,
            'user' => $user
        ]);
    }
}