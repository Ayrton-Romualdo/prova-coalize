<?php

use yii\db\Migration;

/**
 * Class m240421_000014_criar_tabela_cliente
 */
class m240421_000014_criar_tabela_cliente extends Migration
{
    public function safeUp()
    {
        $this->createTable('cliente', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'cpf' => $this->string(14)->notNull()->unique(), 
            'cep' => $this->string(8)->notNull(),
            'logradouro' => $this->string()->notNull(),
            'numero' => $this->string()->notNull(),
            'cidade' => $this->string()->notNull(),
            'estado' => $this->string(2)->notNull(),
            'complemento' => $this->string(),
            'foto' => $this->string(),
            'sexo' => "ENUM('M', 'F', 'O')", // Definindo a coluna sexo como ENUM, // Supondo que o sexo seja 'M' (masculino), 'F' (feminino) ou 'O' (outro)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cliente');
    }
}
