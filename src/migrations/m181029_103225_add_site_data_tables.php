<?php

use yii\db\Migration;

/**
 * Class m181029_103225_add_site_data_tables
 */
class m181029_103225_add_site_data_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $tableOptions = null;
	    if ($this->db->driverName === 'mysql') {
		    $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
	    }

	    // data categories
	    $this->createTable('{{%site_data_category}}', [
		    'id' => $this->primaryKey(),
		    'name' => $this->string()->notNull(),
		    'order' => $this->smallInteger()->notNull()->defaultValue(0),
	    ], $tableOptions);

	    // data values
	    $this->createTable('{{%site_data}}', [
		    'id' => $this->primaryKey(),
		    'category_id' => $this->integer()->notNull(),
		    'key' => $this->string()->notNull(),
		    'value' => $this->text(),
		    'type' => $this->string(10)->notNull(),
		    'name' => $this->string()->notNull(),
	    ], $tableOptions);

	    $this->createIndex(
		    'idx-site_data-category_id',
		    '{{%site_data}}',
		    'category_id'
	    );

	    $this->createIndex(
		    'ux-site_data-key',
		    '{{%site_data}}',
		    'key',
		    true
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-site_data-category_id', '{{%site_data}}');
        $this->dropIndex('ux-site_data-key', '{{%site_data}}');
        $this->dropTable('{{%site_data}}');
        $this->dropTable('{{%site_data_category}}');
    }
}
