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

    $page_id = "main";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("my.css", "admin.css");
    $page_title = "عمومی";

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
                            <div class="col s2">
                                <h4>آمارها</h4>
                            </div>
                        </div>

				<div class="col s12">
					<table class="striped responsive-table">
							<tbody>
                                <tr>
                                    <th class="text-left">آیتم</th>
                                    <th>تعداد</th>
                                </tr>
                                <tr>
                                    <td>اکانت ها</td>
                                    <td><?php echo $stats->getAccountsTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td>اکانت های فعال</td>
                                    <td><?php echo $stats->getAccountsCount(ACCOUNT_STATE_ENABLED); ?></td>
                                </tr>
                                <tr>
                                    <td>اکانت های مسدود شده</td>
                                    <td><?php echo $stats->getAccountsCount(ACCOUNT_STATE_BLOCKED); ?></td>
                                </tr>
                                <tr>
                                    <td>کل نظرات</td>
                                    <td><?php echo $stats->getCommentsTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td>نظرات فعلی ( حذف نشده ها )</td>
                                    <td><?php echo $stats->getCommentsCount(); ?></td>
                                </tr>
                                <tr>
                                    <td>کل دسته بندی ها</td>
                                    <td><?php echo $stats->getCategoriesTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td>دسته بندی های فعلی ( حذف نشده ها )</td>
                                    <td><?php echo $stats->getCategoriesCount(); ?></td>
                                </tr>
                                <tr>
                                    <td>کل محصولات</td>
                                    <td><?php echo $stats->getItemsTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td>محصولات فعلی ( حذف نشده ها )</td>
                                    <td><?php echo $stats->getItemsCount(); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">کل چت ها</td>
                                    <td><?php echo $stats->getChatsTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">چت های فعلی ( حذف نشده ها )</td>
                                    <td><?php echo $stats->getChatsCount(); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">کل پیام ها</td>
                                    <td><?php echo $stats->getMessagesTotal(); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">پیام های فعلی ( حذف نشده ها )</td>
                                    <td><?php echo $stats->getMessagesCount(); ?></td>
                                </tr>
                            </tbody>
                        </table>
				</div>

				<div class="row">
					<div class="col s12">
						<h4>کاربرانی که به تازگی ثبت نام کرده اند</h4>
					</div>
				</div>

				<div class="col s12">

                    <?php

                        $result = $stats->getAccounts(0);

                        $inbox_loaded = count($result['users']);

                        if ($inbox_loaded != 0) {

                        ?>

						<table class="bordered data-tables responsive-table">
							<tbody>
                                <tr>
                                    <th>آی دی</th>
                                    <th>وضعیت اکانت</th>
                                    <th>نام کاربری</th>
                                    <th>نام کامل</th>
                                    <th>فیسبوک</th>
                                    <th>ایمیل</th>
                                    <th>تاریخ ثبت نام</th>
                                    <th>آی پی</th>
                                    <th>عملیات</th>
                                </tr>

                            <?php

                            foreach ($result['users'] as $key => $value) {

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
            <td><?php echo $user['id']; ?></td>
            <td><?php if ($user['state'] == 0) {echo "فعال";} else {echo "مسدود";} ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['fullname']; ?></td>
            <td><?php if (strlen($user['fb_id']) == 0) {echo "به فیسبوک متصل نشده است";} else {echo "<a target=\"_blank\" href=\"https://www.facebook.com/app_scoped_user_id/{$user['fb_id']}\">لینک اکانت فیسبوک</a>";} ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $user['regtime']); ?></td>
            <td><?php if (!APP_DEMO) {echo $user['ip_addr'];} else {echo "در حالت آزمایشی فعال نیست";} ?></td>
            <td><a href="/admin/profile.php/?id=<?php echo $user['id']; ?>">رفتن به اکانت</a></td>
        </tr>

        <?php
    }