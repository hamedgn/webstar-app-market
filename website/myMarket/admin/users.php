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

    $page_id = "users";

    $error = false;
    $error_message = '';
    $query = '';
    $result = array();
    $result['users'] = array();

    $stats = new stats($dbo);
    $settings = new settings($dbo);
    $admin = new admin($dbo);

    if (isset($_GET['query'])) {

        $query = isset($_GET['query']) ? $_GET['query'] : '';

        $query = helper::clearText($query);
        $query = helper::escapeText($query);

        if (strlen($query) > 2) {

            $result = $stats->searchAccounts(0, $query);
        }
    }

    helper::newAuthenticityToken();

    $css_files = array("my.css", "admin.css");
    $page_title = "کاربران";

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
                            <div class="col s6">
                                <h4>جست و جو</h4>
                            </div>
                        </div>

                        <form method="get" action="/admin/users.php">

                            <div class="row">
                                <div class="input-field col s7">
                                    <input type="text" class="validate" id="query" name="query" value="<?php echo stripslashes($query); ?>">
                                    <label for="query">پیدا کردن کاربران بر اساس نام ، نام کامل یا ایمیل ، حداقل 3 کاراکتر</label>
                                </div>

                                <div class="input-field col s2">
                                    <button type="submit" class="btn waves-effect waves-light teal btn-large" name=""><i class="material-icons">search</i></button>
                                </div>
                            </div>

                        </form>

				<div class="col s12">

                    <?php

                        if (count($result['users']) > 0) {

                        ?>

						<table class="bordered responsive-table">
							<tbody>
                                <tr>
                                    <th>آی دی</th>
                                    <th>وضعیت اکانت</th>
                                    <th>نام کاربری</th>
                                    <th>نام کامل</th>
                                    <th>آدرس فیسبوک</th>
                                    <th>ایمیل</th>
                                    <th>تاریخ ثبت نام</th>
                                    <th>آدرس آی پی</th>
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

                                if (strlen($query) < 3) {

                                    ?>

                                    <div class="row">
                                        <div class="col s12">
                                            <div class="card blue-grey darken-1">
                                                <div class="card-content white-text">
                                                    <span class="card-title">نام کاربری ، نام کامل یا ایمیل مورد نظر را در کادر جستجو وارد کنید</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php

                                } else {

                                    ?>

                                    <div class="row">
                                        <div class="col s12">
                                            <div class="card blue-grey darken-1">
                                                <div class="card-content white-text">
                                                    <span class="card-title">یافت شده ها : 0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
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
            <td><?php if ($user['state'] == 0) {echo "فعال";} else {echo "مسدود شده";} ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['fullname']; ?></td>
            <td><?php if (strlen($user['fb_id']) == 0) {echo "به فیسبوک وصل نشده است";} else {echo "<a target=\"_blank\" href=\"https://www.facebook.com/app_scoped_user_id/{$user['fb_id']}\">اکانت حساب فیسبوک</a>";} ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $user['regtime']); ?></td>
            <td><?php if (!APP_DEMO) {echo $user['ip_addr'];} else {echo "در نسخه آزمایشی غیر فعال است";} ?></td>
            <td><a href="/admin/profile.php/?id=<?php echo $user['id']; ?>">رفتن به اکانت</a></td>
        </tr>

        <?php
    }