<?php

use yii\db\Migration;

/**
 * Handles the creation of table `statistic`.
 */
class m180130_112608_create_statistic_table extends Migration
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

        $this->createTable('statistic', [
            'id' => $this->primaryKey(),
            'shortlink_id'=>$this->integer()->notNull(),
            'country'=>$this->string(40),
            'useragent'=>$this->string(),
            'ip'=>$this->string(39)
        ], $tableOptions);

        $this->createIndex('idx-statistic-shortlink_id', 'statistic', 'shortlink_id');
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('statistic');
    }
}
