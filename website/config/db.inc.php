<?php

    /*!
     * ifsoft.co.uk v1.0
     *
     * http://ifsoft.com.ua, http://ifsoft.co.uk
     * qascript@ifsoft.co.uk, qascript@mail.ru
     *
     * Copyright 2012-2016 Demyanchuk Dmitry (https://vk.com/dmitry.demyanchuk)
     */

$C = array();
$B = array();

$B['APP_DEMO'] = false;                                     //true = enable demo version mode (only Admin panel)

$B['SITE_THEME'] = "marketplace-theme";                     //Color Styles look here: http://materializecss.com/color.html
$B['SITE_TEXT_COLOR'] = "red-text text-darken-1";           //For menu items, icons and etc.. Color Styles look here: http://materializecss.com/color.html

$B['APP_MESSAGES_COUNTERS'] = true;                         //true = show new messages counters
$B['APP_MYSQLI_EXTENSION'] = true;                          //if on the server is not installed mysqli extension, set to false
$B['FACEBOOK_AUTHORIZATION'] = false;                        //false = Do not show buttons Login/Signup with Facebook | true = allow display buttons Login/Signup with Facebook

// Additional information. It does not affect the work applications and website

$C['COMPANY_URL'] = "http://androidlife.ir";
$B['APP_SUPPORT_EMAIL'] = "saberikorosh@gmail.com";
$B['APP_AUTHOR_PAGE'] = "Mojtaba Saberi";
$B['APP_PATH'] = "app";
$B['APP_VERSION'] = "1";
$B['APP_AUTHOR'] = "Mojtaba Saberi";
$B['APP_VENDOR'] = "androidlife.ir";

// Paths to folders for storing images. Do not change!

$B['TEMP_PATH'] = "../tmp/";                                //don`t edit this option
$B['COVER_PATH'] = "../cover/";                            //don`t edit this option
$B['PHOTO_PATH'] = "../photo/";                             //don`t edit this option
$B['CHAT_IMAGE_PATH'] = "../chat_images/";                  //don`t edit this option
$B['ITEMS_PHOTO_PATH'] = "../items/";                       //don`t edit this option
$B['CATEGORIES_PHOTO_PATH'] = "../categories/";             //don`t edit this option

// Data for the title of the website and copyright

$B['APP_NAME'] = "فروشگاه اندرويد لايف";                            //
$B['APP_TITLE'] = "فروشگاه";                           //
$B['APP_YEAR'] = "2016";                                       // Year in footer

// Your domain (host) and url! See comments! Carefully!

$B['APP_HOST'] = "localhost";                 //edit to your domain, example (WARNING - without http:// and www): yourdomain.com
$B['APP_URL'] = "http://localhost";           //edit to your domain url, example (WARNING - with http://): http://yourdomain.com

// Link to GOOGLE Play App in main page

$B['GOOGLE_PLAY_LINK'] = "https://cafebazaar.ir/developer/korosh_saberi/";

// Client ID. For more information, see the documentation, FAQ section

$B['CLIENT_ID'] = 1;                                        //Client ID | For identify the application | Example: 12567 (see documentation. section: faq)

// Google settings | For sending GCM (Google Cloud Messages) | http://ifsoft.co.uk/help/how_to_generate_sender_id_and_api_key/

$B['GOOGLE_API_KEY'] = "AIzaSyBj307fqbKHxe4vBWatUIwM_QRM5DmLe_Q";
$B['GOOGLE_SENDER_ID'] = "276296983946";

// Facebook settings | For login/signup with facebook | http://ifsoft.co.uk/help/how_to_create_facebook_application_and_get_app_id_and_app_secret/

$B['FACEBOOK_APP_ID'] = "234234234234234";
$B['FACEBOOK_APP_SECRET'] = "1ad56d72341cb1a3aee1792rt3451b";

// SMTP Settings | For password recovery | Data for SMTP can ask your hosting provider |

$B['SMTP_HOST'] = 'yourhost';                   //SMTP host | Specify main and backup SMTP servers
$B['SMTP_AUTH'] = true;                                     //SMTP auth (Enable SMTP authentication)
$B['SMTP_SECURE'] = 'ssl';                                  //SMTP secure (Enable TLS encryption, `ssl` also accepted)
$B['SMTP_PORT'] = TLS;                                      //SMTP port (TCP port to connect to)
$B['SMTP_EMAIL'] = 'info@androidlove.ir';                      //SMTP email
$B['SMTP_USERNAME'] = 'info@androidlove.ir';                   //SMTP username
$B['SMTP_PASSWORD'] = 'yourpass';                           //SMTP password

