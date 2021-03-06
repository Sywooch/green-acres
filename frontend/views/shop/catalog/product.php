<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 06.04.18
 * Time: 11:41
 */

/* @var $this yii\web\View */

/* @var $product shop\entities\shop\product\Product */

/* @var $cartForm shop\forms\shop\AddToCartForm */

/* @var $reviewForm shop\forms\shop\ReviewForm */

use frontend\assets\MagnificPopupAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use shop\helpers\PriceHelper;
use yii\bootstrap\ActiveForm;

$this->title = $product->name;

$this->registerMetaTag(['name' => 'description', 'content' => $product->meta_description]);

$this->registerMetaTag(['name' => 'keywords', 'content' => $product->meta_keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => ['index']];

foreach ($product->category->parents as $parent) {

    if (!$parent->isRoot()) {

        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }

}
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => ['category', 'id' => $product->category->id]];

$this->params['breadcrumbs'][] = $product->name;

$this->params['active_category'] = $product->category;

MagnificPopupAsset::register($this);


?>

<div class="row" xmlns:fb="http://www.w3.org/1999/xhtml">

    <div class="col-sm-8">

        <ul class="thumbnails">

            <?php foreach ($product->photos as $i => $photo) : ?>

                <?php if ($i == 0): ?>

                    <li>
                        <a class="thumbnail"
                           href="<?= $photo->getCatalogOriginPhotoFileUrl($product->id, $photo->id) ?>">

                            <img src="<?= $photo->getCatalogProductMainPhotoFileUrl($product->id, $photo->id) ?>"

                                 alt="<?= Html::encode($product->name); ?>"
                            />
                        </a>

                    </li>


                <?php else: ?>

                    <li class="image-additional">

                        <a class="thumbnail"
                           href="<?= $photo->getCatalogOriginPhotoFileUrl($product->id, $photo->id) ?>">

                            <img src="<?= $photo->getCatalogProductAdditionalPhotoFileUrl($product->id, $photo->id) ?>"

                                 alt="<?= Html::encode($product->name); ?>"
                            />

                        </a>

                    </li>


                <?php endif; ?>
            <? endforeach; ?>
        </ul>
<hr/>

        <div class="tab-content">
            <div class="tab-pane active" id="tab-description"><p>

                    <?= Yii::$app->formatter->asHtml($product->description, [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?>


            </div>

<!--            <div class="tab-pane" id="tab-specification">-->
<!--                <table class="table table-bordered">-->
<!--                    <tbody>-->
<!---->
<!---->
<!--                    --><?php //foreach ($product->values as $value): ?>
<!--                        --><?php //if (!empty($value->value)): ?>
<!--                            <tr>-->
<!--                                <th>--><?//= Html::encode($value->characteristic->name) ?><!--</th>-->
<!--                                <td>--><?//= Html::encode($value->value) ?><!--</td>-->
<!--                            </tr>-->
<!--                        --><?php //endif; ?>
<!--                    --><?php //endforeach; ?>
<!---->
<!---->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->


            <div class="tab-pane" id="tab-review">
                <div id="review"></div>
                <h2>Write a review</h2>

                <?php if (Yii::$app->user->isGuest): ?>

                    <div class="panel-panel-info">
                        <div class="panel-body">
                            Please <?= Html::a('Log In', ['/auth/auth/login']) ?> for writing a review.
                        </div>
                    </div>

                <?php else: ?>

                    <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>

                    <?= $form->field($reviewForm, 'vote')->dropDownList($reviewForm->votesList(), ['prompt' => '--- Select ---']) ?>
                    <?= $form->field($reviewForm, 'text')->textarea(['rows' => 5]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                    </div>

                    <?php ActiveForm::end() ?>

                <?php endif; ?>

            </div>


        </div>
    </div>

    <div class="col-sm-4">

        <p class="btn-group">

            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Добавить в избранное"
                    href="#" data-method="post"><i
                        class="fa fa-heart"></i></button>



            <button type="button" data-toggle="tooltip" class="btn btn-default" title="Добавить в сравнение"
                    href="<?= Url::to(['/shop/compare/add', 'id' => $product->id]) ?>" data-method="post"
            ><i class="fas fa-info-circle"></i></button>


        </p>

        <h1 class="_top"><?= Html::encode($product->name) ?></h1>

        <ul class="list-unstyled">

            <li>
                Производитель семян:<a href="<?= Html::encode(Url::to(['brand', 'id' => $product->brand->id])) ?>">

                    <?= Html::encode($product->brand->name) ?>
                </a>

            </li>

            <li>
                Тэги:
                <?php foreach ($product->tags as $tag): ?>

                    <a href="<?= Html::encode(Url::to(['tag', 'id' => $tag->id])) ?>">

                        <?= Html::encode($tag->name) ?>
                    </a>

                <?php endforeach; ?>
            </li>

            <li>Код продукта: <?= Html::encode($product->code) ?></li>
        </ul>
        <hr>
        <ul class="list-unstyled">
            <li>
                <h2><?= PriceHelper::format($product->price_new) ?>
                </h2>

            </li>
        </ul>


        <ul class="list-unstyled">
            <li>


                <p><?= Yii::$app->formatter->asHtml($product->description, [
                        'Attr.AllowedRel' => array('nofollow'),
                        'HTML.SafeObject' => true,
                        'Output.FlashCompat' => true,
                        'HTML.SafeIframe' => true,
                        'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    ]) ?></p>

            </li>
        </ul>


        <div id="product">

            <?php if ($product->isAvailable()): ?>

                <hr>

                <?php $form = ActiveForm::begin([
                'action' => ['/shop/cart/add-product', 'id' => $product->id],
            ]) ?>


                <?= $form->field($cartForm, 'quantity')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Добавить в корзину', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>

                <?php ActiveForm::end() ?>

            <?php else: ?>

                <div class="alert alert-danger">
                    The product is not available for purchasing right now.<br/>Add it to your wishlist.
                </div>

            <?php endif; ?>

        </div>



    </div>


</div>


<?php $js = <<<EOD
$('.thumbnails').magnificPopup({
    type: 'image',
    delegate: 'a',
    gallery: {
        enabled:true
    }
});
EOD;
$this->registerJs($js); ?>
