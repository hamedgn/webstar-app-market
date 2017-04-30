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

    if (!$auth->authorize(auth::getCurrentUserId(), auth::getAccessToken())) {

        header('Location: /');
    }

    if (!empty($_POST)) {

        $itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;

        $itemId = helper::clearInt($itemId);

        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $item = new items($dbo);
        $item->setRequestFrom(auth::getCurrentUserId());

        $itemInfo = $item->info($itemId);

        if ($itemInfo['error'] === true || $itemInfo['fromUserId'] != auth::getCurrentUserId()) {

            echo json_encode($result);
            exit;

        } else {

            $result = $item->remove($itemId);
        }

        echo json_encode($result);
        exit;
    }
