<?php

use app\models\Order;
use app\models\Product;
use yii\grid\GridView;

/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<h1>Orders</h1>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'username',
        'userPhone',
        'comment',
        [
            'attribute' => 'status',
            'value' => static function (Order $model) {
                return Order::STATUS_NAMES[$model->status];
            },
        ],
        [
            'format' => 'html',
            'attribute' => 'products',
            'value' => static function (Order $model) {
                $productString = '';

                /** @var Product $product */
                foreach ($model->products as $product) {
                    $productString .= "<div>{$product->name} {$product->price} " . Product::PRODUCT_CURRENCY_DEFAULT . "</div>";
                }

                return $productString;
            },
        ],
        [
            'format' => 'date',
            'attribute' => 'created_at',

        ],
        [
            'template' => '{update} {delete}',
            'class' => 'yii\grid\ActionColumn'
        ],
    ],
]); ?>
