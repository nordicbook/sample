<?php

namespace app\controllers;

use app\models\User;
use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    ['actions' => ['list', 'update', 'delete'], 'allow' => true,'roles' => ['@']],
                ],
            ],
        ];
    }

    public function actionList()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $dataProvider = new ActiveDataProvider(['query' => User::find()]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $webUser = User::find()
            ->where(['id' => Yii::$app->user->id])
            ->one();

        if (!$webUser->isAdmin()) {
            $this->redirect('/users/list');
        }

        $updateUser = User::find()
            ->where(['id' => $id])
            ->one();

        if (Yii::$app->request->post()) {
            try {
                if ($updateUser->load($this->request->post()) && $updateUser->validate()) {
                    $updateUser->save();
                }

                $this->redirect('/users/list');
            } catch (Throwable $e) {
                Yii::$app->session->setFlash('error', 'Something went wrong');
            }
        }

        return $this->render('update', ['user' => $updateUser]);
    }
}
