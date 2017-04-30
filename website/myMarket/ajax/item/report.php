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
        $abuseId = isset($_POST['abuseId']) ? $_POST['abuseId'] : 0;

        $itemId = helper::clearInt($itemId);
        $abuseId = helper::clearInt($abuseId);

        $result = array("error" => true,
                        "error_code" => ERROR_UNKNOWN);

        $report = new report($dbo);
        $report->setRequestFrom(auth::getCurrentUserId());

        $result = $report->item($itemId, $abuseId);

        echo json_encode($result);
        exit;
    }
