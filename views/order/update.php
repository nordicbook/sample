<?php

use app\models\Order;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var Order $order  */
?>

<h1>Order update</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($order, 'username')->textInput(['disabled' => true]) ?>

<?= $form->field($order, 'userPhone')->textInput(['disabled' => true]) ?>

<?= $form->field($order, 'comment')->textInput(['disabled' => true]) ?>

<?= Html::label('Status') ?>
<?= Html::dropDownList(
    'status',
    $order->status,
    Order::STATUS_NAMES,
    ['class' => 'form-control', 'prompt' => '',]
) ?>

<div class="form-group mt-3">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
