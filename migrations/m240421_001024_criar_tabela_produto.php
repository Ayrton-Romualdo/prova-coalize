<?php

use yii\db\Migration;

/**
 * Class m240421_001024_criar_tabela_produto
 */
class m240421_001024_criar_tabela_produto extends Migration
{
/**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('produto', [
            'id' => $this->primaryKey(),
            'nome' => $this->string()->notNull(),
            'preco' => $this->decimal(10, 2)->notNull(), // Supondo que o preço seja armazenado como um decimal com 10 dígitos no total e 2 dígitos após o ponto decimal
            'cliente_id' => $this->integer()->notNull(),
            'foto' => $this->string(),
        ]);

        // Adiciona uma chave estrangeira para garantir a integridade referencial com a tabela cliente
        $this->addForeignKey('fk-produto-cliente_id', 'produto', 'cliente_id', 'cliente', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove a chave estrangeira
        $this->dropForeignKey('fk-produto-cliente_id', 'produto');

        // Remove a tabela de produtos
        $this->dropTable('produto');
    }
}
