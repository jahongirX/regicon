<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $registration_id
 * @property int $category_id
 * @property int $user_id
 * @property string $description
 * @property int $type_id
 * @property string $file
 * @property string $deadline
 * @property string $created_date
 * @property string $updated_date
 * @property int $view_status
 * @property int $deadline_status
 * @property int $status
 * @property string $answer_file
 * @property string $answer_description
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT =>['created_date','updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE =>['updated_date'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'category_id', 'user_id', 'type_id', 'deadline'], 'required'],
            [['category_id', 'type_id', 'view_status', 'deadline_status', 'status'], 'integer'],
            [['description', 'answer_description'], 'string'],
            [['deadline', 'created_date', 'updated_date','user_id'], 'safe'],
            [['registration_id', 'file', 'answer_file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'registration_id' => 'Registration ID',
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'description' => 'Description',
            'type_id' => 'Type ID',
            'file' => 'File',
            'deadline' => 'Deadline',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'view_status' => 'View Status',
            'deadline_status' => 'Deadline Status',
            'status' => 'Status',
            'answer_file' => 'Answer File',
            'answer_description' => 'Answer Description',
        ];
    }

    public static function getHierarchy() {

        $options = [];
        $user = SiteUser::findOne(Yii::$app->user->getId());
        $districts = District::find()->where('parent=8')->all();

        foreach ($districts as $district){
            $users = SiteUser::find()->where(['creator'=>$user->id])->andWhere(['rank' => 100])->all();
            if(!empty($users)){
                $userOptions = [];
                foreach ($users as $user) {
                    $userOptions[$user->id] = $user->username;
                }
                $options[$district->name] = $userOptions;
            }else{
                continue;
            }

        }

        return $options;
    }
}
