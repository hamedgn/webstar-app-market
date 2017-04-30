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

    if (!admin::isSession()) {

        header("Location: /admin/login.php");
    }

    $stats = new stats($dbo);

    if (isset($_GET['act'])) {

        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            switch($act) {

                case "delete": {

                    $reports = new report($dbo);
                    $reports->removeAllProfilesReports();
                    unset($reports);

                    header("Location: /admin/profile_reports.php");
                    exit;

                    break;
                }

                default: {

                    header("Location: /admin/profile_reports.php");
                    exit;

                    break;
                }
            }
        }
    }

    $page_id = "reports";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("my.css", "admin.css");
    $page_title = "گزارش پروفایل های متخلف";

    include_once($_SERVER['DOCUMENT_ROOT']."/common/header.inc.php");

?>

<body>

    <?php

        include_once($_SERVER['DOCUMENT_ROOT']."/common/admin_panel_topbar.inc.php");
    ?>

<main class="content">
    <div class="row">
        <div class="col s12 m12 l12">

            <?php

                include_once($_SERVER['DOCUMENT_ROOT']."/common/admin_panel_banner.inc.php");
            ?>

            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">

                        <div class="row">
                            <div class="col s12">
                                <h4>پروفایل های گزارش شده ( آخرین گزارشات )</h4>
                            </div>
                        </div>

                        <div class="col s12">

                            <?php

                                $reports = new report($dbo);

                                $result = $reports->getProfilesReports(50);

                                $inbox_loaded = count($result['items']);

                                if ($inbox_loaded != 0) {

                                ?>

                                <div class="row">
                                    <div class="col s12">
                                        <a href="/admin/profile_reports.php/?act=delete&access_token=<?php echo admin::getAccessToken(); ?>">
                                            <button class="btn waves-effect waves-light teal">حذف تمام گزارشات<i class="material-icons right">حذف</i></button>
                                        </a>
                                    </div>
                                </div>

                                <table class="bordered data-tables responsive-table">
                                    <tbody>
                                        <tr>
                                            <th class="text-left">آی دی</th>
                                            <th>از اکانت</th>
                                            <th>برای اکانت</th>
                                            <th>دلیل گزارش</th>
                                            <th>تاریخ گزارش</th>
                                        </tr>

                                    <?php

                                    foreach ($result['items'] as $key => $value) {

                                        draw($value);
                                    }

                                    ?>

                                    </tbody>
                                </table>

                                <?php

                                    } else {

                                        ?>

                                        <div class="row">
                                            <div class="col s12">
                                                <div class="card blue-grey darken-1">
                                                    <div class="card-content white-text">
                                                        <span class="card-title">موردی یافت نشد</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                    ?>
                        </div>

			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>
</main>

        <?php

            include_once($_SERVER['DOCUMENT_ROOT']."/common/admin_panel_footer.inc.php");
        ?>

        <script type="text/javascript">


        </script>

</body>
</html>

<?php

    function draw($user)
    {
        ?>

        <tr>
            <td class="text-left"><?php echo $user['id']; ?></td>
            <td><?php if ($user['abuseFromUserId'] == 0) {echo "-";} else {echo "<a href=\"/admin/profile.php/?id={$user['abuseFromUserId']}\">آی دی پروفایل گزارش دهنده ({$user['abuseFromUserId']})</a>";} ?></td>
            <td><?php echo "<a href=\"/admin/profile.php/?id={$user['abuseToUserId']}\">آی دی پروفایل متخلف ({$user['abuseToUserId']})</a>"; ?></td>
            <td>
                <?php

                    switch ($user['abuseId']) {

                        case 0: {

                            echo "اسپم است";

                            break;
                        }

                        case 1: {

                            echo "سخنان نفرت انگیز";

                            break;
                        }

                        case 2: {

                            echo "غیر اخلاقی";

                            break;
                        }

                        default: {

                            echo "پروفایل تقلبی";

                            break;
                        }
                    }
                ?>
            </td>
            <td><?php echo $user['date']; ?></td>
        </tr>

        <?php
    }