<?php
require 'vendor/autoload.php';

include 'vendor/notorm/notorm/NotORM.php';
$dsn = 'sqlite:' . realpath('./data/db.sqlite');
$db = new NotORM(new PDO($dsn));

use Respect\Rest\Router;
$r3 = new Router;

$r3->get('/', function() {
    echo '<h1>Hello Respect World</h1>';
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

$r3->get('/books', function() use ($db) {
    $books = array();
    foreach ($db->books() as $book) {
        $books[] = array(
            'id' => $book['id'],
            'title' => $book['title'],
            'author' => $book['author'],
            'summary' => $book['summary'],
        );
    }
    return $books;
})->accept(
    array(
        'application/json' => 'json_encode',
    )
);

$r3->get('/book/*', function($id) use ($db) {
    $book = $db->books()->where('id', $id);
    if ($data = $book->fetch()) {
        return array(
            'id' => $data['id'],
            'title' => $data['title'],
            'author' => $data['author'],
            'summary' => $data['summary'],
        );
    } else {
        return array(
            'status' => false,
            'message' => sprintf(
                'Book ID %s does not exist',
                $id
            ),
        );
    }
})->accept(
    array(
        'application/json' => 'json_encode',
    )
);