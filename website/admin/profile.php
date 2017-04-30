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

    $accountInfo = array();

    if (isset($_GET['id'])) {

        $accountId = isset($_GET['id']) ? $_GET['id'] : 0;
        $accessToken = isset($_GET['access_token']) ? $_GET['access_token'] : 0;
        $act = isset($_GET['act']) ? $_GET['act'] : '';

        $accountId = helper::clearInt($accountId);

        $account = new account($dbo, $accountId);
        $accountInfo = $account->get();

        $messages = new msg($dbo);
        $messages->setRequestFrom($accountId);

        if ($accessToken === admin::getAccessToken() && !APP_DEMO) {

            switch ($act) {

                case "disconnect": {

                    $account->setFacebookId('');

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "showAdmob": {

                    $account->setAdmob(1);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "hideAdmob": {

                    $account->setAdmob(0);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "close": {

                    $auth->removeAll($accountId);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "block": {

                    $account->setState(ACCOUNT_STATE_BLOCKED);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "unblock": {

                    $account->setState(ACCOUNT_STATE_ENABLED);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "delete-cover": {

                    $data = array("originCoverUrl" => '',
                                  "normalCoverUrl" => '');

                    $account->setCover($data);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                case "delete-photo": {

                    $data = array("originPhotoUrl" => '',
                                  "normalPhotoUrl" => '',
                                  "lowPhotoUrl" => '');

                    $account->setPhoto($data);

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    break;
                }

                default: {

                    if (!empty($_POST)) {

                        $authToken = isset($_POST['authenticity_token']) ? $_POST['authenticity_token'] : '';
                        $username = isset($_POST['username']) ? $_POST['username'] : '';
                        $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
                        $location = isset($_POST['location']) ? $_POST['location'] : '';
                        $balance = isset($_POST['balance']) ? $_POST['balance'] : 0;
                        $fb_page = isset($_POST['fb_page']) ? $_POST['fb_page'] : '';
                        $instagram_page = isset($_POST['instagram_page']) ? $_POST['instagram_page'] : '';
                        $email = isset($_POST['email']) ? $_POST['email'] : '';

                        $username = helper::clearText($username);
                        $username = helper::escapeText($username);

                        $fullname = helper::clearText($fullname);
                        $fullname = helper::escapeText($fullname);

                        $location = helper::clearText($location);
                        $location = helper::escapeText($location);

                        $balance = helper::clearInt($balance);

                        $fb_page = helper::clearText($fb_page);
                        $fb_page = helper::escapeText($fb_page);

                        $instagram_page = helper::clearText($instagram_page);
                        $instagram_page = helper::escapeText($instagram_page);

                        $email = helper::clearText($email);
                        $email = helper::escapeText($email);

                         if ($authToken === helper::getAuthenticityToken()) {

                            $account->setUsername($username);
                            $account->setFullname($fullname);
                            $account->setLocation($location);
                            $account->setBalance($balance);
                            $account->setFacebookPage($fb_page);
                            $account->setInstagramPage($instagram_page);
                            $account->setEmail($email);
                         }
                    }

                    header("Location: /admin/profile.php/?id=".$accountInfo['id']);
                    exit;
                }
            }
        }

    } else {

        header("Location: /admin/main.php");
    }

    if ($accountInfo['error'] === true) {

        header("Location: /admin/main.php");
    }

    $stats = new stats($dbo);

    $page_id = "account";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("my.css", "admin.css");
    $page_title = $accountInfo['username']." | اطلاعات اکانت";

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
                                <h4>اطلاعات اکانت</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <a href="/admin/personal_gcm.php/?id=<?php echo $accountInfo['id']; ?>">
							        <button class="btn waves-effect waves-light teal">ارسال نوتیفیکیشن برای این کاربر<i class="material-icons left">send</i></button>
						        </a>
                            </div>
                        </div>

                        <div class="col s12">
                            <table class="striped responsive-table">
                                    <tbody>
                                        <tr>
                                            <th class="text-left">آیتم</th>
                                            <th>مقادیر</th>
                                            <th>عملیات</th>
                                        </tr>
                                        <tr>
                                            <td class="text-left">نام کاربری :</td>
                                            <td><?php echo $accountInfo['username']; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">نام کامل :</td>
                                            <td><?php echo $accountInfo['fullname']; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">ایمیل :</td>
                                            <td><?php echo $accountInfo['email']; ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">حساب فیسبوک :</td>
                                            <td><?php if (strlen($accountInfo['fb_id']) == 0) {echo "Not connected to facebook.";} else {echo "<a target=\"_blank\" href=\"https://www.facebook.com/app_scoped_user_id/{$accountInfo['fb_id']}\">لینک اکانت فیسبوک</a>";} ?></td>
                                            <td><?php if (strlen($accountInfo['fb_id']) == 0) {echo "";} else {echo "<a href=\"/admin/profile.php/?id={$accountInfo['id']}&access_token=".admin::getAccessToken()."&act=disconnect\">حذف اتصال</a>";} ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">آی پی هنگام ثبت نام :</td>
                                            <td><?php if (!APP_DEMO) {echo $accountInfo['ip_addr'];} else {echo "در حالت آزمایشی غیر فعال است";} ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">تاریخ ثبت نام :</td>
                                            <td><?php echo date("Y-m-d H:i:s", $accountInfo['regtime']); ?></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">تبلیغات ( فعال یا غیر فعال کردن تبلیغات برای این کاربر)</td>
                                            <td>
                                                <?php

                                                    if ($accountInfo['admob'] == 1) {

                                                        echo "<span>نمایش تبلیغات برای کاربر</span>";

                                                    } else {

                                                        echo "<span>عدم نمایش تبلیغات برای کاربر</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                    if ($accountInfo['admob'] == 1) {

                                                        ?>
                                                            <a class="" href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=hideAdmob">غیرفعال کردن تبلیغات برای کاربر</a>
                                                        <?php

                                                    } else {

                                                        ?>
                                                            <a class="" href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=showAdmob">فعال کردن تبلیغات برای کاربر</a>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left">وضعیت اکانت :</td>
                                            <td>
                                                <?php

                                                    if ($accountInfo['state'] == ACCOUNT_STATE_ENABLED) {

                                                        echo "<span>اکانت فعال است</span>";

                                                    } else {

                                                        echo "<span>اکانت مسدود است</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php

                                                    if ($accountInfo['state'] == ACCOUNT_STATE_ENABLED) {

                                                        ?>
                                                            <a class="" href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=block">مسدود کردن اکانت</a>
                                                        <?php

                                                    } else {

                                                        ?>
                                                            <a class="" href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=unblock">خروج از بلاک</a>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <h4>ویرایش اکانت</h4>
                            </div>
                        </div>

                        <?php

                            if (strlen($accountInfo['lowPhotoUrl']) != 0) {

                                ?>
                                    <div class="row">
                                        <div class="col s12 m4">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="<?php echo $accountInfo['normalPhotoUrl'] ?>">
                                                    <span class="card-title">تصویر کاربر</span>
                                                </div>
                                                <div class="card-action">
                                                    <a href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=delete-photo">حذف</a>
                                                    <a target="_blank" href="<?php echo $accountInfo['bigPhotoUrl'] ?>">دیدن در اندازه کامل</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }

                            if (strlen($accountInfo['coverUrl']) != 0) {

                                ?>
                                    <div class="row">
                                        <div class="col s12 m4">
                                            <div class="card">
                                                <div class="card-image">
                                                    <img src="<?php echo $accountInfo['coverUrl'] ?>">
                                                    <span class="card-title">کاور</span>
                                                </div>
                                                <div class="card-action">
                                                    <a href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=delete-cover">حذف</a>
                                                    <a target="_blank" href="<?php echo $accountInfo['coverUrl'] ?>">دیدن در اندازه کامل</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>

                        <form method="post" action="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>">

                                <input type="hidden" name="authenticity_token" value="<?php echo helper::getAuthenticityToken(); ?>">

                                <div class="row">

                                    <div class="input-field col s12">
                                        <input placeholder="نام کاربری" id="username" type="text" name="username" maxlength="255" class="validate" value="<?php echo $accountInfo['username']; ?>" style="direction:ltr;">
                                        <label for="username">نام کاربری</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input placeholder="نام کامل" id="fullname" type="text" name="fullname" maxlength="255" class="validate" value="<?php echo $accountInfo['fullname']; ?>">
                                        <label for="fullname">نام کامل</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input placeholder="موقعیت" id="location" type="text" name="location" maxlength="255" class="validate" value="<?php echo $accountInfo['location']; ?>">
                                        <label for="location">موقعیت</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input placeholder="آدرس فیسبوک" id="fb_page" type="text" name="fb_page" maxlength="255" class="validate" value="<?php echo $accountInfo['fb_page']; ?>" style="direction:ltr;">
                                        <label for="fb_page">آدرس فیسبوک</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input placeholder="آدرس اینستاگرام" id="instagram_page" type="text" name="instagram_page" maxlength="255" class="validate" value="<?php echo $accountInfo['instagram_page']; ?>" style="direction:ltr;">
                                        <label for="instagram_page">آدرس اینستاگرام</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <input placeholder="ایمیل" id="email" type="text" name="email" maxlength="255" class="validate" value="<?php echo $accountInfo['email']; ?>" style="direction:ltr;">
                                        <label for="email">ایمیل</label>
                                    </div>

                                    <div class="input-field col s12">
                                        <button type="submit" class="btn waves-effect waves-light" name="" >ذخیره</button>
                                    </div>

                                </div>

                            </form>

                            <div class="row">
                                <div class="col s12">
                                    <h4>مجوزها</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <a href="/admin/profile.php/?id=<?php echo $accountInfo['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>&act=close">
                                        <button class="btn waves-effect waves-light teal">بستن تمامی مجوزها<i class="material-icons right">delete</i></button>
                                    </a>
                                </div>
                            </div>

                            <div class="col s12">

                                <?php

                                    $result = $stats->getAuthData($accountInfo['id'], 0);

                                    $inbox_loaded = count($result['data']);

                                    if ($inbox_loaded != 0) {

                                    ?>

                                    <table class="bordered data-tables responsive-table">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">آی دی</th>
                                                <th>نشانه دسترسی</th>
                                                <th>آی دی کلاینت</th>
                                                <th>تاریخ ساخت</th>
                                                <th>تاریخ بسته شدن</th>
                                                <th>مرورگر</th>
                                                <th>آدرس آی پی</th>
                                            </tr>

                                        <?php

                                        foreach ($result['data'] as $key => $value) {

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

    function draw($authObj)
    {
        ?>

        <tr>
            <td class="text-left"><?php echo $authObj['id']; ?></td>
            <td><?php echo $authObj['accessToken']; ?></td>
            <td><?php echo $authObj['clientId']; ?></td>
            <td><?php echo date("Y-m-d H:i:s", $authObj['createAt']); ?></td>
            <td><?php if ($authObj['removeAt'] == 0) {echo "-";} else {echo date("Y-m-d H:i:s", $authObj['removeAt']);} ?></td>
            <td><?php echo $authObj['u_agent']; ?></td>
            <td><?php if (!APP_DEMO) {echo $authObj['ip_addr'];} else {echo "در حالت آزمایشی غیرفعال است";} ?></td>
        </tr>

        <?php
    }