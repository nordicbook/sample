<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * @property int $id
 * @property string $username
 * @property string $userPhone
 * @property int $status
 * @property string $comment
 * @property string $updated_at
 * @property string $created_at
 *
 * Relations
 * @property Product[] $products
 */
class Order extends ActiveRecord
{
    public const STATUS_ACCEPTED = 1;
    public const STATUS_DECLINED = 2;
    public const STATUS_DEFECTIVE = 3;

    public const STATUS_NAMES = [
        self::STATUS_ACCEPTED => 'accepted',
        self::STATUS_DECLINED => 'declined',
        self::STATUS_DEFECTIVE => 'defective',
    ];

    public static function tableName(): string
    {
        return 'public.orders';
    }

    public function rules(): array
    {
        return [
            [['username', 'userPhone'], 'required'],
            [['status'], 'integer'],
            [['username', 'userPhone', 'comment'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_ACCEPTED],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'username' => 'User name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'userPhone' => 'User phone',
            'comment' => 'Comment',
            'products' => 'Products',
        ];
    }

    public function getProducts(): Query
    {
        return $this->hasMany(Product::class, ['id' => 'product_id'])
                    ->viaTable('order_products', ['order_id' => 'id']);
    }
}
