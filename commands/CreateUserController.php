<?php

namespace app\commands;

use yii\console\Controller;
use app\models\User;
use Yii;

class CreateUserController extends Controller
{
    public function actionUser($login, $senha, $nome)
    {
        $user = new User();
        $user->login = $login;
        $user->password = Yii::$app->security->generatePasswordHash($senha);
        $user->username = $nome;
        
        if ($user->save()) {
            echo "Usuário criado com sucesso.\n";
        } else {
            echo "Erro ao criar usuário: " . json_encode($user->errors) . "\n";
        }
    }
}
