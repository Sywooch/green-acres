<?php

/* @var $this \yii\web\View */
/* @var $content string */


use frontend\widgets\shop\FeaturedProductsWidget;

\frontend\assets\OwlCarouselAsset::register($this);

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="row">
    <div id="content" class="col-sm-12">
        <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
            <div class="item">
              <img src="<?= Yii::getAlias('@web/image/banners/green_acres_1.jpg') ?>"
                            alt="Montale Deep Rose & Roses Elixir" class="img-responsive"/>
            </div>
            <div class="item">
                <img src="<?= Yii::getAlias('@web/image/banners/green_acres_2.jpg') ?>"
                     alt="Montale Roses Musk" class="img-responsive"/>
            </div>

            <div class="item">
                <img src="<?= Yii::getAlias('@web/image/banners/green_acres_4.jpeg') ?>"
                     alt="Montale Roses Elixir" class="img-responsive"/>
            </div>


            <div class="item">
                <img src="<?= Yii::getAlias('@web/image/banners/green_acres_3.jpeg') ?>"
                     alt="Montale Roses Elixir" class="img-responsive"/>
            </div>


        </div>
        <h3>Featured</h3>

        <?= FeaturedProductsWidget::widget([
            'limit' => 16,
        ]) ?>

<!--        <h3>Last Posts</h3>-->

<!--        --><?//= LastPostsWidget::widget([
//            'limit' => 4,
//        ]) ?>

        <div id="carousel0" class="owl-carousel">
            <div class="item text-center">
                <img src="<?= Yii::getAlias('@web/image/manufacturer/nfl-130x100.png') ?>" alt="NFL"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?= Yii::getAlias('@web/image/manufacturer/redbull-130x100.png') ?>"
                     alt="RedBull" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/sony-130x100.png') ?>" alt="Sony"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/cocacola-130x100.png') ?>"
                     alt="Coca Cola" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/burgerking-130x100.png') ?>"
                     alt="Burger King" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/canon-130x100.png') ?>" alt="Canon"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/harley-130x100.png') ?>"
                     alt="Harley Davidson" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/dell-130x100.png') ?>" alt="Dell"
                     class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/disney-130x100.png') ?>"
                     alt="Disney" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/starbucks-130x100.png') ?>"
                     alt="Starbucks" class="img-responsive"/>
            </div>
            <div class="item text-center">
                <img src="<?=Yii::getAlias('@web/image/manufacturer/nintendo-130x100.png') ?>"
                     alt="Nintendo" class="img-responsive"/>
            </div>
        </div>
        <?= $content ?>
    </div>
</div>

<?php $this->registerJs('
$(\'#slideshow0\').owlCarousel({
    items: 1,
    autoWidth:true,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->registerJs('
$(\'#carousel0\').owlCarousel({
    items: 6,
    loop: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav: true,
    navText: [\'<i class="fa fa-chevron-left fa-5x"></i>\', \'<i class="fa fa-chevron-right fa-5x"></i>\'],
    dots: true
});') ?>

<?php $this->endContent() ?>