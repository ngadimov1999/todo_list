<?php

namespace app\services;

use app\models\db\Task;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * TaskService is the service for work with Task ActiveRecord.
 */
class TaskService
{
    /**
     * Create and save task to db.
     *
     * @param $type Integer
     * @param $title String
     * @param $description String
     * @param $status Integer
     * @param $executor Integer
     * @param $service_class Integer
     * @throws \yii\base\InvalidConfigException
     */
    public function addTask(
        int $type,
        string $title,
        string $description,
        int $status,
        int $executor,
        int $service_class
    )
    {
        $task = new Task();
        $task->type = $type;
        $task->title = $title;
        $task->status = $status;
        $task->author_id = Yii::$app->user->id;
        $task->executor_id = $executor;
        $task->create_date = Yii::$app->formatter->asDateTime('now', 'yyyy-MM-dd H:i:s');
        $task->service_class = $service_class;

        if (!isset($description)) {
            $task->description = "";
        } else {
            $task->description = $description;
        }

        $task->save();
    }

    /**
     * Update and save task to db.
     *
     * @param $id Integer
     * @param $type Integer
     * @param $title String
     * @param $description String
     * @param $status Integer
     * @param $executor Integer
     * @param $service_class Integer
     */
    public function updateTask(
        int $id,
        int $type,
        string $title,
        string $description,
        int $status,
        int $executor,
        int $service_class
    )
    {
        $task = $this->findById($id);
        $task->type = $type;
        $task->title = $title;
        $task->status = $status;
        $task->executor_id = $executor;
        $task->service_class = $service_class;

        if (!isset($description)) {
            $task->description = "";
        } else {
            $task->description = $description;
        }

        $task->save();
    }

    /**
     *
     * Delete task from db.
     *
     * @param $id Integer
     */
    public function deleteTask(int $id)
    {
        $task = $this->findById($id);
        if (isset($task)) {
            $deleted = $task->delete();
            if (!$deleted) {
                throw new \Exception("Task doesn't delete");
            }
        }
    }

    /**
     * Find and return task by id from db.
     *
     * @param $id Integer
     *
     * @return Task|ActiveRecord
     */
    public function findById(int $id): Task
    {
        return Task::find()
            ->where(['id' => $id])
            ->one();
    }

    /**
     * Find and return tasks by id from db.
     *
     * @param $title String
     *
     * @return array|ActiveRecord[]
     */
    public function findByTitle(string $title): array
    {
        return Task::find()
            ->andWhere(['like', 'title', $title])
            ->all();
    }
}
