=== Chocolate-lite Wordpress Theme ===
Author: zwwooooo & schiy
Tags:brown,white,translation-ready,custom-menu,threaded-comments,two-columns,fixed-width,right-sidebar,theme-options
Requires at least: 3.0.0
Tested up to: 3.1.2


== Description ==
This theme designed by schiy,functioned by zwwooooo. It is a simple style theme without any plugin needed (support plugin WP-PageNavi,WP-PostViews,wp-utf8-excerpt,WP-RecentComments),custom-menu,widgets,threaded-comments. For WordPress version 3.0+.

For questions, comments or bug reports, please go to
http://zww.me/archives/25435

= License =
GNU General Public License
http://www.gnu.org/licenses/gpl-2.0.html


== Installation ==

= Via WordPress Admin =
1. From your sites admin, go to Themes > Install Themes
2. In the search box, type 'Chocolate-lite' and press enter
3. Locate the entry for 'Chocolate-lite' (there should be only one) and click the 'Install' link
4. When installation is finished, click the 'Activate' link

= Manual Install =
1. Unzip this file into your mywebsite.com/wp-content/themes/ directory, should look like mywebsite.com/wp-content/themes/chocolate-lite/
2. Go into your Wordpress Admin, navigate to 'Appearance > Themes'
3. Find the Chocolate-lite listing on this page and click 'Activate'

= Note =
* Recommendation not to split the nav menu in more in rows.

== Changelog ==

= 1.0.9 =
* Fix: parameter errors (function chocolate_options_validate()).

= 1.0.8 =
* Add recommended functionality: add_custom_background();
* Remove sidebar 125AD func.
* comments style tiny change
* Remove css attributes "font:inherit": Fixed such as 'strong' tags failures.

= 1.0.7 =
* Add recommended functionality: add_editor_style().
* Fix: RSS icon in all_icon.png.
* Modify some CSS attributes.

= 1.0.6 =
* Add links to post-thumbnails.
* Standardized some code and css.

= 1.0.5 =
* Fix: the name of categories display correctly when a post related to multiple categories
* Remove the sticky post's remind text "TOP!"
* Use ignore_sticky_posts instead caller_get_posts, because the caller_get_posts argument for WP_Query() has been deprecated

= 1.0.4 =
* Fix: "A single post with no title does not allow you to get to it via the front page"
* Fix: PHP Notice "Undefined offset"
* "mytheme_comment" rename to "chocolate_mytheme_comment", "z_related_posts" rename to "chocolate_related_posts"
* use http://meyerweb.com/eric/tools/css/reset/ for the css reset

= 1.0.3 =
* Fix: "Undefined index" php error.
* Fix: Screenshot.png size: 300*225
* Fix: remove "The gallery has a dt width: 120px" css property
* Fix: "A really long menu overlaps the other header content"
* Remove: Comment smilies ( because reviewner said "do not show up I just got :idea: showing." - orz )
* Remove "!function_exists('dynamic_sidebar')" in sidebar.php
* Fix: a floated image and no text the bottom doesn't have padding
* Add title attribute on the page title

= 1.0.1-1.0.2 =
* Fix few bugs

= 1.0.0 =
* Chocolate-lite Released.
