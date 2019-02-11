<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 05.06.18
 * Time: 13:48
 */

namespace shop\readModels\shop;


use shop\entities\shop\order\Order;
use yii\data\ActiveDataProvider;

class OrderReadRepository
{


    public function getOwnOrder($userId)
    {
        return new ActiveDataProvider([

            'query' => Order::find()->andWhere(['user_id' => $userId])->orderBy(['id' => SORT_DESC]),
            'sort' => false,


        ]);


    }


    public function findOwnOrder($userId, $id)
    {


        return Order::find()->andWhere(['user_id' => $userId, 'id' => $id])->one();

    }



}