<?php

require("./class/CoopType.php");
 
require './vendor/autoload.php';
$app = new \Slim\Slim();

//get all users
$app->get('/CoopTypes', function () {
   
    $db = new CoopType();
    $result = $db->getAllType();
    $out = "{\"error\": false,\"message\" : \"get all act type\", \"type\" : [";
    for ($i = 0; $i < $result->num_rows; $i++) {
        if ($i != 0) $out .= ",";
        $out .= json_encode(mysqli_fetch_object($result));
    }
    $out .= "]}";
    echo $out;
});

//get users by fb_id
$app->get('/CoopTypes/:co_type_id', function ($co_type_id) {
    
    $db = new CoopType();
    $result = $db->getTypeByID($co_type_id);
    $out = "{\"error\": false,\"message\" : \"get users by fb_id\", \"users\" : [";
    for ($i = 0; $i < $result->num_rows; $i++) {
        if ($i != 0) $out .= ",";
        $out .= json_encode(mysqli_fetch_object($result));
    }
    $out .= "]}";
    echo $out;
});

//login and regist
$app->post('/users', function() use ($app) {
    
    $id = $app->request->post('fb_id');

    $db = new user();
    $result = $db->registUser($id);

    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed login\"}";
    }
});

//update coins
$app->post('/users/:fb_id/coins' , function($fb_id) use ($app) {
    $coins = $app->request->post('coins');

    $db = new user();
    $result = $db->updateCoins($fb_id,$coins);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update coins\"}";
    }
});

//update level
$app->post('/users/:fb_id/levels' , function($fb_id) use ($app) {
    $levels = $app->request->post('levels');

    $db = new user();
    $result = $db->updateLevels($fb_id,$levels);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update levels\"}";
    }
});

//update EXP
$app->post('/users/:fb_id/exp' , function($fb_id) use ($app) {
    $exp = $app->request->post('exp');

    $db = new user();
    $result = $db->updateExp($fb_id,$exp);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update EXP\"}";
    }
});

//update single high scores
$app->post('/users/:fb_id/highscores' , function($fb_id) use ($app) {
    $scores = $app->request->post('scores');

    $db = new user();
    $result = $db->updateSingleHighScores($fb_id,$scores);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update scores\"}";
    }
});


//update ranks
$app->post('/users/:fb_id/ranks' , function($fb_id) use ($app) {
    $ranks = $app->request->post('ranks');

    $db = new user();
    $result = $db->updateRanks($fb_id,$ranks);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update scores\"}";
    }
});

//update famous points
$app->post('/users/:fb_id/famous_points' , function($fb_id) use ($app) {
    $famous_points = $app->request->post('famous_points');

    $db = new user();
    $result = $db->updateFamousPoints($fb_id,$famous_points);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update famous points\"}";
    }
});

//update status
$app->post('/users/:fb_id/status' , function($fb_id) use ($app) {
    $status = $app->request->post('status');

    $db = new user();
    $result = $db->updateStatus($fb_id,$status);
    if ($result != NULL) {
        echo $result;
    } else {
        echo "{\"error\" : true,\"message\" : \"failed update status\"}";
    }
});

$app->run();
 
?>