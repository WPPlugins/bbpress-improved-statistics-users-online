=== bbPress Advanced Statistics ===
Contributors: GeekServe
Donate link: http://thegeek.info
Tags: bbpress, statistics, users, online, users online, forum statistics
Requires at least: 3.9
Tested up to: 4.7
Stable tag: 1.4.4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

phpBB/vBulletin-esque statistics for your bbPress Forum - show off just how active your forum is with additional statistics and user tracking!

== Description ==

> **This plugin has been tested with bbPress 2.6**
> This plugin has been tested and works with the upcoming version of bbPress, version 2.6

The statistical functionality within core bbPress is limited, with this plugin, you can achieve phpBB / vBulletin-esque statistics for your bbPress Forum, 
you can opt to use the widget provided with the plugin, or, you can use the options provided within the customisation tab of the plugin.

= What does this plugin provide? =

 * Currently Active Users
 * Users active within a set period of time
 * Listed users, with links to their profile pages
 * Most Users Ever Online tracking! 
 * Ability to restrict what shortcodes/bbcodes are used within posts
 * Customisable text strings, to suit your needs
 * WordPress domaintext ready! (Translations, see FAQ for further details)
 * Now supports multi-site setups

= Rate us & Submit your website using our plugin! =

There are over 600 websites actively using bbPress Advanced Statistics, and I want to see your site! If you would like it to be featured below, pop a post in the forum showing off your site or pop us a rating!

 * [Nintenderos](http://www.nintenderos.com/foro-nintendo/) - A nintendo fansite using bbPress that is very active
 * [VPinball](http://vpinball.com/forums/) - Pinball enthusiast forum
 * [RockstarWire](http://rockstarwire.net) - Rockstar Games Fansite
 * [PortalKnights](http://www.portalknights.com/forums) - Steam Game by 505Games
 * [You Talk Trash](http://youtalktrash.com/forum/) - A popular forum for YouTuber Trash Talking

*The websites above were found using some google trickery. To make my life easier, please make me aware of your site when using the plugin if you'd like to be featured!*

== Installation ==

Installing "bbPress Advanced Statistics" can be done either by searching for "bbPress Advanced Statistics" via the "Plugins > Add New" screen in your WordPress dashboard, or by using the following steps:

1. Download the plugin via WordPress.org
2. Upload the ZIP file through the 'Plugins > Add New > Upload' screen in your WordPress dashboard
3. Activate the plugin through the 'Plugins' menu in WordPress

From there, you should now have an option under "Forums" called "bbPress Advanced Statistics". Here, you can set various important parts of the plugin, such as the locations where the statistics are displayed.

Alternatively, you can enable a widget that will display the statistics for you in any sidebars you have setup.

== Screenshots ==

1. The plugin in action, screen depicts the plugin in use on a website
2. Standard Options available within the WordPress Admin Page
3. Some customisation options, with more to come in pending updates
4. Our newest addition - the extras tab. 

== Frequently Asked Questions ==

> **I have an awesome idea!!**
>
> Brilliant! I am always looking for ways to improve this plugin and make it better for the users - feel free to post a request in [our official forum](https://wordpress.org/support/plugin/bbpress-improved-statistics-users-online)

= I need help, please help! =

We provide help in our designated WordPress Plugin forum, if you're stuck and need a hand with anything to do with the plugin, please post in [our official forum](https://wordpress.org/support/plugin/bbpress-improved-statistics-users-online).

Please provide as much information as possible when posting, including a link to your forum and the 'Debug Information' that can be found within `Forums > bbPress Advanced Statistics > Plugin Information`. Without this information, I will be unable to assist.

= Is bbPress a requirement for this plugin? =

Yes, absolutely. Upon installation, if bbPress is not installed the install of this plugin will fail.

= Does this work for previously logged in users? =

Unfortunately, WordPress nor bbPress provide a "user is online" functionality out of the box - we had to add that ourselves, thus - data will only be displayed in this plugin after it has been installed as users log in to your site. 

= So, I've installed it... where are the stats? =

You have three options in this case!

1. Enable the Widget within 'Appearance > Widgets'
2. Hook the plugin into certain bbPress Hooks, within the "Customisation" Tab
3. Use the shortcode [bbpas-activity]

**Note:** The shortcode option is not recommended as it enables shortcodes in widgets, this could be considered a security risk.

= Are there any settings I can change? =

Plenty of options are waiting to be tinkered with! Under the "Forums" menu item, you should see "bbPress Advanced Statistics"

= Do you have a widget? =

Yes we do! Simply activate it as you would with any other widget.

= How do I create / submit a Translation? =

You have two options, first and foremost - I am using GlotPress primarily for this. Reason being, it is free and makes crowdsourced-translations a quick and pain-free process.
I will not be providing any translated files in the plugin itself, instead - GlotPress will automatically generate the files that have reached the threshold.

If you'd like to contribute to the translation of this plugin, please [click here](https://translate.wordpress.org/projects/wp-plugins/bbpress-improved-statistics-users-online)

With that being said, users are still able to add translations they have made manually. See below for further details.

We have made it super easy to create translations for this plugin, you simply need to grab the original
POT file (found within the plugin directory) and create translation files based off of that.

You can use [Poedit](https://poedit.net/) to create your translation.

 * [WPLang Tutorial](http://wplang.org/translate-theme-plugin/)
 * [ZaneMatthew](http://zanematthew.com/translate-a-wordpress-plugin-using-poedit/)
 
> **Please Note:** The filename **must be** correct in order for your Translation to work. The naming convention is as follows:
>
> * `bbpress-advanced-statistics-LOCALE.mo`
> * `bbpress-advanced-statistics-LOCALE.po`
>
> Where LOCALE is the code for your language, e.g German would be bbpress-advanced-statistics-de_DE.mo
>
> You can find the correct code for your locale [here](https://make.wordpress.org/polyglots/teams/) 

Once you are happy with your Translation, drop it into /wp-content/languages/bbpress-advanced-statistics/ and it should be instantly activated.

> **Don't forget:** The filename **has to be identical** to that WordPress expects, else your language pack will not be used! If you need some assistance with this, post in our support forums.

Alternatively, you can [help translate in general](https://translate.wordpress.org/projects/wp-plugins/bbpress-improved-statistics-users-online) (This is a much better option and helps us build up the translation library for all locales!)

== Additional Notes ==

As this plugin grows, there is more and more need for further detail on the 
functionality provided. Below, you will find help on the following subjects:

* Shortcode/BBCode restriction
* CSS Rules & Overriding

=  Shortcode/BBCode restriction =

I have added functionality in this plugin that allows users to restrict the BBCodes
and shortcodes available for use within bbPress Forum posts. 

Whilst developing this plugin, I noticed users are able to use shortcodes in their
posts without any restrictions. This means, you can enter `bbp-login`, or `bbpas-online` or
any shortcode you have added to your WordPress site into bbPress posts.

Whilst most shortcodes won't be problematic, some most definitely will be. For example, the use of `bbp-login` actually breaks the layout of my public forum. Another plugin I use, `tabby`, simply is not
developed for use on bbPress and 9 times out of 10 causes severe issues with the page hierarchy within bbPress.

To combat this, I added a very simple piece of functionality to this plugin that will allow you
to whitelist shortcodes you would like to be used within bbPress posts. That is simply it. 

You can find this option within he 'Extras' tab, simply check the `Enable BBCode/Shortcode Whitelist?` option and
then enter your Whitelisted Fields into the textarea below. They should be in CSV format without any spaces!

**By default, the following Shortcodes/BBCodes are whitelisted.**

`b,i,u,s,center,right,left,justify,quote,url,img,youtube,vimeo,note,li,ul,ol,list`

= CSS Rules & Overriding =

I have made it much easier to change the design of the plugin by adding multiple
css classes into the code of the plugin, and by also allowing you to disable
the default CSS file.

Below, I have documented all of the classes currently available for use alongside
a small description, please view the stylesheet provided with the plugin
for further help.

* `.bbpas-header` - Used to display headers within the plugin, grey by default
* `h2.bbpas-h2` - Styles the header above the statistics if you are using the shortcode
* `a.bbpas-user` - Sets the style for all users displayed in he plugin, here you can make all users appear in green text for example
* `span.bbpas-title` - This is the styling used for titles, such as 'Threads' and 'Posts'. By default this is **bold**

I have also added classes for every single user and their forum role, for bbPress Forums without any role modifications - the following classes will work:

* `.keymaster a` - Styles the keymaster group links, by default red and bold.
* `.moderator a` - Styles the moderator group links, by default black and bold.
* `.blocked a` - Styles the blocked group links, by default italic and striked out

> If you have changed the names of the groups, or added new ones... fear not! You can simply add them
> to the css file and it will style them correctly. For example, if you have created a group called 'Supporter' you would enter
> the following code to your stylesheet to style it:

    `.supporter a {
    color: orange;
    font-weight: bold;
    }`

That will then make all members of the Supporter group display as bold, orange links.

You are also able to customise each section within the Statistics, each has its own class for you to style. The following elements are available for you to style:

* `.bbpas-active` - Styles the 'Members Currently Active' section
* `.bbpas-inactive` - Styles the 'Members active within the past x hours' section
* `.bbpas-forum_key` - Styles the Forum key section
* `.bbpas-forum_stats` - Styles the bbPress Forum Statistics section
* `.bbpas-most_users` - Styles the 'Most Users Ever Online' section

For example:

`.bbpas-active, .bbpas-inactive, .bbpas-forum_key, .bbpas-forum_stats, .bbpas-most_users {
    background-color: pink;
}
`

The above would set all of the sections' background to Hot Pink. I'm not sure why you would ever want to do that, however, you can. With that being said, you could pick on an individual
section like so:

`.bbpas-forum_key {
    background-color: pink;
}
`

That snippet of code will only affect the usergroup key alone.

As far as customisation goes, that is the furthest I can get it (to the best of my knowledge.) If you have any suggestions for further customisation,
please post them in our support forum!

== Changelog ==

> The changes listed here are organised as Improve, Bug Fix and Feature. 
>
> In each release, I try to fit in as many Improvements and Features as I can,
> Bug Fixes are prioritised and are usually the reason a new version is developed.
>
> * **Improvements** are simply code adjustments to make existing features better
> * **Features** are brand new additions to the plugin
> * **Bug Fixes** are usually issues reported by users and fixed

= 1.4.4.1 - 2nd January, 2017 =
 * Bug Fix: Support for periods in the posts/topics and user counts
 * Improve: Small improvements to uninstall procedure, added some comments
 * Improve: Plugin now actively checks to see if bbPress is installed - will deactivate if it isn't 

= 1.4.4 - 1st January, 2017 =
 * Improve: Plugin Information page now displays more information for debugging purposes
 * Improve: Worked on cleaning up some of the code, sorting out comments and so on
 * Bug Fix: Corrected an issue with multisites where the parent db prefix was being selected all the time when getting online users
 * Bug Fix: Corrected an issue with multisites db prefix when the plugin is running upgrades

= 1.4.3 - 26th December, 2016 =
 * Feature: WordPress Multisite/Networks now fully supported
 * Feature: 'Plugin Information' tab added, this page will be expanded overtime to assist with debugging.
 * Improve: Admin-related files will only load when in an admin page
 * Improve: Data will now be automatically uninstalled when the plugin is deleted, the user is now explicitly required to check the option to prevent data being deleted
 * Improve: Uninstall procedure is generally much more safe now
 * Bug Fix: An issue in which users were unable to uninstall the plugin should now be resolved
 * Bug Fix: Corrected an issue in which the statistics were incorrect for boards with more than 10000 posts. Thanks to [tronix-ex](https://wordpress.org/support/users/tronix-ex/) for assistance with this.
 
= 1.4.2 - 18th August, 2016 =
 * Bug Fix: Users Currently Online count updated

= 1.4.1 - 18th August, 2016 =
 * Bug Fix: Corrected installation issues
 * Bug Fix: Corrected upgrade issue

= 1.4 - 17th August, 2016 =
 * Full WordPress 4.6 Support!
 * Feature: Added 'Statistics to Display' option, allowing the user to define which online statistics should be displayed
 * Feature: Added 'User Display Limit' option, allowing the user to define how many users should be displayed before stopping (ideal for larger boards)
 * Feature: Added 'User Display Limit Page' option, allowing the user to define a page to be displayed should the count of users go over the limit you set
 * Feature: New Information Page added to the Admin Screen. This displays useful information for debugging purposes
 * Improve: Updated the CSS for the admin side, cleared up some bad formatting.
 * Improve: Moved Plugin options around
 * Improve: Old Database Structure (prior to version 1.3) has now been removed
 * Improve: Added default whitelisted codes to support popular BBCode Plugins (e.g GD bbPress Tools)
 * Improve: More styling options added to the statistics, see Other Notes for further info
 * Improve: Plugin Upgrade has been given some love!
 * Improve: Assets folder cleaned up, removed unnecessary files
 * Improve: Added translation support for widget
 * Improve: Admin Data Callback added for general validation of user input
 * Improve: PHP Notices cleared up

= 1.3.13 - 7th May, 2016 =
 * Feature: Addition of Usergroup Key. This supports custom groups, and will modify the colour based on your stylesheet rules
 * Improve: Spaces are supported in user groups for CSS styling (replaced with hyphens)
 * Improve: Updated the way bbPress stats are collected
 * Improve: Hyperlink IDs for each user moved into the main element
 * Improve: Various general code improvements

= 1.3.12 - 1st May, 2016 =
 * Bug Fix: Corrected Uninstall procedure table name

= 1.3.11 - 26th April, 2016 =
 * Bug Fix: Made `userid` a unique column to prevent duplicates from appearing
 * Bug Fix: More fixes for the upgrade procedure

= 1.3.1 - 23rd April, 2016 =
 * Bug Fix: Corrected database issues that occurred after upgrading
 * Bug Fix: Fixed installation for sites using different db prefixes
 * Bug Fix: Corrected PHP Notice in admin page

= 1.3.0 - 22nd April, 2016 =
 * Feature: Addition of a usable widget! With this being said, shortcodes in widgets is no longer enabled by default for **new installations**. See 'Other Notes' for further details
 * Feature: 'Most Users Ever Online' has been added to the plugin! **This does not take previous data into account, it takes effect from upgrade/plugin installation**
 * Improve: Plugin Installation has been drastically improved.
 * Improve: Plugin Deactivation has been improved, now features option to delete all options and database upon uninstallation. Further changes in future updates
 * Improve: User Activity is now stored in a custom DB table, some performance increase should be noted on larger sites. Data has been migrated, and the old structure will be removed in a future update.
 * Improve: Files removed that are no longer required for the plugin (assets/js)
 * Improve: Further Translation Support added for Admin Pages (radio and checkboxes), removed obsolete/pointless translations
 * Bug Fix: Resolved an issue where extra options would be active regardless of being enabled

= 1.2.2 - 5th April, 2016 =
 * Improve: CSS updated, more classes added for easier theme compatibility!
 * Improve: Additional CSS added by default to the provided CSS file
 * Improve: Added ability to disable CSS file
 * Bug Fix: Few languages fixes throughout the plugin

= 1.2.1 - 3rd April, 2016 =
 * Bug Fix: 'User is Online' persistently appearing in user profile. Thanks to [Anticosti](https://wordpress.org/support/topic/persistant-user-is-online-in-profile-page) 
 * Improve: Updated language text for 'Welcome to our newest member' as it was causing issues. [Thanks to cooljojo](https://wordpress.org/support/topic/about-languages)

= 1.2 - 24th March, 2016 =
 * Feature: Extras tab has been added to host additional functionality for the plugin
 * Feature: BBCode/Shortcode Whitelist added - you can now set which BBCodes/Shortcodes to exclusively enable
 * Feature: Shortcodes within widgets are no longer enabled by default, users can now switch this on or off!
 * Improve: Full glotpress support! Translating is much easier, [Help translate](https://translate.wordpress.org/projects/wp-plugins/bbpress-improved-statistics-users-online) 
 * Improve: Admin Page API updated to include new pages
 * Improve: Better Code Commenting for navigation around the plugin
 * Bug Fix: Resolved PHP Notices/Errors around the plugin, thanks to [ripteh1337 for reporting!](https://wordpress.org/support/topic/php-error-169)
 * Bug Fix: Saving settings on a non-existant tab wipes no longer wipes your settings

= 1.1.3 - 9th January 2016 =
 * Feature: Ability to choose between Usernames or Display names within the settings, [requested by IILLC](https://wordpress.org/support/topic/feature-request-display-name-instead-of-login-name)  
 * Bug Fix: Array clearing within a loop (rookie mistake!)

= 1.1.2 - 10th October 2015 =
 * Improve: Formatting clear up within some files
 * Improve: Some code clean-up and identified other areas for improvement in future releases
 * Bug Fix: Statistics now appear within the Topics Index (/topics) - [thanks to UVScott for the bug report!](https://wordpress.org/support/topic/bug-report-stats-not-displaying-on-topics-index?)

= 1.1.1 - 12th July, 2015 =
 * Feature: Threads and Posts can now be combined, bbPress Statistics do not count the first post of a thread as a post, this can be toggled within the settings.
 * Improve: Language packs can be overrided now, any packs loaded in /wp-content/languages/bbpress-advanced-statistics/ will override those packaged as part of the plugin
 * Improve: Translation String added for username hover over, "ago"
 * Improve: Minor code clean up & bug fixes
 * Bug Fix: Removal of duplicate "bbPress Statistics" option

= 1.1.0 - 4th July, 2015 =
 * Feature: WordPress "textdomain" language files are now supported, new translations can be added into the /lang/ folder!
 * Feature: Hover text added to users within the Forum Statistics section
 * Improve: Added additional localisation strings

= 1.0.3 - 25th May, 2015 =
 * Feature: Count parameters: %COUNT_ACTIVE_USERS% and %COUNT_ALL_USERS% to display count of users active recently & inactive
 * Feature: Minutes parameter: %MINS% to display the option "User Active Time" value
 * Improve: No longer grabbing unnecessary data from the database
 * Improve: Removed unused code and variables, fixed up some incorrect code comments
 * Bug Fix: Time logic within the Currently Active Users portion fixed, now correctly displays the currently active users regardless of what option is set
 * Bug Fix: User Active Time option not working - incorrect variable used within the options page, options will require a resave
 * Bug Fix: Default options are now saved when the user first installs the plugin

= 1.0.2.1 - 23rd May, 2015 =
 * Bug Fix: PHP error when installing v1.0.2 (sorry about that)
 * Bug Fix: No longer time-travelling the release!

= 1.0.2 - 22nd May, 2015 =
 * Feature: New options added to display the statistics within bbPress without widgets, [see here](https://wordpress.org/support/topic/in-forum-display) 
 * Improve: Updated the way options are saved in the Database and removed some redundant code
 * Bug Fix: Fixed "an error has occurred" message when no users were online / active within the past 24 hours
 * Bug Fix: Fixed a PHP warning when no options were set for checkboxes

= 1.0.1.1 - 12th May, 2015 =
 * Feature: Addition of shortcode activation with HTML widget
 * Improve: SVN clean up, moving screenshots to the assets folder
 * Bug Fix: Dependency error for PHP, [see here](https://wordpress.org/support/topic/error-message-421)  

= 1.0.1 - 11th May, 2015 =
 * Bug Fix: Logic bug with users last online, it now correctly works out how many users were online in the past x hours

= 1.0.0 - 10th May, 2015 =
* Initial release