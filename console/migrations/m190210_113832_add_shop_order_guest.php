<?php

use yii\db\Migration;

/**
 * Class m190210_113832_add_shop_order_guest
 */
class m190210_113832_add_shop_order_guest extends Migration
{

        /**
         * {@inheritdoc}
         */
        public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_orders_guest}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'username' => $this->text(),
            'delivery_method_id' => $this->integer(),
            'delivery_method_name' => $this->string()->notNull(),
            'delivery_cost' => $this->integer()->notNull(),
            'payment_method' => $this->string(),
            'cost' => $this->integer()->notNull(),
            'note' => $this->text(),
            'current_status' => $this->integer()->notNull(),
            'cancel_reason' => $this->text(),
            'customer_phone' => $this->string(),
            'customer_name' => $this->string(),
            'delivery_index' => $this->string(),
            'delivery_address' => $this->text(),
        ], $tableOptions);


        $this->createIndex('{{%idx-shop_orders-delivery_method_id}}', '{{%shop_orders_guest}}', 'delivery_method_id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_orders_guest}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190210_113832_add_shop_order_guest cannot be reverted.\n";

        return false;
    }
    */
}
