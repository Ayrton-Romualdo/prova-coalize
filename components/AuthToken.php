<?php

namespace app\components;

use app\models\User;
use Yii;
use yii\base\Component;

class AuthToken extends Component
{
    public function authenticate()
    {
        // Verificar se o cabeçalho "Authorization" está presente na solicitação
        $authorizationHeader = Yii::$app->request->headers->get('Authorization');


        if ($authorizationHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authorizationHeader, $matches)) {

            $token = $matches[1]; // Extrair o token do cabeçalho
            $user = User::find()->where(['accessToken' => $token])->one();

            if ($user !== null) {
                // Usuário encontrado, permitir o acesso à API
                return $user;
            }
        }

        // Token inválido ou ausente, retornar null
        return null;
    }

    public function revoke()
    {
        $user = $this->authenticate();

        if($user){
            $user->accessToken = null;
            $user->save();
            // Usuário encontrado, permitir o acesso à API
            return $user;
        }
        
        return null;
    }
}

