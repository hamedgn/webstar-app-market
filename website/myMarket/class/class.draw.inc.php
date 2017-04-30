<?php

/*!
 * ifsoft.co.uk engine v1.0
 *
 * http://ifsoft.com.ua, http://ifsoft.co.uk
 * qascript@ifsoft.co.uk
 *
 * Copyright 2012-2016 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
 */

class draw extends db_connect
{
	public function __construct($dbo = NULL)
    {
		parent::__construct($dbo);
	}

    static function messageItem($message, $LANG, $helper)
    {
        $time = new language(NULL, $LANG['lang-code']);

        $message['message'] = helper::processMsgText($message['message']);

        ?>

        <li class="collection-item avatar" data-id="<?php echo $message['id']; ?>">
            <a href="/profile.php?id=<?php echo $message['fromUserId']; ?>"><img src="<?php if (strlen($message['fromUserPhotoUrl']) != 0 ) { echo $message['fromUserPhotoUrl']; } else { echo "/img/profile_default_photo.png"; } ?>" alt="" class="circle"></a>
            <span class="title dialogs-title"><?php echo $message['fromUserUsername']; ?></span>
            <p>
                <?php

                if (strlen($message['message']) > 0) {

                    ?>
                        <?php echo $message['message']; ?>
                    <?php
                }

                if (strlen($message['imgUrl']) > 0) {

                    ?>
                        </br><img style="max-width: 80%; margin-top: 10px;" src="<?php echo $message['imgUrl']; ?>"></br>
                    <?php
                }

                ?>

            </p>
            <a href="javascript:void(0)" class="secondary-content"><?php echo $time->timeAgo($message['createAt']); ?></a>
        </li>

        <?php
    }

    static function commentItem($value, $LANG, $helper)
    {

        $value['comment'] = helper::processCommentText($value['comment']);

        ?>
            <li class="collection-item avatar" data-id="<?php echo $value['id']; ?>">
                <a href="/profile.php?id=<?php echo $value['fromUserId']; ?>"><img src="<?php if ( strlen($value['fromUserPhotoUrl']) != 0 ) { echo $value['fromUserPhotoUrl']; } else { echo "/img/profile_default_photo.png"; } ?>" alt="" class="circle"></a>
                <span class="title dialogs-title"><?php echo $value['fromUserFullname']; ?></span>
                <p>
                    <?php
                    echo $value['comment'];
                    ?>
                    <br>
                    <?php echo $value['timeAgo']; ?>
                    <br>
                </p>
                <?php

                if ($value['fromUserId'] == auth::getCurrentUserId()) {

                    ?>
                    <a href="#!" onclick="Comments.remove('<?php echo $value['id']; ?>', '<?php echo auth::getAccessToken(); ?>'); return false;" class="secondary-content <?php echo SITE_TEXT_COLOR; ?>"><i class="material-icons">delete</i></a>
                    <?php

                } else {

                    ?>
                    <a href="#!" onclick="Comments.reply('<?php echo $value['id']; ?>', '<?php echo $value['fromUserId']; ?>', '<?php echo $value['fromUserUsername']; ?>'); return false;" class="secondary-content <?php echo SITE_TEXT_COLOR; ?>"><i class="material-icons">reply</i></a>
                    <?php
                }
                ?>

            </li>
        <?php
    }
}

