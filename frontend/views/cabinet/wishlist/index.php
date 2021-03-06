<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

use shop\entities\Shop\Product\Product;
use shop\helpers\PriceHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Избранное';
$this->params['breadcrumbs'][] = ['label' => 'Личный кабинет', 'url' => ['cabinet/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1 class="_top"><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            [
                'value' => function (Product $model) {
                    $photo = \shop\entities\shop\product\Photo::findOne(['id' => $model->mainPhoto]);
                    return $model->mainPhoto ? Html::img($photo->getCartWidgetListPhotoFileUrl($model->id, $photo->id)) : null;
                },
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 100px'],
            ],

            [
                'attribute' => 'name',
                'value' => function (Product $model) {
                    return Html::a(Html::encode($model->name), ['/shop/catalog/product', 'id' => $model->id]);
                },
                'format' => 'raw',
                'label' => 'Название'
            ],
            [
                'attribute' => 'price_new',
                'value' => function (Product $model) {
                    return PriceHelper::format($model->price_new);
                },
                'label' => 'Стоимость'
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{delete}',


            ],
        ],
    ]); ?>

</div>
