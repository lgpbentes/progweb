<?php
namespace frontend\models;

use common\models\Curso;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $id_curso;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required', 'message'=>'Este campo é obrigatório'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nome de usuário já está sendo utilizado'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required', 'message'=> 'Insira um endereço de email válido'],
            ['email', 'email', 'message'=>'Email inválido'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este endereço de email já está sendo usado'],

            ['password', 'required', 'message'=>"Este campo é obrigatório"],
            ['password', 'string', 'min' => 6],

            ['id_curso', 'integer'],
            ['id_curso', 'required', 'message'=> 'Este campo é obrigatório'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->id_curso = $this->id_curso;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
