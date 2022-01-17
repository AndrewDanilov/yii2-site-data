<?php

use yii\db\Migration;

/**
 * Class m220117_095454_site_data_add_order_field_to_params
 */
class m220117_095454_site_data_add_order_field_to_params extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
	    $this->addColumn('{{%site_data}}', 'order', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%site_data}}', 'order');
    }
}
