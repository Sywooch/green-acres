<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Shop\CartWidget;
use common\widgets\Alert;
use shop\forms\shop\search\SearchForm;

AppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="<?= Html::encode(Url::canonical()) ?>" rel="canonical"/>
    <link href="<?= Yii::getAlias('@web/image/catalog/cart.png') ?>" rel="icon"/>

    <?php $this->head() ?>
</head>
<body class="common-home">
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="top">
        <div class="container">
            <div class="pull-left">
                <p class="top-lead">Семена с доставкой</p>
                <!--                <form action="/index.php?route=common/currency/currency" method="post"-->
                <!--                      enctype="multipart/form-data" id="form-currency">-->
                <!--                    <div class="btn-group">-->
                <!--                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">-->
                <!--                            <strong>$</strong>-->
                <!--                            <span class="hidden-xs hidden-sm hidden-md">Currency</span> <i class="fa fa-caret-down"></i>-->
                <!--                        </button>-->
                <!--                        <ul class="dropdown-menu">-->
                <!--                            <li>-->
                <!--                                <button class="currency-select btn btn-link btn-block" type="button" name="EUR">€ Euro-->
                <!--                                </button>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <button class="currency-select btn btn-link btn-block" type="button" name="GBP">£ Pound-->
                <!--                                    Sterling-->
                <!--                                </button>-->
                <!--                            </li>-->
                <!--                            <li>-->
                <!--                                <button class="currency-select btn btn-link btn-block" type="button" name="USD">$ US-->
                <!--                                    Dollar-->
                <!--                                </button>-->
                <!--                            </li>-->
                <!--                        </ul>-->
                <!--                    </div>-->
                <!--                    <input type="hidden" name="code" value=""/>-->
                <!--                    <input type="hidden" name="redirect" value="/index.php?route=common/home"/>-->
                <!--                </form>-->
            </div>
            <div id="top-links" class="nav pull-right">
                <ul class="list-inline">
                    <li><a href="/index.php?route=information/contact"><i class="fa fa-phone"></i></a>
                        <span class="hidden-xs hidden-sm hidden-md">123456789</span></li>
                    <li class="dropdown"><a href="/index.php?route=account/account" title="My Account"
                                            class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
                            <span
                                    class="hidden-xs hidden-sm hidden-md"><?=Yii::t('app', 'My Account')?></span> <span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php if (Yii::$app->user->isGuest): ?>
                                <li><a href="<?= Html::encode(Url::to(['/auth/auth/login'])) ?>">Вход</a></li>
                                <li><a href="<?= Html::encode(Url::to(['/auth/signup/request'])) ?>">Регистрация</a></li>
                            <?php else: ?>
                                <li><a href="<?= Html::encode(Url::to(['/cabinet/default/index'])) ?>">Личный кабинет</a></li>
                                <li><a href="<?= Html::encode(Url::to(['/auth/auth/logout'])) ?>" data-method="post">Выход</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li><a href="<?= Url::to(['/cabinet/wishlist/index']) ?>" id="wishlist-total"
                           title="Wish List"><i class="fa fa-heart"></i> <span class="hidden-xs hidden-sm hidden-md"><?=Yii::t('app', 'Wish List') ?></span></a>
                    </li>

                    <li><a href="<?= Url::to(['/shop/cart/index']) ?>" title="Shopping Cart"><i
                                    class="fa fa-shopping-cart"></i> <span class="hidden-xs hidden-sm hidden-md"><?= Yii::t('app', 'Shopping Cart') ?></span></a>
                    </li>
                    <li><a href="<?= Url::to(['/shop/compare/index']) ?>" title="Compare products"><i
                                    class="fa fa-exchange"></i> <span class="hidden-xs hidden-sm hidden-md"><?=Yii::t('app', 'Compare products') ?></span></a>
                    </li>



                    <li><a href="<?= Url::to(['/shop/checkout/index']) ?>" title="Checkout"><i
                                    class="fa fa-share"></i> <span class="hidden-xs hidden-sm hidden-md"><?=Yii::t('app', 'Checkout') ?></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div id="logo">
                        <a href="<?= Url::home() ?>"><img src="<?= Yii::getAlias('@web/image/Logo.png') ?>" title="Your Store" alt="Your Store" class="img-responsive"/></a>
                    </div>
                </div>
                <div class="col-sm-5">
                    <?= Html::beginForm(['/shop/catalog/search'], 'get') ?>
                    <div id="search" class="input-group">
                        <input type="text" name="text" value="" placeholder="Поиск" class="form-control input-lg"/>
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default btn-lg"><i class="fa fa-search"></i></button>
                    </span>
                    </div>
                    <?= Html::endForm() ?>
                </div>
                <div class="col-sm-3">
                    <!--                    --><? //= CartWidget::widget() ?>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <?php

        NavBar::begin([
            'options' => [
                'screenReaderToggleText' => 'Menu',
                'id' => 'menu',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav'],
            'items' => [
                ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
                ['label' => Yii::t('app', 'Catalog'), 'url' => ['/shop/catalog/index']],
                ['label' => Yii::t('app', 'Blog'), 'url' => ['/blog/post/index']],
                ['label' => Yii::t('app', 'Contact'), 'url' => ['/contact/index']],
            ],
        ]);
        NavBar::end();
        ?>
    </div>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">

        <div class="row">
            <div class="col-sm-3">
                <h5>Information</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/information&amp;information_id=4">About
                            Us</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=6">Delivery
                            Information</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=3">Privacy
                            Policy</a></li>
                    <li><a href="/index.php?route=information/information&amp;information_id=5">Terms
                            &amp; Conditions</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Customer Service</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=information/contact">Contact Us</a></li>
                    <li><a href="/index.php?route=account/return/add">Returns</a></li>
                    <li><a href="/index.php?route=information/sitemap">Site Map</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Extras</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= Url::to(['/shop/catalog/brand']) ?>"">Brands</a></li>
                    <li><a href="/index.php?route=account/voucher">Gift Certificates</a></li>
                    <li><a href="/index.php?route=affiliate/account">Affiliates</a></li>
                    <li><a href="/index.php?route=product/special">Specials</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>My Account</h5>
                <ul class="list-unstyled">
                    <li><a href="/index.php?route=account/account">My Account</a></li>
                    <li><a href="/index.php?route=account/order">Order History</a></li>
                    <li><a href="/index.php?route=account/wishlist">Wish List</a></li>
                    <li><a href="/index.php?route=account/newsletter">Newsletter</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
