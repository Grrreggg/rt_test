<?php

namespace app\models;

use yii\db\ActiveRecord;

class Status extends ActiveRecord
{
    public static function tableName()
      {
        return 'queue_statuses';
      }
}