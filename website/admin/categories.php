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

    $page_id = "categories";

    $error = false;
    $error_message = '';

    helper::newAuthenticityToken();

    $css_files = array("my.css", "admin.css");
    $page_title = "دسته بندی ها";

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
                            <div class="col s4">
                                <h4>دسته بندی ها</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <a href="/admin/category_create.php">
							        <button class="btn waves-effect waves-light teal">افزودن دسته بندی<i class="material-icons left">add</i></button>
						        </a>
                            </div>
                        </div>

				<div class="col s12">

                    <?php

                        $categories = new categories($dbo);

                        $result = $categories->getList();

                        $inbox_loaded = count($result['items']);

                        if ($inbox_loaded != 0) {

                        ?>

						<table class="bordered responsive-table">
							<tbody>
                                <tr>
                                    <th>آی دی</th>
                                    <th>نام</th>
                                    <th>توضیحات</th>
                                    <th>تصویر</th>
                                    <th>تعداد محصولات</th>
                                    <th>تاریخ ساخت</th>
                                    <th>عملیات</th>
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

    function draw($category)
    {
        ?>

        <tr>
            <td><?php echo $category['id']; ?></td>
            <td><?php echo $category['title']; ?></td>
            <td><?php echo $category['description']; ?></td>
            <td><img style="height: 50px" src="<?php echo $category['imgUrl']; ?>"></td>
            <td><?php echo $category['itemsCount']; ?></td>
            <td><?php echo $category['date']; ?></td>
            <td>
                <a href="/admin/category_edit.php/?id=<?php echo $category['id']; ?>"><i class="material-icons">mode_edit</i></a>
                <a href="/admin/category_remove.php/?id=<?php echo $category['id']; ?>&access_token=<?php echo admin::getAccessToken(); ?>"><i class="material-icons">delete</i></a>
            </td>
        </tr>

        <?php
    }