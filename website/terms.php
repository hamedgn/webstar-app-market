<?php

    /*!
	 * ifsoft engine v1.0
	 *
	 * http://ifsoft.com.ua, http://ifsoft.co.uk
	 * qascript@ifsoft.co.uk, qascript@mail.ru
	 *
	 * Copyright 2012-2016 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
	 */

    include_once($_SERVER['DOCUMENT_ROOT']."/core/init.inc.php");

    if (auth::isSession()) {

        header("Location: /stream.php");
    }

    $css_files = array("my.css");
    $page_title = "قوانین و مقررات";

    include_once($_SERVER['DOCUMENT_ROOT']."/common/header.inc.php");
?>

<body>

<?php

    include_once($_SERVER['DOCUMENT_ROOT']."/common/site_topbar.inc.php");
?>

<div class="section no-pad-bot" id="index-banner">

    <div class="container" style="margin-top: 20px; margin-bottom: 100px;">
        <br><br>
        <h3 class="header center orange-text">قوانین و مقررات استفاده از سایت</h3>

        <div class="row center">
            <h5 class="header col s12 light">قانون اول : لطفا لبخند بزنید :)</h5>
			<h5 class="header col s12 light">قانون دوم : از قرار دادن مطالب غیراخلاقی و سیاسی و اون چیزایی که خودتون هم میدونید به شدت پرهیز کنید !</h5>
			<h5 class="header col s12 light">قانون سوم : به یکدیگر احترام بگذاریم ، زیرا با یکدیگر پدرکشتگی نداریم !</h5>
        </div>

        

        <br><br>
    </div>

</div>


<footer class="page-footer white" style="padding-top: 0px;">
    <div class="footer-copyright white">
        <div class="container <?php echo SITE_TEXT_COLOR; ?>">
            <span class="grey-text darken-2"><?php echo APP_TITLE; ?> © <?php echo APP_YEAR; ?></span>
            <span style="margin-left: 10px;"><a class="text-lighten-4 modal-trigger <?php echo SITE_TEXT_COLOR; ?> text-darken-3" href="#lang-box"><?php echo $LANG['lang-name']; ?></a></span>
            <span class="center"><a class="text-lighten-4 <?php echo SITE_TEXT_COLOR; ?>" target="_blank" href="<?php echo COMPANY_URL; ?>"></a></span>
        </div>
    </div>
</footer>

<div id="lang-box" class="modal">
    <div class="modal-content">
        <h4><?php echo $LANG['page-language']; ?></h4>
        <?php

        foreach ($LANGS as $name => $val) {

            echo "<a onclick=\"App.setLanguage('$val'); return false;\" class=\"waves-effect btn-flat\" style=\"display: block\" href=\"javascript:void(0)\">$name</a>";
        }

        ?>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect btn-flat"><?php echo $LANG['action-close']; ?></a>
    </div>
</div>

    <script type="text/javascript" src="/js/materialize.min.js"></script>

    <script src="/js/init.js"></script>

<script type="text/javascript">

    $('.modal-trigger').leanModal({
                dismissible: true, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200, // Transition out duration
                ready: function() {  }, // Callback for Modal open
                complete: function() { } // Callback for Modal close
        }
    );

    window.App || ( window.App = {} );

    App.setLanguage = function(language) {

        $.cookie("lang", language, { expires : 7, path: '/' });
        $('#lang-box').closeModal();
        location.reload();
    };

</script>

</body>
</html>