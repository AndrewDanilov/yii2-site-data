<?php
namespace andrewdanilov\sitedata\models;

use andrewdanilov\behaviors\ValueTypeBehavior;

/**
 * This is the model class for table "site_data".
 *
 * @property int $id
 * @property int $category_id
 * @property string $key
 * @property string $value
 * @property int $type
 * @property string $name
 * @property SiteDataCategory $category
 */
class SiteData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_data';
    }

    public function behaviors()
    {
	    return [
	    	[
	    		'class' => ValueTypeBehavior::class,
		    ],
	    ];
    }

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'key', 'type'], 'required'],
            [['category_id'], 'integer'],
            [['type', 'name'], 'string'],
            [['value'], 'boolean', 'on' => ValueTypeBehavior::VALUE_TYPE_BOOLEAN],
            [['value'], 'integer', 'on' => ValueTypeBehavior::VALUE_TYPE_INTEGER],
            [['value'], 'string', 'on' => self::SCENARIO_DEFAULT],
            [['key'], 'unique'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Раздел',
            'key' => 'Параметр',
            'value' => 'Значение',
            'type' => 'Тип',
            'name' => 'Название',
        ];
    }

	public function getCategory()
	{
		return $this->hasOne(SiteDataCategory::class, ['id' => 'category_id']);
	}

	//////////////////////////////////////////////////////////////////

	/**
	 * Возвращает значение параметра по его ключу,
	 * в соответствии с его типом.
	 *
	 * @param string $key
	 * @param bool|int|mixed $defaultValue
	 * @return bool|int|mixed
	 */
	public static function getValue($key, $defaultValue=null)
	{
		/* @var $param SiteData|ValueTypeBehavior */
		$param = self::find()->select(['value', 'type'])->where(['key' => $key])->one();
		if ($param) {
			return $param->formatValue();
		} else {
			return $defaultValue;
		}
	}

	/**
	 * Сохраняет значение параметра
	 *
	 * @param $key
	 * @param $value
	 */
	public static function setValue($key, $value)
	{
		$param = self::find()->where(['key' => $key])->one();
		if ($param) {
			$param->value = $value;
			$param->save();
		}
	}

	/**
	 * Проверяет существование параметра с переданным ключом
	 *
	 * @param $key
	 * @return bool
	 */
	public static function hasValue($key)
	{
		return self::find()->where(['key' => $key])->exists();
	}
}
