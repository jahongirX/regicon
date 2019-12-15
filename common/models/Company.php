<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $director
 * @property string $address
 * @property string $phone
 * @property int $status
 * @property int $order_by
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'director', 'address', 'phone', 'status', 'order_by'], 'required'],
            [['status', 'order_by'], 'integer'],
            [['name', 'director', 'address'], 'string', 'max' => 500],
            [['phone'], 'string', 'max' => 15],
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
            'director' => 'Director',
            'address' => 'Address',
            'phone' => 'Phone',
            'status' => 'Status',
            'order_by' => 'Order By',
        ];
    }
}
