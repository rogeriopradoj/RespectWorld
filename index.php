<?php
require 'vendor/autoload.php';

use Respect\Rest\Router;

$r3 = new Router;

$r3->get('/', function() {
    return 'Hello World';
});

$r3->get('/hello', function() {
    return 'Hello from Path';
});

$r3->get('/users/*', function($screenName) {
    echo "User {$screenName}";
});

$r3->get('/users/*/lists/*', function($user, $list) {
    return "List {$list} from user {$user}.";
});

$r3->get('/posts/*/*/*', function($year,$month=null,$day=null) {
    //list posts, month and day are optional
});