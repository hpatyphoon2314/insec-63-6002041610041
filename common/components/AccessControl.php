<?php
namespace common\components;

use Yii;
use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;
use common\components\AccessControl;

class AccessControl extends ActionFilter {

    public $params = [];
    public $denyCallback;
    private $separator = '-';

    private function getItemName($component) {
        return strtr($component->getUniqueId(), '/', $this->separator);
    }

    public function beforeAction($action) {
        $user = Yii::$app->getUser();
        $controller = $action->controller;
        $permission= $controller->id;
        $permission.='-';
        $permission.=$controller->action->id;
            if(Yii::$app->user->can($permission)) {
               // echo 'con be access'.$permission;
               return true;
            } else {
               // echo 'do not access' .$permission;
                throw new ForbiddenHttpException('Contact Administrator'); 
            }
        
    }

}