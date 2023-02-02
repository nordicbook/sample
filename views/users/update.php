<?php

use app\models\User;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var User $user  */
?>

<h1>User update</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($user, 'username')->textInput() ?>

<?= $form->field($user, 'password')->textInput() ?>

<?= $form->field($user, 'email')->textInput() ?>

<?= $form->field($user, 'first_name')->textInput() ?>

<?= $form->field($user, 'last_name')->textInput() ?>

<?= Html::label('Status') ?>
<?= Html::dropDownList(
    'User[status]',
    $user->status,
    User::STATUS_NAMES,
    ['class' => 'form-control', 'prompt' => '',]
) ?>

<?= Html::label('Role') ?>
<?= Html::dropDownList(
    'User[role]',
    $user->role,
    User::ROLE_NAMES,
    ['class' => 'form-control', 'prompt' => '',]
) ?>

<div class="form-group mt-3">
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
</div>

<?php ActiveForm::end(); ?>
