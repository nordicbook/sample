<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
* @property int $id
* @property string $name
* @property int $price
**/
class Product extends ActiveRecord
{
    const PRODUCT_CURRENCY_DEFAULT = 'rub.';
    public static function tableName(): string
    {
        return 'public.products';
    }

    public function rules(): array
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'integer'],
            [['name'], 'string'],
        ];
    }
}
