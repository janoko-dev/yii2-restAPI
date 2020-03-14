<?php
namespace janokoDev\restAPI;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;

/**
 * Site controller
 */
class API extends Controller
{
    protected $data = null;
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->request->enableCsrfValidation = false;
        $this->data = Yii::$app->request->bodyParams;
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'denyCallback' => function($rule, $action) {
            //         throw new ForbiddenHttpException('Forbidden');
            //     },
            // ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                ],
            ]
        ];
    }
    protected function arrayGet($key, $arr, $default_val = null){
        if (array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $default_val;
    }
    protected function sendRespond($status, $message, $data = null){
        $resp = array(
            "status" => $status,
            "message" => $message,
        );
        if($data !== null){
            $resp["data"] = $data;
        }
        return (object) $resp;
    }
}
