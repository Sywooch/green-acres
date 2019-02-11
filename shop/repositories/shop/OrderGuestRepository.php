<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.05.18
 * Time: 19:25
 */
namespace shop\repositories\shop;



use shop\entities\shop\Order\OrderGuest;
use shop\entities\shop\order\OrderItem;
use yii\web\NotFoundHttpException;

/**
 * Class OrderGuestRepository
 * @package shop\repositories\Shop
 */
class OrderGuestRepository
{

    /**
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */

    public function get($id)
    {
        if (!$order = OrderGuest::findOne($id)) {
            throw new NotFoundHttpException('Order is not found.');
        }
        return $order;
    }

    /**
     * @param OrderGuest $order
     * @return Order
     */
    public function save(OrderGuest $order)
    {
        if (!$order->save() ) {
            throw new \RuntimeException('Saving error.');

        }

       else return $order;
    }

    /**
     * @param OrderGuest $order
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */

    public function remove(OrderGuest $order)
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }







}