<?php

namespace app\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Cliente;
use yii\data\Pagination;
use app\components\AuthToken;

class ClienteController extends ActiveController
{
    public $modelClass = 'app\models\Cliente';

    /**
     * {@inheritdoc}
     */
    protected function verbs()
    {
        return [
            'create' => ['POST'], // Mapeia a ação "create" para o verbo POST
            'index' => ['GET'],    // Mapeia a ação "index" para o verbo GET
        ];
    }
    
    public function actions()
    {
        $actions = parent::actions();
        // Desativa as ações padrão geradas pelo ActiveController
        unset($actions['index'], $actions['create']);
        return $actions;
    }


    public function actionCreate()
    {
        $request = \Yii::$app->request;
        $auth = Yii::createObject(AuthToken::class);
        
        if ($user = $auth->authenticate()) {
            // Carregar os dados do cliente enviados pela API
            $model = new Cliente();
            $model->load(Yii::$app->request->getBodyParams(), '');
    
            // Tentar salvar o novo cliente no banco de dados
            if ($model->save()) {
                // Se o cliente for salvo com sucesso, retornar os dados do cliente
                Yii::$app->response->statusCode = 201; // Código de status 201 Created
                return $model;
            } else {
                // Se houver erros de validação, retornar os erros
                Yii::$app->response->statusCode = 400; // Código de status 400 Bad Request
                return $model->getErrors();
            }

        } else {
            // Token inválido ou ausente, retornar erro 401 Unauthorized
            Yii::$app->response->statusCode = 401;
            return ['error' => 'Unauthorized'];
        }
    }

    /**
     * Lista todos os clientes.
     * @return array Uma lista de todos os clientes.
     */
    public function actionIndex()
    {

        $request = \Yii::$app->request;

        $auth = Yii::createObject(AuthToken::class);
        
        if ($user = $auth->authenticate()) {
            // Obtém o número da página da consulta, padrão é 1 se não estiver presente
            $page = $request->get('page', 1);
            $pageSize = $request->get('page_size', 20);

            $query = Cliente::find();

            $count = $query->count();

            $pagination = new Pagination(['totalCount' => $count]);

            $pagination->setPage($page - 1); 
            $pagination->setPageSize($pageSize);

            // limit the query using the pagination and retrieve the articles
            $clientes = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();

            return $clientes;
        } else {
            // Token inválido ou ausente, retornar erro 401 Unauthorized
            Yii::$app->response->statusCode = 401;
            return ['error' => 'Unauthorized'];
        }
        
    }
}
