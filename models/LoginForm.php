<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $login;
    // public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // login and password are both required
            [['login', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            // if (!$user || !$user->validatePassword($this->password)) {
            //     $this->addError($attribute, 'Incorrect login or password.');
            // }

            if (!$user || !Yii::$app->getSecurity()->validatePassword($this->password, $user->password)) {
                $this->addError($attribute, 'Incorrect login or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided login and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            // Obtém o usuário
            $user = $this->getUser();
            // Realiza o login do usuário
            if (Yii::$app->user->login($user)) {
                // Gera o token
                $token = Yii::$app->security->generateRandomString();
                // Salva o token no banco de dados ou em outro local apropriado
                $user->accessToken = $token;
                $user->save(false); // Salva sem validação
                // Retorna true para indicar que o usuário está logado com sucesso
                return $token;
            }
        }
        // Retorna false se o login falhar
        return false;
    }


    public function loginToken($token)
    {
        return Yii::$app->user->loginByAccessToken($token);
    }



    /**
     * Finds user by [[login]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByLogin($this->login);
        }

        return $this->_user;
    }

}
