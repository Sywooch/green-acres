<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 05.04.18
 * Time: 18:23
 */

/* @var $this \yii\web\View */
/* @var $content string */
use frontend\widgets\shop\CategoriesWidget;

?>

<?php  $this->beginContent('@frontend/views/layouts/main.php')?>

<div class="row">

    <aside id="column-left" class="col-sm-3 hidden-xs">



        <?= CategoriesWidget::widget([

            'active' => isset($this->params['active_category']) ?$this->params['active_category'] : null
        ]) ?>

    </aside>

    <div id="content" class="col-sm-9">
        <?= $content ?>
    </div>

</div>




<?php $this->endContent() ?>
