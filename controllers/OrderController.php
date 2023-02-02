<?php

namespace app\controllers;

use app\models\Order;
use app\models\OrderForm;
use app\models\Product;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['actions' => ['index'], 'allow' => true, 'roles' => ['?']],
                    ['actions' => ['list', 'update', 'delete'], 'allow' => true, 'roles' => ['@']],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $form = new OrderForm();

        if (Yii::$app->request->post()) {
            try {
                if ($form->load($this->request->post()) || $form->validate()) {
                    $form->save();
                    Yii::$app->session->setFlash('info', 'Order Saved');
                }
            } catch (Throwable $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong');
            }
        }

        return $this->render('form', [
            'model' => $form,
            'products' => Product::find()->all(),
        ]);
    }

    public function actionList()
    {
        $dataProvider = new ActiveDataProvider(['query' => Order::find()]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $order = Order::find()->where(['id' => $id])->one();

        if (Yii::$app->request->post()) {
            try {
                $order->status = $this->request->post('status');
                if ($order->validate()) {
                    $order->save();
                }

                $this->redirect('/order/list');
            } catch (Throwable $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong');
            }
        }

        return $this->render('update', [
            'order' => $order,
        ]);
    }

    public function actionDelete(int $id)
    {
        $order = Order::find()->where(['id' => $id])->one();
        if (!$order->delete()) {
            Yii::$app->session->setFlash('error', 'Something went wrong');
        }

        $this->redirect('/order/list');
    }
}
