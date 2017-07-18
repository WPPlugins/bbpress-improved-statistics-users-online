<?php

    // Default plugin information

    return array("user_inactivity_time" => 15, 
    "user_activity_time" => 24,
    "last_user" => "on",
    "bbpress_statistics" => "on",
    "title_text_currently_active" => "Members Currently Active: %COUNT_ACTIVE_USERS%",
    "title_text_last_x_hours" => "Members active within the past %HOURS% hours: %COUNT_ALL_USERS%",
    "forum_display_option" => array("after_forums_index"),
    "before_forum_display" => "Forum Statistics",
    "after_forum_display" => "",
    "bbpress_statistics_merge" => "on",
    "extra_user_online_status" => "off",
    "extra_enable_shortcode" => "off",
    "extra_enable_whitelist" => "off",
    "extra_whitelist_fields_array" => "b,i,u,s,center,right,left,justify,quote,url,img,youtube,vimeo,note,li,ul,ol,list",
    "user_display_format" => "display_as_username",
    "disable_css" => "off",
    "extra_keep_db" => "off",
    "most_users_online" => "on",
    "user_group_key" => "on",
    "record_users" => array("users" => 1, "date" => date('Y-m-d H:i:s') ),
    "stats_to_display" => array("last_x_hours","last_x_mins"),
    "user_display_limit" => 0,
    "user_display_limit_link" => -1);