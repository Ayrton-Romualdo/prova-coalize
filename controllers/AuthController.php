<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;
use yii\web\Response;
use yii\web\MethodNotAllowedHttpException;
use app\components\AuthToken;

/**
 * Class AuthController
 * @package app\controllers
 *
 * @mixin \yii\rest\Controller
 */
class AuthController extends Controller
{

    // Desabilitar a verificação CSRF para todas as ações
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [];
    }

    public function beforeAction($action)
    {
        if (in_array($action->id, ['login', 'logout']) && !Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            throw new MethodNotAllowedHttpException('Method Not Allowed. This URL can only handle the following request methods: POST.');
        }

        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        $model = new LoginForm();

        // Configura o formato da resposta como JSON
        Yii::$app->response->format = Response::FORMAT_JSON;

        $dados = Yii::$app->request->post();


        $model->login = $dados['login'];
        $model->password = $dados['password'];

        $token = $model->login();
        if ($token !== false) {
            return [
                'token_type' => 'Bearer',
                'access_token' => $token
            ];
        } else {
            $errors = $model->getErrors();
            $errorMessages = [];
            foreach ($errors as $attribute => $error) {
                $errorMessages[] = implode(', ', $error);
            }
            return implode(', ', $errorMessages);
        }
    }

    public function actionLogout()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = \Yii::$app->request;
        $auth = Yii::createObject(AuthToken::class);
        if ($user = $auth->revoke()) {
            return [
                'success' => true,
                'message' => 'Token revogado'
            ];
        } else {
            // Token inválido ou ausente, retornar erro 401 Unauthorized
            Yii::$app->response->statusCode = 401;
            return ['error' => 'Unauthorized'];
        }
    }

}
