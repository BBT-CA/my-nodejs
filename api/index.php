<?php
/**
 * Created by PhpStorm.
 * User: jun
 * Date: 10/09/15
 * Time: 10:42 PM
 */

require '../vendor/autoload.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/feed', 'getFeeds');


$app->run();

function getFeeds() {
    $sql = "select * FROM clients ORDER BY name";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $wines = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"user": ' . json_encode($wines) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


$app->run();

function getConnection() {
    $dbhost="127.0.0.1";
    $dbuser="root";
    $dbpass="letmintat7h6";
    $dbname="facebook";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}

function fbLogin() {
    $fb = new Facebook\Facebook([
        'app_id' => '891873217566556',
        'app_secret' => '08f6ae455049a42ee0b31952cb813368',
        'default_graph_version' => 'v2.4',
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email']; // Optional permissions
    $loginUrl = $helper->getLoginUrl('https://localhost/fb-callback.php', $permissions);

    echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
}
?>
