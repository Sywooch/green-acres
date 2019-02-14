<?php

/* @var $this yii\web\View */
/* @var $cart \shop\cart\Cart */
/* @var $model \shop\forms\Shop\Order\OrderGuestForm */

use shop\helpers\PriceHelper;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Оформление заказа';
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = ['label' => 'Shopping Cart', 'url' => ['/shop/cart/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1 class="_top"><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-left">Название товара</td>

                <td class="text-left">Количество</td>
                <td class="text-right">Цена за единицу</td>
                <td class="text-right">Стоимость</td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($cart as $i => $item):?>

                <?php
                $id = $item['id'];
                $productId =(int)$item['product']->id;
                $quantity = $item['quantity'];
                $product = \shop\entities\shop\product\Product::find()->andWhere(['id' => $productId])->one();
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>
                    <td class="text-left">
                        <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>
                    </td>
                    <td class="text-left">
                        <?=$quantity ?>
                    </td>
                    <td class="text-right"><?= PriceHelper::format($product->price_new) ?></td>
                    <td class="text-right"><?= PriceHelper::format($product->price_new * $quantity) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <br />

    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">

                <!--                --><?php //foreach ($cost->getDiscounts() as $discount): ?>
                <!--                    <tr>-->
                <!--                        <td class="text-right"><strong>--><?//= Html::encode($discount->getName()) ?><!--:</strong></td>-->
                <!--                        <td class="text-right">--><?//= PriceHelper::format($discount->getValue()) ?><!--</td>-->
                <!--                    </tr>-->
                <!--                --><?php //endforeach; ?>

<!--                </tr>-->
                <tr>
                    <td class="text-right"><strong>Вес:</strong></td>
                    <td class="text-right">Вес заказа до 2кг</td>
                </tr>

                <tr>
                    <td class="text-right"><strong>Скидка:</strong></td>

                </tr>
                <tr>
                    <td class="text-right"><strong>Стоимость:</strong></td>
                    <td class="text-right"><?=PriceHelper::format($totalCount) ?></td>
                </tr>
            </table>
        </div>
    </div>




    <?php $form = ActiveForm::begin() ?>

    <div class="panel panel-default">
        <div class="panel-heading">Покупатель</div>
        <div class="panel-body">
            <?= $form->field($model, 'phone')->textInput() ?>
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Доставка</div>
        <div class="panel-body">
            <?= $form->field($model, 'delivery')->dropDownList($model->deliveryMethodsList(), ['prompt' => '--- Доставка ---']) ?>
            <?= $form->field($model, 'index')->textInput() ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Комментарии</div>
        <div class="panel-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Оформить заказ', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end() ?>

</div>
    
