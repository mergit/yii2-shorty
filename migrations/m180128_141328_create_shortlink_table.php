<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shortlink`.
 */
class m180128_141328_create_shortlink_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('shortlink', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'available_at' => $this->dateTime(),
            'custom_url' => $this->string(5)->unique(),
            'url' => $this->string(1000)->notNull()
        ], $tableOptions);

        $this->createIndex('idx-shortlink-url', 'shortlink', 'url');
        $this->createIndex('idx-shortlink-custom_url', 'shortlink', 'custom_url');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('shortlink');
    }
}
