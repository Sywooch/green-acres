<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.05.18
 * Time: 19:23
 */

namespace shop\services\shop;


use shop\cart\Cart;
use shop\entities\shop\Order\OrderGuest;
use shop\entities\shop\order\OrderItem;
use shop\forms\shop\order\OrderGuestForm;
use shop\repositories\shop\DeliveryRepository;
use shop\repositories\shop\OrderGuestRepository;
use shop\repositories\shop\ProductRepository;
use shop\services\TransactionManager;
use yii\mail\MailerInterface;

class OrderGuestService
{

    private $cart;
    private $orders;
    private $products;
    private $deliveryMethods;
    private $transaction;
    private $mailer;


    public function __construct(
        CartService $cart, OrderGuestRepository $orders, ProductRepository $products, DeliveryRepository $deliveryMethods, TransactionManager $transaction, MailerInterface $mailer


    )
    {
        $this->cart = $cart;
        $this->orders = $orders;
        $this->products = $products;
        $this->deliveryMethods = $deliveryMethods;
        $this->transaction = $transaction;
        $this->mailer = $mailer;


    }


    public function checkoutGuest(OrderGuestForm $form, $cart, $totalCount)
    {


        $order = OrderGuest::create($form->delivery, $form->note, $form->phone, $form->name, $form->index, $form->address);

        $delivery = $this->deliveryMethods->get($form->delivery);

        $order->delivery_method_name = $delivery->name;
        $order->delivery_cost = $delivery->cost;
        $order->cost = $totalCount + $delivery->cost;

        $newOrder = $this->orders->save($order);


        foreach ($cart as $i => $item) {

            $productId = (int)$item['product']->id;
            $product = $this->products->get($productId);

            $orderItem = OrderItem::create(
                 $newOrder,
                $product,
                $item['product']->price_new,
                $item['quantity']
            );

            $orderItem->save();

        }


        $sent = $this->mailer->compose(

            ['html' => 'order/order/confirmOrder-html'],
            [
                'newOrder' => $newOrder,
            ])
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject('New order')
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }




        return $newOrder;
    }

}