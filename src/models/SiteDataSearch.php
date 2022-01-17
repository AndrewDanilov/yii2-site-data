<?php
namespace andrewdanilov\sitedata\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SiteDataSearch represents the model behind the search form of `andrewdanilov\sitedata\models\SiteData`.
 */
class SiteDataSearch extends SiteData
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'order'], 'integer'],
            [['key', 'value', 'name', 'type'], 'safe'],
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
        $query = SiteData::find()->joinWith(['category'], false);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
	        'sort' => [
		        'defaultOrder' => [
			        'category_order' => SORT_ASC,
			        SiteData::tableName() . '.order' => SORT_ASC,
			        'id' => SORT_ASC,
		        ],
		        'attributes' => [
			        'id',
			        'category_id' => [
				        'asc' => [SiteDataCategory::tableName() . '.name' => SORT_ASC],
				        'desc' => [SiteDataCategory::tableName() . '.name' => SORT_DESC],
			        ],
			        'key',
			        'value',
			        'type',
			        'name',
			        SiteDataCategory::tableName() . '.order as category_order',
			        SiteData::tableName() . '.order',
		        ],
	        ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
	        SiteData::tableName() . '.id' => $this->id,
	        SiteData::tableName() . '.category_id' => $this->category_id,
	        SiteData::tableName() . '.type' => $this->type,
	        SiteData::tableName() . '.order' => $this->order,
        ]);

        $query->andFilterWhere(['like', SiteData::tableName() . '.key', $this->key])
            ->andFilterWhere(['like', SiteData::tableName() . '.value', $this->value])
	        ->andFilterWhere(['like', SiteData::tableName() . '.name', $this->name]);

        return $dataProvider;
    }
}
