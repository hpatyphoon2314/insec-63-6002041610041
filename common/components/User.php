<?php
namespace common\components;

class User extends \yii\web\User 
{

    public $identityClass = '\common\models\User';

    public function checkAccess($operation, $params = [], $allowCaching = true) {  
        // Always return true when SuperAdmin user
        if (\Yii:: $app->user->id == 1 
        && \Yii::$app->uer->status == 10)
        {

            return true;
        }
        return parent::can($operation, $params, $allowCaching);  
    }
}
//echo 'test';
//exit;
//return false;