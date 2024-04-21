<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property string $cep
 * @property string $logradouro
 * @property string $numero
 * @property string $cidade
 * @property string $estado
 * @property string|null $complemento
 * @property string|null $foto
 * @property string|null $sexo
 *
 * @property Produto[] $produtos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cpf', 'cep', 'logradouro', 'numero', 'cidade', 'estado'], 'required'],
            [['sexo'], 'string', 'max' => 1],
            [['nome', 'logradouro', 'numero', 'cidade', 'complemento', 'foto'], 'string', 'max' => 255],
            [['cpf'], 'string', 'max' => 14],
            [['cep'], 'string', 'max' => 8],
            [['estado'], 'string', 'max' => 2],
            [['cpf'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'cep' => 'Cep',
            'logradouro' => 'Logradouro',
            'numero' => 'Numero',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'complemento' => 'Complemento',
            'foto' => 'Foto',
            'sexo' => 'Sexo',
        ];
    }

    /**
     * Gets query for [[Produtos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['cliente_id' => 'id']);
    }
}
