<?php

use app\models\OrderForm;
use app\models\Product;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\web\View;

/** @var View $this */
/** @var OrderForm $model */
/** @var Product[] $products */

$this->title = 'Order';
$this->params['breadcrumbs'][] = $this->title;

$productsArray = [];

/* @var $product Product */
foreach ($products as $product) {
    $productsArray[$product->id] = $product->name . ' ' . $product->price . ' ' . Product::PRODUCT_CURRENCY_DEFAULT;
}

?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Please fill out the following fields to make an order:</p>

<?php $form = ActiveForm::begin([
        'id' => 'order-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]);
?>

<?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'userPhone')->textInput() ?>

<?= $form->field($model, 'comment')->textarea() ?>

<?= $form->field($model, 'products')->checkboxList($productsArray) ?>

<div class="form-group mt-3">
    <?= Html::submitButton('Order', ['class' => 'btn btn-primary', 'name' => 'order-button']) ?>
</div>

<?php ActiveForm::end(); ?>
