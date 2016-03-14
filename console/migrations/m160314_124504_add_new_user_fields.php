<?php

use yii\db\Migration;

class m160314_124504_add_new_user_fields extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'access_token', 'VARCHAR(255) AFTER auth_key');
        $this->addColumn('user', 'created_by', 'INT(11)');
        $this->addColumn('user', 'updated_by', 'INT(11)');
    }

    public function down()
    {
        $this->dropColumn('user', 'access_token');
        $this->dropColumn('user', 'created_by');
        $this->dropColumn('user', 'updated_by');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
