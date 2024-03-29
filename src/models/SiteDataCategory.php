<?php
namespace andrewdanilov\sitedata\models;

/**
 * This is the model class for table "site_data_category".
 *
 * @property int $id
 * @property string $name
 * @property int $order
 * @property SiteData[] $data
 */
class SiteDataCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_data_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order'], 'integer'],
            [['order'], 'default', 'value' => 0],
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
            'name' => 'Название',
            'order' => 'Порядок',
        ];
    }

	public function getData()
	{
		return $this->hasMany(SiteData::class, ['category_id' => 'id'])->orderBy('order');
	}

	public static function getCategoriesList()
	{
		return static::find()->select(['name', 'id'])->orderBy('order')->indexBy('id')->column();
	}
}
