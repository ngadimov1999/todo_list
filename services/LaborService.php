<?php

namespace app\services;

use app\models\db\Comment;
use app\models\db\Labor;
use Yii;
use yii\db\ActiveRecord;

/**
 * LaborService is the service for work with Labor ActiveRecord.
 */
class LaborService {
    /**
     * Create and save labor to db.
     * @param int $task_id
     * @param string $time
     * @param string $comment
     * @throws \yii\base\InvalidConfigException
     */
    public function addLabor(int $task_id, string $time, string $comment)
    {
        $labor = new Labor();
        $labor->task_id = $task_id;
        $labor->author_id = Yii::$app->user->id;
        $labor->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');

        if (!isset($comment)) {
            $labor->comment = "";
        } else {
            $labor->comment = $comment;
        }

        if (!isset($time)) {
            $labor->time = "";
        } else {
            $labor->time = $time;
        }

        $labor->save();
    }

    /**
     * Find and return labor by id from db.
     *
     * @param $id Integer
     *
     * @return Labor|ActiveRecord
     */
    public function findById(int $id) : Labor
    {
        return Labor::find()
            ->where(['id' => $id])
            ->one();
    }

    /**
     * Find and return labor by task id from db.
     *
     * @param $id Integer
     *
     * @return array|ActiveRecord[]
     */
    public function findByTaskId(int $id) : array
    {
        return Labor::find()
            ->where(['task_id' => $id])
            ->all();
    }
}
