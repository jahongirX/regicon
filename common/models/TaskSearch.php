<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'user_id', 'type_id', 'view_status', 'deadline_status', 'status'], 'integer'],
            [['registration_id', 'description', 'file', 'deadline', 'created_date', 'updated_date', 'answer_file', 'answer_description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'type_id' => $this->type_id,
            'deadline' => $this->deadline,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'view_status' => $this->view_status,
            'deadline_status' => $this->deadline_status,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'registration_id', $this->registration_id])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'answer_file', $this->answer_file])
            ->andFilterWhere(['like', 'answer_description', $this->answer_description]);

        return $dataProvider;
    }
}
