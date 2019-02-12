<?php

/* @var $this yii\web\View */
/* @var $order shop\entities\shop\order\OrderGuest */
/* @var $model shop\forms\manage\order\OrderEditGuestForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Update Order: ' . $order->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="order-update">

    <?php $form = ActiveForm::begin() ?>

    <div class="box box-default">
        <div class="box-header with-border">Customer</div>
        <div class="box-body">
            <?= $form->field($model, 'phone')->textInput() ?>
            <?= $form->field($model, 'name')->textInput() ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Delivery</div>
        <div class="box-body">
            <?= $form->field($model, 'delivery')->dropDownList($model->deliveryMethodsList(), ['prompt' => '--- Select ---']) ?>
            <?= $form->field($model, 'index')->textInput() ?>
            <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Note</div>
        <div class="box-body">
            <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
