<?php

use yii\db\Migration;

/**
 * Class m190210_112235_add_shop_order_items_table
 */
class m190210_112235_add_shop_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_order_items}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer(),
            'product_name' => $this->string()->notNull(),
            'product_code' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_order_items-order_id}}', '{{%shop_order_items}}', 'order_id');
        $this->createIndex('{{%idx-shop_order_items-product_id}}', '{{%shop_order_items}}', 'product_id');


        $this->addForeignKey('{{%fk-shop_order_items-order_id}}', '{{%shop_order_items}}', 'order_id', '{{%shop_orders}}', 'id', 'CASCADE');
        $this->addForeignKey('{{%fk-shop_order_items-product_id}}', '{{%shop_order_items}}', 'product_id', '{{%shop_products}}', 'id', 'SET NULL');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_order_items}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190210_112235_add_shop_order_items_table cannot be reverted.\n";

        return false;
    }
    */
}
