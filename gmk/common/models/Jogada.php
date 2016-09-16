<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "jogada".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_partida
 * @property integer $linha
 * @property integer $coluna
 * @property string $data_hora
 *
 * @property User $idUser
 */
class Jogada extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jogada';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'linha', 'coluna'], 'required'],
            [['id', 'id_user', 'id_partida', 'linha', 'coluna'], 'integer'],
            [['data_hora'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_partida' => 'Id Partida',
            'linha' => 'Linha',
            'coluna' => 'Coluna',
            'data_hora' => 'Data Hora',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
