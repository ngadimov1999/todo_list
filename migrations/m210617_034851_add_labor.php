<?php

use yii\db\Migration;

/**
 * Class m210617_034851_add_labor
 */
class m210617_034851_add_labor extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%labor}}', [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'time' => $this->string(150)->notNull(),
            'comment' => $this->string(150)->notNull(),
            'create_date'=> $this->dateTime(),
        ]);

        $this->createIndex(
            'idx-labor-author_id',
            'labor',
            'author_id'
        );

        $this->createIndex(
            'idx-labor-task_id',
            'labor',
            'task_id'
        );

        $this->addForeignKey(
            'fk-labor-author_id',
            'labor',
            'author_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-labor-task_id',
            'labor',
            'task_id',
            'task',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-labor-author_id',
            'labor'
        );

        $this->dropIndex(
            'idx-labor-author_id',
            'labor'
        );

        $this->dropForeignKey(
            'fk-labor-task_id',
            'labor'
        );

        $this->dropIndex(
            'idx-labor-task_id',
            'labor'
        );

        $this->dropTable('{{%labor}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210617_034851_add_labor cannot be reverted.\n";

        return false;
    }
    */
}
