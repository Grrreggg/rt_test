<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Status;

class StatusController extends Controller
{
    public function actionIndex()
    {
        $query = Status::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $statuses = $query->orderBy('id')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'statuses' => $statuses,
            'pagination' => $pagination,
        ]);
    }

    public function actionAdd()
    {
        $msg = '';

        $s_name = Yii::$app->request->getQueryParam('s_name');
        $c_name = Yii::$app->request->getQueryParam('c_name');
        $c_id = Yii::$app->request->getQueryParam('c_id');
        $a_type = Yii::$app->request->getQueryParam('a_type');
        $direction = Yii::$app->request->getQueryParam('direction');
        $activation = Yii::$app->request->getQueryParam('activation');
        $c_state = Yii::$app->request->getQueryParam('c_state');
        $control = Yii::$app->request->getQueryParam('control');

        if (!$c_id){
            $msg = 'No c_id found';

        }else{
            $status = Status::find() -> where(['c_id' => $c_id]) -> one();

            if ($status){
                $msg = 'Alreay exists';
                
            }else{
                $status = new Status();

                $status->s_name     = ($s_name) ? $s_name : '';
                $status->c_name     = ($c_name) ? $c_name : '';
                $status->c_id       = $c_id;
                $status->a_type     = ($a_type) ? $a_type : '';
                $status->direction  = ($direction) ? $direction : '';
                $status->activation = ($activation) ? $activation : '';
                $status->c_state    = ($c_state) ? $c_state : '';
                $status->control    = ($control) ? $control : '';

                if ($status->save()){
                    $msg = 'New status with c_id=' . $c_id . ' added';
                }else{
                    $msg = 'DB error';
                }
            }
        }

        return $this->render('add', [
            'msg' => $msg
        ]);
    }
}