<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 **/
class OrderProducts extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'public.order_products';
    }

    public function rules(): array
    {
        return [
            [['order_id', 'product_id'], 'required'],
            [['order_id', 'product_id'], 'integer'],
        ];
    }
}
