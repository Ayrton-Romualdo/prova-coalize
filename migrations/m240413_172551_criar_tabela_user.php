<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m240413_172551_criar_tabela_user
 */
class m240413_172551_criar_tabela_user extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
   
}
