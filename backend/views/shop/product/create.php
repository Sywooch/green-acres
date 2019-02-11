<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 20.03.18
 * Time: 22:36
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model shop\forms\manage\shop\product\ProductCreateForm */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'brandId')->dropDownList($model->brandsList(), ['prompt' => '']) ?>
                </div>


                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <?= $form->field($model, 'description')->widget(\mihaildev\ckeditor\CKEditor::class) ?>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">Warehouse</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">Price</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model->price, 'new')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model->price, 'old')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">Рекомендованные и популярные товары</div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'recommended')->checkbox() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'popular')->checkbox() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Categories</div>
                <div class="box-body">
                    <?= $form->field($model->categories, 'main_category')->dropDownList($model->categories->categoriesList(), ['prompt' => '']) ?>
                    <?= $form->field($model->categories, 'additional_categories')->checkboxList($model->categories->categoriesList()) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">Тэги</div>
                <div class="box-body">
                    <?= $form->field($model->tags, 'existing')->checkboxList($model->tags->tagsList()) ?>
                    <?= $form->field($model->tags, 'textNew')->textInput() ?>
                </div>
            </div>
        </div>
    </div>

<div>


</div>
    <div class="box box-default">
        <div class="box-header with-border">Photos</div>
        <div class="box-body">
            <?= $form->field($model->photos, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        </div>
    </div>


    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model, 'meta_title')->textInput() ?>
            <?= $form->field($model, 'meta_description')->textarea(['rows' => 2]) ?>
            <?= $form->field($model, 'meta_keywords')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
