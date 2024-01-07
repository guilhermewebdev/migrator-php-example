<?php
require_once "controllers/TaskController.php";
require_once "lib/db.php";

$db = db_connect(
    'mysql:host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_NAME'],
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],
    array(),
);

$task_model = new TaskModel($db);
$tasks = new TaskController($task_model);

$routes = [
    "/" => [
        'GET' => function() use ($tasks) {
            $tasks->create_form();
        },
    ],
    "/tasks" => [
        'POST' => function() use ($tasks) {
            $tasks->create($_POST);
        },
    ],
    "/tasks/is_completed" => [
        'POST' => function() use ($tasks) {
            $tasks->update_is_completed($_POST['id'], $_POST['is_completed'] == "true");
        }
    ],
    "/tasks/delete" => [
        'POST' => function() use ($tasks) {
            $tasks->delete($_POST['id']);
        }
    ]
];
$route = $routes[$_SERVER['SCRIPT_NAME']] or $routes["/"];
$caller = $route[$_SERVER['REQUEST_METHOD']] or $routes["/"]['GET'];
$caller();