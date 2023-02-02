<?php

use app\models\User;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/** @var ActiveDataProvider $dataProvider */
/** @var User $user */

$columns = [
    'id',
    'email',
    'username',
    'password',
    'first_name',
    'last_name',
    [
        'attribute' => 'role',
        'value' => static function (User $model) {
            return User::ROLE_NAMES[$model->role];
        },
    ],
    [
        'attribute' => 'status',
        'value' => static function (User $model) {
            return User::STATUS_NAMES[$model->role];
        },
    ],
    [
        'format' => 'date',
        'attribute' => 'created_at',
    ],
];

if ($user->isAdmin()) {
    $columns[] = [
        'template' => '{update} {delete}',
        'class' => 'yii\grid\ActionColumn',
    ];
}

?>

<h1>Users</h1>

<?= GridView::widget([
     'dataProvider' => $dataProvider,
     'columns' => $columns,
]); ?>
