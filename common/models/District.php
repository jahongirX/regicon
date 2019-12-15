<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "district".
 *
 * @property int $id
 * @property int $parent
 * @property string $name
 * @property int|null $order_by
 * @property int|null $status
 */
class District extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'district';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'name'], 'required'],
            [['parent', 'order_by', 'status'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent' => 'Parent',
            'name' => 'Name',
            'order_by' => 'Order By',
            'status' => 'Status',
        ];
    }
}
