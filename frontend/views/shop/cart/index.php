<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.02.19
 * Time: 15:54
 */
/* @var $cart shop\cart\Cart[] */
/* @var $cart shop\cart\Cart */
use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\entities\shop\product\Photo;

$this->title = Yii::t('app', 'Shopping Cart');
$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['/shop/catalog/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">

    <h1 class="_top"><?= Html::encode($this->title) ?></h1>


    <div class="table-responsive">
        <table class="table table-bordered">

            <thead>
            <tr>
                <td class="text-center" style="width: 100px">Изображение</td>
                <td class="text-left">Product Name</td>
                <td class="text-left">Количество</td>
                <td class="text-right">Цена за единицу</td>
                <td class="text-right">Всего</td>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($cart as $i => $item):?>

                <?php
                $id = $item['id'];
                $productId =(int)$item['product']->id;
                $quantity = $item['quantity'];
                $product = \shop\entities\shop\product\Product::find()->andWhere(['id' => $productId])->one();
                $photo = Photo::findOne(['id' => $product->mainPhoto]);
                $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                ?>
                <tr>

                <td class="text-center">
                    <a href="<?= $url ?>">

                        <?php if ($product->mainPhoto): ?>
                            <?= Html::img($photo->getCartListPhotoFileUrl($product->id, $photo->id), ['style' => 'width: 50%']) ?>
                        <?php endif; ?>

                    </a>
                </td>

                <td class="text-left">
                    <a href=""><?= Html::encode($product->name) ?></a>
                </td>
                <td class="text-left">

                    <?= Html::beginForm(['add-quantity', 'id' => $id]); ?>

                    <div class="input-group btn-block" style="max-width: 200px;">
                        <input type="text" name="addQuantity" value="<?=$quantity ?>" size="1"
                               class="form-control"/>

                        <span class="input-group-btn">
                         <button type="submit" title="" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>

                            <a title="Remove" class="btn btn-danger"
                               href="<?= Url::to(['remove', 'id' => $id]) ?>" data-method="post"><i
                                        class="fa fa-times-circle"></i></a>
                        </span>

                    </div>
                    <?= Html::endForm() ?>
                </td>

                <td class="text-right"><?= $product->price_new ?></td>
                <td class="text-right"><?= PriceHelper::format($product->price_new * $quantity) ?></td>

            </tr>


            <?php endforeach;?>
            </tbody>

        </table>
    </div>

    <br/>



    <div class="row">
        <div class="col-sm-4 col-sm-offset-8">
            <table class="table table-bordered">

<!--                --><?php //foreach ($cost->getDiscounts() as $discount): ?>
<!--                    <tr>-->
<!--                        <td class="text-right"><strong>--><?//= Html::encode($discount->getName()) ?><!--:</strong></td>-->
<!--                        <td class="text-right">--><?//= PriceHelper::format($discount->getValue()) ?><!--</td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>

                </tr>
                <tr>
                    <td class="text-right"><strong>Вес:</strong></td>

                </tr>

                <tr>
                    <td class="text-right"><strong>Скидка:</strong></td>

                </tr>
                <tr>
                    <td class="text-right"><strong>Полная стоимость:</strong></td>
                    <td class="text-right"><?=$total ?></td>
                </tr>
            </table>
        </div>
    </div>






    <div class="buttons clearfix">
        <div class="pull-left"><a href="<?= Url::to('/shop/catalog/index') ?>" class="btn btn-default"><?= Yii::t('app', 'Continue Shopping')?></a></div>
        <div class="pull-right"><a href="<?= Url::to('/shop/cart/clear-cart') ?>" class="btn btn-default"><?= Yii::t('app', 'Empty baskets')?> </a></div>
    </div>




</div>
