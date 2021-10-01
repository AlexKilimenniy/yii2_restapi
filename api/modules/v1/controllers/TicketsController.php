<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\Tickets;
use Yii;
use yii\rest\ActiveController;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;
use yii\helpers\Url;

class TicketsController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Tickets';


    protected function verbs(): array
    {
        return [
            'index' => ['GET', 'HEAD'],
            'view' => ['GET', 'HEAD'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['update']);
        return $actions;
    }

    public function actionCreate()
    {
        $model = new Tickets();
        $post_data = Yii::$app->request->post();

        if (!empty($post_data)) {
            $model->title = $post_data['title'] ?? null;
            $model->description = $post_data['description'] ?? null;

            $uploads = UploadedFile::getInstancesByName("image");
            if ($uploads) {
                $model->image = $model->uploadImage($uploads[0]);
            }
        }

        if ($model->validate() && $model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }

    public function actionUpdate($id)
    {
        $model = Tickets::findOne($id);

        $post_data = Yii::$app->request->post();

        if (!empty($post_data)) {
            $model->title = $post_data['title'] ?? $model->title;
            $model->description = $post_data['description'] ?? $model->description;

            $uploads = UploadedFile::getInstance($model, "image");
            if ($uploads) {
                $model->image = $model->uploadImage($uploads[0]);
            }
        }

        if ($model->validate() && $model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(200);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }
}