<?php

use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Описание задачи "' . $task->title . '"';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <a href="/task/update-task/<?=$task->id?>"><button type="button" class="btn btn-primary">Обновить задачу</button></a>
</div>
<p>Задача: <?=Html::encode($task->title)?></p>
<p>Тип задачи: <?=Html::encode($type->name)?></p>
<p>Описание: <?=Html::encode($task->description)?></p>
<p>Автор: <?=Html::encode($author->login)?></p>
<p>Исполнитель: <?=Html::encode($executor->login)?></p>
<p>Статус: <?=Html::encode($status->name)?></p>
<p>Дата создания: <?=Html::encode($task->create_date)?></p>
<p>Класс: <?=Html::encode($serviceClass->name)?></p>

    <textarea id="comment" type="text" placeholder="Comment"></textarea>
    <script>
        function add_comment() {
            var id = <?=$task->id?>;
            var text = document.getElementById("comment").value;
            window.location.replace("/task/add-comment/" + id + "/" + text);
        }
    </script>
    <button class="btn btn-primary" onclick="add_comment()">Добавить комментарий</button>
    </br>

    <textarea id="labor_time" type="text" placeholder="Time"></textarea>
    <textarea id="labor" type="text" placeholder="Comment"></textarea>
    <script>
        function add_labor() {
            var id = <?=$task->id?>;
            var text = document.getElementById("labor").value;
            var time = document.getElementById("labor_time").value;
            window.location.replace("/task/add-labor/" + id + "/" + time +"/" + text);
        }
    </script>
    <button class="btn btn-primary" onclick="add_labor()">Добавить трудозатраты</button>
    </br>
<div>
    <a href="/task/delete-task/<?=$task->id?>"><button type="button" class="btn btn-primary">Удалить задачу</button></a>
</div>
<p style="font-weight: 700">Комментарии к задаче</p>
<?php foreach ($comments as $comment) { ?>
    <div class="flex-container">
        <p><?=$users[Yii::$app->formatter->asInteger($comment->author_id) - 1]->login?></p>
        <p><?=$comment->text?></p>
        <p><?=$comment->create_date?></p>
    </div>
<?php } ?>
<p style="font-weight: 700">Трудозатраты</p>
<?php foreach ($labors as $labor) { ?>
    <div class="flex-container">
        <p><?=$users[Yii::$app->formatter->asInteger($labor->author_id) - 1]->login?></p>
        <p><?=$labor->time?></p>
        <p><?=$labor->comment?></p>
        <p><?=$labor->create_date?></p>
    </div>
<?php } ?>
