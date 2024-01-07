<?php

require_once "src/models/TaskModel.php";
require "src/views/CreateTask.php";

class TaskController {
    protected TaskModel $model;

    function __construct($model) {
        $this->model = $model;
    }

    public function create($data) {
        $this->model->create($data);
        return header('Location: /');
    }

    public function create_form() {
        return create_task_view($this->model);
    }

    public function update_is_completed($id, $value) {
        $this->model->update($id, ['is_completed' => $value]);
        return header('Location: /');
    }

    public function delete($id) {
        $this->model->delete($id);
        return header('Location: /');
    }
}