//Please edit database data

$C['DB_HOST'] = "localhost";                                //localhost or your db host
$C['DB_USER'] = "root";                             //your db user
$C['DB_PASS'] = "";                         //your db password
$C['DB_NAME'] = "mymarket";                             //your db name


$C['ERROR_SUCCESS'] = 0;

$C['ERROR_UNKNOWN'] = 100;
$C['ERROR_ACCESS_TOKEN'] = 101;

$C['ERROR_LOGIN_TAKEN'] = 300;
$C['ERROR_EMAIL_TAKEN'] = 301;
$C['ERROR_FACEBOOK_ID_TAKEN'] = 302;
$C['ERROR_PHONE_TAKEN'] = 303;

$C['ERROR_ACCOUNT_ID'] = 400;

$C['DISABLE_LIKES_GCM'] = 0;
$C['ENABLE_LIKES_GCM'] = 1;

$C['DISABLE_COMMENTS_GCM'] = 0;
$C['ENABLE_COMMENTS_GCM'] = 1;

$C['DISABLE_FOLLOWERS_GCM'] = 0;
$C['ENABLE_FOLLOWERS_GCM'] = 1;

$C['DISABLE_MESSAGES_GCM'] = 0;
$C['ENABLE_MESSAGES_GCM'] = 1;

$C['DISABLE_GIFTS_GCM'] = 0;
$C['ENABLE_GIFTS_GCM'] = 1;

$C['SEX_UNKNOWN'] = 0;
$C['SEX_MALE'] = 1;
$C['SEX_FEMALE'] = 2;

$C['USER_CREATED_SUCCESSFULLY'] = 0;
$C['USER_CREATE_FAILED'] = 1;
$C['USER_ALREADY_EXISTED'] = 2;
$C['USER_BLOCKED'] = 3;
$C['USER_NOT_FOUND'] = 4;
$C['USER_LOGIN_SUCCESSFULLY'] = 5;
$C['EMPTY_DATA'] = 6;
$C['ERROR_API_KEY'] = 7;

$C['NOTIFY_TYPE_LIKE'] = 0;
$C['NOTIFY_TYPE_FOLLOWER'] = 1;
$C['NOTIFY_TYPE_MESSAGE'] = 2;
$C['NOTIFY_TYPE_COMMENT'] = 3;
$C['NOTIFY_TYPE_COMMENT_REPLY'] = 4;
$C['NOTIFY_TYPE_GIFT'] = 6;
$C['NOTIFY_TYPE_REVIEW'] = 7;

$C['GCM_NOTIFY_CONFIG'] = 0;
$C['GCM_NOTIFY_SYSTEM'] = 1;
$C['GCM_NOTIFY_CUSTOM'] = 2;
$C['GCM_NOTIFY_LIKE'] = 3;
$C['GCM_NOTIFY_ANSWER'] = 4;
$C['GCM_NOTIFY_QUESTION'] = 5;
$C['GCM_NOTIFY_COMMENT'] = 6;
$C['GCM_NOTIFY_FOLLOWER'] = 7;
$C['GCM_NOTIFY_PERSONAL'] = 8;
$C['GCM_NOTIFY_MESSAGE'] = 9;
$C['GCM_NOTIFY_COMMENT_REPLY'] = 10;
$C['GCM_NOTIFY_GIFT'] = 14;
$C['GCM_NOTIFY_REVIEW'] = 15;

$C['ACCOUNT_STATE_ENABLED'] = 0;
$C['ACCOUNT_STATE_DISABLED'] = 1;
$C['ACCOUNT_STATE_BLOCKED'] = 2;
$C['ACCOUNT_STATE_DEACTIVATED'] = 3;

$C['ACCOUNT_TYPE_USER'] = 0;
$C['ACCOUNT_TYPE_GROUP'] = 1;
$C['ACCOUNT_TYPE_PAGE'] = 2;

$C['ACCOUNT_ACCESS_LEVEL_AVAILABLE_TO_ALL'] = 0;
$C['ACCOUNT_ACCESS_LEVEL_AVAILABLE_TO_FRIENDS'] = 1;

$C['ADMIN_ACCESS_LEVEL_NULL'] = -1;
$C['ADMIN_ACCESS_LEVEL_FULL'] = 0;
$C['ADMIN_ACCESS_LEVEL_MODERATOR'] = 1;
$C['ADMIN_ACCESS_LEVEL_GUEST'] = 2;

// Languages. For more information see documentation, section: Adding a new language (WEB SITE)

$LANGS = array();
$LANGS['English'] = "en";
$LANGS['Русский'] = "ru";

