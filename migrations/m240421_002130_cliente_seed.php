<?php

use yii\db\Migration;
use Faker\Factory as Faker;

/**
 * Class m240421_002130_cliente_seed
 */
class m240421_002130_cliente_seed extends Migration
{
    public function safeUp()
    {
        $faker = Faker::create();

        // Insere 100 clientes falsos
        for ($i = 0; $i < 100; $i++) {
            $this->insert('cliente', [
                'nome' => $faker->name,
                'cpf' => str_pad(rand(1, 99999999999), 11, '0', STR_PAD_LEFT),
                'cep' => str_pad(rand(1, 99999999), 8, '0', STR_PAD_LEFT),
                'logradouro' => $faker->streetName,
                'numero' => $faker->buildingNumber,
                'cidade' => $faker->city,
                'estado' => $faker->stateAbbr,
                'complemento' => $faker->secondaryAddress,
                'foto' => $faker->imageUrl(),
                'sexo' => $faker->randomElement(['M', 'F', 'O']),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Remove os dados inseridos caso a semente precise ser revertida
        $this->truncateTable('cliente');
    }
}
