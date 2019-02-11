<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.06.18
 * Time: 17:38
 */

namespace backend\forms\shop;


use shop\entities\shop\order\Order;
use shop\entities\shop\Order\OrderGuest;
use shop\helpers\OrderHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class OrderSearch extends Model
{


    public $id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
        ];
    }



    public function search($params)
    {

        $query = OrderGuest::find();

        $dataProvider = new ActiveDataProvider([

            'query' =>$query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        return $dataProvider;

    }

    public function statusList()
    {
        return OrderHelper::statusList();
    }
}