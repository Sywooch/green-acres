<?php

use shop\helpers\OrderHelper;
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order shop\entities\shop\order\OrderGuest */
\frontend\assets\FontAwesomeAsset::register($this);

if($random){
  return;
}
$this->title = 'Order ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Сохранить заказ', ['export', 'id' => $order->id], ['class' => 'btn btn-primary', 'data-method' => 'post', 'data-confirm' => 'Сохранить заказ?']) ?>
    </p>

    <div class="box">
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $order,
                'attributes' => [


                    [
                        'attribute' => 'created_at',
                        'value' => date('Y:d:m H:i:s', $order->created_at),
                        'label' => 'Дата создания',
                    ],

                    [
                        'attribute' => 'current_status',
                        'value' => OrderHelper::statusLabel($order->current_status),
                        'format' => 'raw',
                        'label' => 'Статус заказа',
                    ],

                    [
                        'attribute' => 'delivery_method_name',
                        'label' => 'Доставка',
                    ],


                    [
                        'attribute' => 'delivery_index',
                        'label' => 'Индекс',
                    ],
                    [

                        'attribute' => 'delivery_address',
                        'label' => 'Адрес доставки',
                    ],

                    [
                        'attribute' => 'cost',
                        'value' => function ($order) {
                            return PriceHelper::format($order->cost);
                        },
                        'format' => 'raw',
                        'label' => 'Полная стоимость заказа с доставкой',
                    ],
                    [
                        'attribute' => 'note',
                        'label' => 'Комментарии',
                    ]
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered" style="margin-bottom: 0">
                    <thead>
                    <tr>
                        <th class="text-left">Товар</th>
                        <th class="text-left">Количество</th>
                        <th class="text-right">Цена за единицу товара</th>
                        <th class="text-right">Всего к оплате</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($order->items as $item): ?>
                        <tr>
                            <td class="text-left">
                                <?= Html::encode($item->product_code) ?><br/>
                                <?= Html::encode($item->product_name) ?>
                            </td>
                            <td class="text-left">
                                <?= $item->quantity ?>
                            </td>
                            <td class="text-right">

                                <?= PriceHelper::format($item->price) ?>

                            </td>
                            <td class="text-right"><?= PriceHelper::format((int)$item->price * $item->quantity) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
