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

    $page_id = "item_view";

    $error = false;
    $error_message = '';

    if (isset($_GET['id'])) {

        $itemId = isset($_GET['id']) ? $_GET['id'] : 0;

        $itemId = helper::clearInt($itemId);

        $item = new items($dbo);

        $itemInfo = $item->info($itemId);

        if ($itemInfo['error'] === true || $itemInfo['removeAt'] != 0) {

            header("Location: /admin/items.php");
            exit;
        }

    } else {

        header("Location: /admin/items.php");
        exit;
    }

    $css_files = array("my.css", "admin.css");
    $page_title = "نمایش محصول";

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
                                <h4>نمایش محصول</h4>
                            </div>
                        </div>

                        <div class="row">
                            
                        </div>

				<div class="col s12" id="items-content">

                    <?php

                        draw($itemInfo, $helper);

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

</body>
</html>

<?php

    function draw($item, $helper)
    {
        ?>

            <div class="row item" data-id="<?php echo $item['id']; ?>">
                <div class="col s8">
                    <div class="card">
                        <div class="card-image">
                            <img src="<?php echo $item['imgUrl']; ?>">
                            <span class="card-title"><?php echo $item['itemTitle']; ?></span>
                        </div>
                        <div class="card-content">
                            <p><?php echo $item['price']; ?> تومان</p><br>
                            <p><?php echo $item['itemContent']; ?></p>
                            <ul class="collection">
                                <li class="collection-item avatar" style="min-height: inherit">
                                    <a href="/admin/profile.php?id=<?php echo $item['fromUserId']; ?>"><img src="<?php if ( strlen($item['fromUserPhoto']) != 0 ) { echo $item['fromUserPhoto']; } else { echo "/img/profile_default_photo.png"; } ?>" alt="" class="circle"></a>
                                    <span class="title dialogs-title"><?php echo $item['fromUserFullname']; ?></span>

                                    <?php

                                        if (strlen($item['fromUserPhone'])) {

                                            ?>
                                                <p style="direction: ltr;">
                                                    <?php echo $item['fromUserPhone']; ?>
                                                    <br>
                                                </p>
                                            <?php
                                        }
                                    ?>
                                    <p><?php echo $item['timeAgo']; ?></p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-action">
                            <a href="/admin/item_remove.php/?id=<?php echo $item['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>">حذف</a>
                        </div>
                    </div>
                </div>
            </div>

        <?php
    }