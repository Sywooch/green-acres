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

        <?= FeaturedProductsWidget::widget([
            'limit' => 16,
        ]) ?>


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
    navText: [\'<i class="fa fa-chevron-left fa-1x"></i>\', \'<i class="fa fa-chevron-right fa-1x"></i>\'],
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
    navText: [\'<i class="fa fa-chevron-left fa-1x"></i>\', \'<i class="fa fa-chevron-right fa-1x"></i>\'],
    dots: true
});') ?>

<?php $this->endContent() ?>