<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.06.18
 * Time: 23:04
 */

/* @var $this yii\web\View */
/* @var $newOrder \shop\entities\shop\order\OrderGuest */

use yii\helpers\Html;

?>

<div class="password-reset">
    <p>Hello,</p>

    <p>New Order:</p>
    <p> <?= Html::encode($newOrder->delivery_method_name) ?></p>
    <p> <?= Html::encode($newOrder->cost) ?></p>


</div>

