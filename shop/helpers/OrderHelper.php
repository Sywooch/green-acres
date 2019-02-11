<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 05.06.18
 * Time: 14:14
 */

namespace shop\helpers;



use shop\entities\shop\Order\OrderGuest;
use shop\entities\shop\product\Product;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OrderHelper
{


    /**
     * @return array
     */

    public static function statusList()
    {

        return [

            OrderGuest::NEW_ORDER => 'New Order',
            OrderGuest::PAID => 'Paid',
            OrderGuest::SENT => 'Sent',
            OrderGuest::COMPLETED => 'Completed',
            OrderGuest::CANCELLED => 'Cancelled',
            OrderGuest::CANCELLED_BY_CUSTOMER => 'Cancelled by customer',


        ];


    }

    /**
     * @param $status
     * @return mixed
     */

    public static function statusName($status)
    {

        return ArrayHelper::getValue(self::statusList(), $status);


    }

    /**
     * @param $status
     * @return string
     */

    public static function statusLabel($status)
    {

        switch ($status) {

            case Product::STATUS_DRAFT:
                $class = 'label label-default';
                break;

            case Product::STATUS_ACTIVE:
                $class = 'label label-success';
                break;

            default:

                $class = 'label label-default';

        }

        return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), ['class' => $class]);

    }


}