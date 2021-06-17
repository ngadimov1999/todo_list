<?php

namespace app\services;

use app\models\db\Comment;
use Yii;
use yii\db\ActiveRecord;

/**
 * CommentService is the service for work with Comment ActiveRecord.
 */
class CommentService {
    /**
     * Create and save comment to db.
     * @param int $task_id
     * @param $text
     * @throws \yii\base\InvalidConfigException
     */
    public function addComment(int $task_id, string $text)
    {
        $comment = new Comment();
        $comment->task_id = $task_id;
        $comment->author_id = Yii::$app->user->id;
        $comment->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');

        if (!isset($text)) {
            $comment->text = "";
        } else {
            $comment->text = $text;
        }

        $comment->save();
    }

    /**
     * Find and return comment by id from db.
     *
     * @param $id Integer
     *
     * @return Comment|ActiveRecord
     */
    public function findById(int $id) : Comment
    {
        return Comment::find()
            ->where(['id' => $id])
            ->one();
    }

    /**
     * Find and return comment by task id from db.
     *
     * @param $id Integer
     *
     * @return array|ActiveRecord[]
     */
    public function findByTaskId(int $id) : array
    {
        return Comment::find()
            ->where(['task_id' => $id])
            ->all();
    }
}
