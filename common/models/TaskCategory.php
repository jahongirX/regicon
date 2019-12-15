<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task_category".
 *
 * @property int $id
 * @property string $name
 * @property int $order_by
 * @property int $status
 */
class TaskCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'order_by', 'status'], 'required'],
            [['order_by', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'order_by' => 'Order By',
            'status' => 'Status',
        ];
    }
}
