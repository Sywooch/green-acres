<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cabinet-index">
    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
           'username',
           'email',
            'phone',
            [
                'attribute' => 'status',
                'value' => \shop\helpers\UserHelper::statusLabel($model->status),
                'format' => 'raw',
            ],

            [
            'attribute' => 'created_at',
            'format' => 'datetime',


        ],

            [
            'attribute' => 'updated_at',
            'format' => 'datetime',
            ],

        ]


    ]) ?>

    <p>
        <?= Html::a('Edit Profile', ['cabinet/profile/edit'], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
