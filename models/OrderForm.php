<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Exception;

class OrderForm extends Model
{
    public string $username = '';
    public string $userPhone = '';
    public ?string $comment = '';
    public array $products = [];
    public int $orderId;

    public function rules()
    {
        return [
            [['username', 'userPhone', 'products'], 'required'],
            ['products', 'each', 'rule' => ['integer', 'skipOnEmpty' => false]],
            [['comment', 'userPhone', 'comment'], 'default', 'value' => ''],
        ];
    }

    public function save(): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $this->saveOrder();
            $this->saveOrderProducts();
        } catch(\Throwable $e) {
            $transaction->rollBack();
            throw new Exception('Something went wrong during order save');
        }

        $transaction->commit();

        return true;
    }

    private function saveOrder()
    {
        $order = new Order();
        $order->username = $this->username;
        $order->userPhone = $this->userPhone;
        $order->comment = $this->comment;
        $order->save();

        $this->orderId = $order->id;
    }

    private function saveOrderProducts()
    {
        foreach ($this->products as $productId) {
            $orderProduct = new OrderProducts();
            $orderProduct->order_id = $this->orderId;
            $orderProduct->product_id = $productId;
            $orderProduct->save();
        }
    }
}
