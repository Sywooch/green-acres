<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 11.02.19
 * Time: 12:40
 */

namespace shop\entities\shop\Order;


use shop\entities\shop\product\Product;
use yii\db\ActiveRecord;


/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $modification_id
 * @property string $product_name
 * @property string $product_code
 * @property string $modification_name
 * @property string $modification_code
 * @property int $price
 * @property int $quantity
 */


class OrderItem extends ActiveRecord

{


    public static function tableName()
    {
        return '{{%shop_order_items}}';
    }


    public static function create(OrderGuest $orderGuest, Product $product, $price, $quantity)
    {
        $item = new static;

        $item->order_id = $orderGuest->id;
        $item->product_id = $product->id;
        $item->product_name = $product->name;
        $item->product_code = $product->code;
        $item->price = $price;
        $item->quantity = $quantity;

        return $item;

    }











}