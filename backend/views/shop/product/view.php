<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 21.03.18
 * Time: 10:52
 */

use yii\bootstrap\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use shop\helpers\PriceHelper;
use shop\helpers\ProductHelper;
use shop\helpers\WeightHelper;


/* @var $this yii\web\View */
/* @var $product shop\entities\shop\product\Product */
/* @var $photosForm shop\forms\manage\shop\product\PhotosForm */
/* @var $modificationsProvider yii\data\ActiveDataProvider */
\frontend\assets\FontAwesomeAsset::register($this);
$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?php if ($product->isActive()): ?>
            <?= Html::a('Draft', ['draft', 'id' => $product->id], ['class' => 'btn btn-primary', 'data-method' => 'post']) ?>
        <?php else: ?>
            <?= Html::a('Activate', ['activate', 'id' => $product->id], ['class' => 'btn btn-success', 'data-method' => 'post']) ?>
        <?php endif; ?>
        <?= Html::a('Update', ['update', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $product->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">Common</div>
                <div class="box-body">

                    <?= DetailView::widget([
                        'model' => $product,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'Статус',
                                'value' => ProductHelper::statusLabel($product->status),
                                'format' => 'raw',
                            ],

                            [
                                'attribute' => 'Бренд',
                                'value' => ArrayHelper::getValue($product, 'brand.name'),
                            ],
                            'code',
                            'name',
                            [
                                'attribute' => 'Основная категория',
                                'value' => ArrayHelper::getValue($product, 'category.name'),
                            ],

                            [
                                'label' => 'Дополнительные категории',
                                'value' => implode(', ', ArrayHelper::getColumn($product->categories, 'name')),
                            ],

                            [
                                'label' => 'Тэги',
                                'value' => implode(', ', ArrayHelper::getColumn($product->tags, 'name')),
                            ],
                            [
                                'attribute' => 'Вес',
                                'value' => WeightHelper::format($product->weight),
                            ],

                            'quantity',
                            [
                                'attribute' => 'Цена',
                                'value' => PriceHelper::format($product->price_new),
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'Уена старая',
                                'value' => PriceHelper::format($product->price_old),
                                'format' => 'raw',
                            ],

                            [
                                'attribute' => 'recommended',
                                'format' => 'raw',
                            ],

                            [
                                'attribute' => 'popular',
                                'format' => 'raw',
                            ],


                        ],

                    ]); ?>

                    <br/>
                    <p>
                        <?= Html::a('Изменить цену', ['price', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>


                        <?= Html::a('Изменить количество', ['quantity', 'id' => $product->id], ['class' => 'btn btn-primary']) ?>

                    </p>

                </div>
            </div>
        </div>

    </div>
</div>


<div class="box">
    <div class="box-header with-border">Description</div>
    <div class="box-body">
        <?= Yii::$app->formatter->asHtml($product->description, [
            'Attr.AllowedRel' => array('nofollow'),
            'HTML.SafeObject' => true,
            'Output.FlashCompat' => true,
            'HTML.SafeIframe' => true,
            'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
        ]) ?>
    </div>
</div>


<div class="box">
    <div class="box-header with-border">SEO</div>
    <div class="box-body">
        <?= DetailView::widget([
            'model' => $product,
            'attributes' => [
                [
                    'attribute' => 'meta_title',
                    'value' => $product->meta_title,
                ],
                [
                    'attribute' => 'meta_description',
                    'value' => $product->meta_description,
                ],
                [
                    'attribute' => 'meta_keywords',
                    'value' => $product->meta_keywords,
                ],
            ],
        ]) ?>
    </div>
</div>


<div class="box" id="photos">
    <div class="box-header with-border">Photos</div>
    <div class="box-body">

        <div class="row">
            <?php foreach ($product->photos as $photo): ?>
                <div class="col-md-2 col-xs-3" style="text-align: center">
                    <div class="btn-group">
                        <?= Html::a('<span class="glyphicon glyphicon-arrow-left"></span>', ['move-photo-up', 'productId' => $product->id, 'photoId' => $photo->id], [
                            'class' => 'btn btn-default',
                            'data-method' => 'post',
                        ]); ?>



                        <?= Html::a('<span class = "glyphicon glyphicon-heart" ></span>', ['make-main-photo', 'productId' => $product->id, 'photoId' => $photo->id], ['class' => 'btn btn-default', 'data-method' => 'post', 'data-confirm' => 'Make main photo?']); ?>



                        <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete-photo', 'productId' => $product->id, 'photoId' => $photo->id], [
                            'class' => 'btn btn-default',
                            'data-method' => 'post',
                            'data-confirm' => 'Remove photo?',
                        ]); ?>
                        <?= Html::a('<span class="glyphicon glyphicon-arrow-right"></span>', ['move-photo-down', 'productId' => $product->id, 'photoId' => $photo->id], [
                            'class' => 'btn btn-default',
                            'data-method' => 'post',
                        ]); ?>
                    </div>
                    <div>
                        <?= Html::a(
                            Html::img($photo->getAdminThumbPhotoFileUrl($product->id, $photo->id)), $photo->getAdminCatalogOriginPhotoFileUrl($product->id, $photo->id), ['class' => 'thumbnail', 'target' => '_blank']

                        ) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>

        <?= $form->field($photosForm, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

        <div class="form-group">
            <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>


    </div>
</div>

</div>

