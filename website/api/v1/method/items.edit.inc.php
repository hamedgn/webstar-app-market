<?php

/*!
 * ifsoft.co.uk engine v1.0
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * qascript@ifsoft.co.uk
 *
 * Copyright 2012-2016 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
 */

include_once($_SERVER['DOCUMENT_ROOT']."/core/init.inc.php");
include_once($_SERVER['DOCUMENT_ROOT']."/config/api.inc.php");

if (!empty($_POST)) {

    $clientId = isset($_POST['clientId']) ? $_POST['clientId'] : 0;

    $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;

    $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : 0;
    $accessToken = isset($_POST['accessToken']) ? $_POST['accessToken'] : '';

    $categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : 0;
    $price = isset($_POST['price']) ? $_POST['price'] : 0;
    $allowComments = isset($_POST['allowComments']) ? $_POST['allowComments'] : 0;

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : '';

    $postArea = isset($_POST['postArea']) ? $_POST['postArea'] : '';
    $postCountry = isset($_POST['postCountry']) ? $_POST['postCountry'] : '';
    $postCity = isset($_POST['postCity']) ? $_POST['postCity'] : '';
    $postLat = isset($_POST['postLat']) ? $_POST['postLat'] : '0.000000';
    $postLng = isset($_POST['postLng']) ? $_POST['postLng'] : '0.000000';

    $clientId = helper::clearInt($clientId);
    $accountId = helper::clearInt($accountId);

    $itemId = helper::clearInt($itemId);

    $categoryId = helper::clearInt($categoryId);
    $price = helper::clearInt($price);
    $allowComments = helper::clearInt($allowComments);

    $title = helper::clearText($title);
    $title = helper::escapeText($title);

    $description = helper::clearText($description);

    $description = preg_replace( "/[\r\n]+/", "<br>", $description); //replace all new lines to one new line
    $description  = preg_replace('/\s+/', ' ', $description);        //replace all white spaces to one space

    $description = helper::escapeText($description);

    $imgUrl = helper::clearText($imgUrl);
    $imgUrl = helper::escapeText($imgUrl);

    $postArea = helper::clearText($postArea);
    $postArea = helper::escapeText($postArea);

    $postCountry = helper::clearText($postCountry);
    $postCountry = helper::escapeText($postCountry);

    $postCity = helper::clearText($postCity);
    $postCity = helper::escapeText($postCity);

    $postLat = helper::clearText($postLat);
    $postLat = helper::escapeText($postLat);

    $postLng = helper::clearText($postLng);
    $postLng = helper::escapeText($postLng);

    $result = array("error" => true,
                    "error_code" => ERROR_UNKNOWN);

    $auth = new auth($dbo);

    if (!$auth->authorize($accountId, $accessToken)) {

        api::printError(ERROR_ACCESS_TOKEN, "Error authorization.");
    }

    $item = new items($dbo);
    $item->setRequestFrom($accountId);

    $itemInfo = $item->info($itemId);

    if ($itemInfo['error'] === true) {

        return $result;
    }

    if ($itemInfo['fromUserId'] != $accountId) {

        return $result;
    }

    $result = $item->edit($itemId, $categoryId, $title, $imgUrl, $description, $allowComments, $price);

    echo json_encode($result);
    exit;
}
