<?php
session_start();
require '../vendor/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;

$fb = new Facebook\Facebook([
    'app_id' => '777870112346493',
    'app_secret' => '99dadd4173e11d814a7f024d38dfc1ca',
    'default_graph_version' => 'v2.4',
]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/fb_callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';