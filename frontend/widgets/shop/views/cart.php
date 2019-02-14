<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 28.05.18
 * Time: 10:45
 */
/* @var $cart \shop\cart\Cart */

use shop\helpers\PriceHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div id="cart" class="btn-group btn-block">

<button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="btn btn-inverse btn-block btn-lg dropdown-toggle" aria-expanded="false">
    <i class="fa fa-shopping-cart"></i>
    <span id="cart-total"><?= $cart->getAmount()?> item(s) - <?= PriceHelper::format($cart->totalCount()) ?>

    </span>

</button>

    <ul class="dropdown-menu pull-right">
        <li>
            <table class="table table-striped">

                <?php foreach ($cartItems as $i => $item): ?>
                    <?php

                    $id = $item['id'];
                    $productId =(int)$item['product']->id;
                    $quantity = $item['quantity'];
                    $product = \shop\entities\shop\product\Product::find()->andWhere(['id' => $productId])->one();
                    $photo = \shop\entities\shop\product\Photo::findOne(['id' => $product->mainPhoto]);
                    $url = Url::to(['/shop/catalog/product', 'id' => $product->id]);
                    ?>
                    <tr>
                        <td class="text-center">
                            <?php if ($product->mainPhoto): ?>
                                <img src="<?= Html::encode($product->mainPhoto->getCartWidgetListPhotoFileUrl($product->id, $product->main_photo_id)) ?>" alt="" class="img-thumbnail" />
                            <?php endif; ?>
                        </td>
                        <td class="text-left">
                            <a href="<?= $url ?>"><?= Html::encode($product->name) ?></a>

                        </td>
                        <td class="text-right">x <?=$quantity ?></td>
                        <td class="text-right"><?= PriceHelper::format($product->price_new) ?></td>
                        <td class="text-center">
                            <a href="<?= Url::to(['/shop/cart/remove', 'id' => $id]) ?>" title="Remove" class="btn btn-danger btn-xs" data-method="post"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>

            </table>


        </li>


        <li>
            <div>
                <?php $cost = $cart->totalCount(); ?>
                <table class="table table-bordered">
                <tr>
<!--                    <td class="text-right"><strong>Sub-Total:</strong></td>-->
<!--                    <td class="text-right">--><?//= PriceHelper::format($cost->getOrigin())?><!--</td>-->

                </tr>


                    <tr>
                        <td class="text-right"><strong>Итого:</strong></td>
                        <td class="text-right"><?= PriceHelper::format($cart->totalCount()) ?></td>
                    </tr>


                </table>


                <p class="text-right"><a
                            href="<?= Url::to(['/shop/cart/index']) ?>"><strong><i
                                    class="fa fa-shopping-cart"></i> Корзина покупок</strong></a>&nbsp;&nbsp;&nbsp;<a
                            href="<?= Url::to(['/shop/cart/index']) ?>"><strong><i
                                    class="fa fa-share"></i>Оформление заказа</strong></a></p>





            </div>
        </li>






    </ul>








</div>


