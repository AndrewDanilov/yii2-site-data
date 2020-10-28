<?php
namespace andrewdanilov\sitedata\models;

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
	const VALUE_TYPE_STRING = 'string';
	const VALUE_TYPE_INTEGER = 'integer';
	const VALUE_TYPE_BOOLEAN = 'boolean';
	const VALUE_TYPE_TEXT = 'text';
	const VALUE_TYPE_REACHTEXT = 'reachtex';
	const VALUE_TYPE_FILE = 'file';
	const VALUE_TYPE_IMAGE = 'image';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_data';
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
            [['value'], 'boolean', 'on' => self::VALUE_TYPE_BOOLEAN],
            [['value'], 'integer', 'on' => self::VALUE_TYPE_INTEGER],
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

	public static function getTypeList()
	{
		return [
			self::VALUE_TYPE_STRING => 'Строка',
			self::VALUE_TYPE_INTEGER => 'Целое число',
			self::VALUE_TYPE_BOOLEAN => 'Двоичное',
			self::VALUE_TYPE_TEXT => 'Текст',
			self::VALUE_TYPE_REACHTEXT => 'HTML',
			self::VALUE_TYPE_FILE => 'Файл',
			self::VALUE_TYPE_IMAGE => 'Изображение',
		];
	}

	/**
	 * Подготавливает значение параметра в соответствии с его типом,
	 * а также задает сценарии валидации модели
	 */
	public function prepareValue()
	{
		if ($this->type == self::VALUE_TYPE_BOOLEAN) {
			$this->value = (boolean)$this->value;
			$this->setScenario(self::VALUE_TYPE_BOOLEAN);
		} elseif ($this->type == self::VALUE_TYPE_INTEGER) {
			$this->value = (int)$this->value;
			$this->setScenario(self::VALUE_TYPE_INTEGER);
		} else {
			$this->value = (string)$this->value;
			$this->setScenario(self::SCENARIO_DEFAULT);
		}
	}

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
		$param = self::find()->select(['value', 'type'])->where(['key' => $key])->asArray()->one();
		if ($param) {
			switch ($param['type']) {
				case self::VALUE_TYPE_BOOLEAN:
					return (boolean)$param['value'];
				case self::VALUE_TYPE_INTEGER:
					return (int)$param['value'];
				default:
					return $param['value'];
			}
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
			switch ($param->type) {
				case self::VALUE_TYPE_BOOLEAN:
					$param->value = (boolean)$value;
					break;
				case self::VALUE_TYPE_INTEGER:
					$param->value = (int)$value;
					break;
				default:
					$param->value = $value;
			}
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
		return self::find()->where(['key' => $key])->count() > 0;
	}
}
