<?php

function db_connect($dsn, $user, $password, $options) {
    $db = new PDO($dsn, $user, $password, $options);
    return $db;
}