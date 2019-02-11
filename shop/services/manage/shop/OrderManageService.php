<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.06.18
 * Time: 16:54
 */

namespace shop\services\manage\shop;


use shop\entities\shop\order\CustomerData;
use shop\entities\shop\order\DeliveryData;
use shop\forms\manage\shop\order\OrderEditForm;
use shop\repositories\shop\DeliveryRepository;
use shop\repositories\shop\OrderGuestRepository;

class OrderManageService
{

    private $orders;
    private $deliveryMethods;

    public function __construct(OrderGuestRepository $orders, DeliveryRepository $deliveryMethods)
    {

        $this->orders = $orders;
        $this->deliveryMethods = $deliveryMethods;


    }


    /**
     * @param $id
     * @param OrderEditForm $form
     * @throws \yii\web\NotFoundHttpException
     */

    public function edit($id, OrderEditForm $form)
    {
        $order = $this->orders->get($id);
        $order->edit(

           new CustomerData(

               $form->customer->phone,
               $form->customer->name
           ),
            $form->note
        );

        $order->setDeliveryInfo(
            $this->deliveryMethods->get($form->delivery->method),
            new DeliveryData(
                $form->delivery->index,
                $form->delivery->address
            )
        );

        $this->orders->save($order);


    }

    /**
     * @param $id
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */

    public function remove($id)
    {
        $order = $this->orders->get($id);
        $this->orders->remove($order);
    }







}