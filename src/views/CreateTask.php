<?php
function create_task_view($task_model) {
?>
<html>
    <head></head>
    <body>
        <h1>Tasks</h1>
        <section>
            <h2>Create a task</h2>
            <form action="/tasks" method="post">
                <p>
                    <label for="title">Title: </label>
                    <input id="title" name="title" type="text">
                </p>
                <p>
                    <label for="description">Description: </label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </p>
                <p>
                    <label for="due_date">Due date: </label>
                    <input type="date" name="due_date" id="due_date">
                </p>
                <button type="submit">Create</button>
            </form>
        </section>
        <section>
            <h2>Listing tasks</h2>
            <ul>
                <?php foreach($task_model->list() as $task): ?>
                <li style="color: <?php if($task['is_completed']): ?>green<?php else: ?>inherit<?php endif; ?>">
                    <h3><?= $task['title'] ?></h3>
                    <p><?= $task['description'] ?></p>
                    <p>
                        <small>
                            <?php if($task['due_date']): ?>
                            <span>Due date: <?= $task['due_date'] ?></span>
                            <?php endif; ?>
                            <span>Created at: <?= $task['created_at'] ?></span>
                        </small>
                    </p>
                    <form action="/tasks/is_completed" method="post">
                        <input type="hidden" name="is_completed" value="<?php if($task['is_completed']): ?>false<?php else: ?>true<?php endif; ?>">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button type="submit"><?php if($task['is_completed']): ?>Re-open<?php else: ?>Finish<?php endif; ?></button>
                    </form>
                    <form action="/tasks/delete" method="post">
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </body>
</html>
<?php } ?>