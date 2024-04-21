<?php

use yii\db\Migration;
use Faker\Factory as Faker;


/**
 * Class m240421_002143_produto_seed
 */
class m240421_002143_produto_seed extends Migration
{
 /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Faker::create();

        // Insere 100 produtos falsos
        for ($i = 0; $i < 100; $i++) {
            $clienteId = $faker->numberBetween(1, 100); // Supondo que existam 100 clientes na tabela cliente

            $this->insert('produto', [
                'nome' => $faker->word,
                'preco' => $faker->randomFloat(2, 10, 1000), // Gera um preço aleatório entre 10 e 1000 com 2 casas decimais
                'cliente_id' => $clienteId,
                'foto' => $faker->imageUrl(),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove os dados inseridos caso a semente precise ser revertida
        $this->truncateTable('produto');
    }
}
