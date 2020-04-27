=== Awaken ===

Contributors: Pubudu Malalasekara
Requires at least: 4.2
Tested up to: 5.2.2
Requires PHP: 5.2
Stable tag: 2.2.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This theme is based on _s by automattic. (http://www.underscores.me)

== Description ==
Awaken WordPress theme is an elegant magazine/news WordPress theme. It has a magazine layout with two main widget areas. And the theme is featured with three post widgets to display posts in different styles. This theme consists with a responsive layout which is created using twitter bootstrap. Some of the main features of this theme are theme customizer, featured slider, ad widgets, youtube video widget and social media. Find more information about this theme at http://www.themezhut.com/themes/awaken. View the demonstration at http://www.themezhut.com/demo/awaken.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.
4. Go to Appearance > Customize to customize your theme.

== Frequently Asked Questions ==

= 1. How to create the Magazine Homepage? =

Go to Pages > Add New in the WordPress Dashboard
Give it a name whatever you want. eg : Home.
Then from the page attributes options box select the Template as Magazine Template.
Then Go to Settings > Reading in the WordPress Dashboard and select the option a static page which is under the heading “Front Page Displays”.
Then Select the page that you created from the “Front Page” drop down . eg: Home

= 2. How to add a blog post page when magazine homepage is activated? =

Go to Pages > Add New in the WordPress Dashboard
Give it a name whatever you want. eg : Blog.
Then from the page attributes options box select the Template as Default Template.
Then Go to Settings > Reading in the WordPress Dashboard and select the option “A static page” which is under the heading “Front Page Displays”.
Then Select the page that you created from the “Blog Page” drop down . eg: Blog.

= 3. How to make my theme look like the demo? =

First of all create a magazine homepage as described above.

Magazine Template consists with 2 widget areas.
1. Magazine 1
2. Magazine 2

And there are 3 posts widgets.
1. Awaken: Three Block Posts Widget.
2. Awaken: Two Block Posts Widget.
3. Awaken: Single Category Posts Widget.

Drag and drop these widgets to above two widget areas and arrange them as you like.

== Changelog ==

= 2.2.3 =
* Added wp_body_open() function into header.
* Used h2 tag for screen-reader-text instead of h1 tag for better SEO.

= 2.2.2 =
* Changed readme.txt as per WPTRT requirements.

= 2.2.1 =
* Fixed an issue in editor-blocks.css

= 2.2.0 =
* Added Gutenberg Support

= 2.1.9 =
* Updated Popular Posts, Comments, Tags widget to display only approved comments.
* Used (document).ready() method instead of (window).load() method for slider.

= 2.1.8 =
* Renamed widget control "Hide sticky posts" to "Ignore sticky posts".
* Changed HEADER_TEXTCOLOR to use add_theme_support('custom-header).

= 2.1.7 =
* Added theme starter content support.
* Added customize selective refresh support for widgets.
* Changed sidebar widget title <h2> tags to <h3>

= 2.1.6 =
* Fixed structured data errors showing on Google search console report.

= 2.1.5 =
* Fixed a issue in navigation for RTL language.
* Modified widgets for customizer display.
* Added slider support for magazine template.

= 2.1.4 =
* Added the WordPress default date formatting support for posts widgets.

= 2.1.3 =
* Added woocommerce 3.0 support.

= 2.1.2 =
* Added woocommerce support.
* Added awaken.pot file in addition to default.po file.

= 2.1.1 =
* Quick fix for the slider issue.

= 2.1.0 =
* Fine tuned the slider.

= 2.0.9 =
* Changed slider h1 tags to h3.
* Passed fonts url to editor stylesheet.
* Added some stylings to the search form.

= 2.0.8 =
* Changed widget post titles <h1> tags to <h3>
* Changed blog listing titles <h1> tags to <h2>
* Fixed undefined variable issue in magazine widgets.
* Added the previously removed theme section again to the customizer.

= 2.0.7 =
* Added "header ad" widget area to header.
* Added a checkbox to show/hide search box on navigation. ( Appearance > Customize > General Settins. )
* Updated font awesome font.

= 2.0.6 =
* Removed old theme filtering tags and added new tags.

= 2.0.5 =
* Added a method to display sticky posts for the two featured posts that are just next to the slider.

= 2.0.4 =
* Removed checking useragent for html5shiv and used wp_script_add_data instead.
* Removed unwanted file_exists check for admin-config.php.

= 2.0.3 =
* Changed archive title for categories and tags.
* Fixed Google Plus icon not displaying issue.

= 2.0.2 =
* Fixed a issue in get_theme_mod in footer.php

= 2.0.1 =
* Added backward compatibility for title tag.

= 2.0.0 =
* Removed the Awaken Options Panel.
* Added options and settings to the theme customizer.
* Added a theme info page.
* Updated the default.po file.
* Added title tag support.

= 1.1.3 =
* Fixed some translation issues. 
* Fixed some issues in comments activate deactivate methodology.

= 1.1.2 =
* Fixed some small issues in html validation.

= 1.1.1 =
* Fixed a coding issue. ( Undefined index in slider )

= 1.1.0 =
* Added switches to on or off comments and comment forms in posts and pages.

= 1.0.9 =
* Added post options section to awaken options panel.

= 1.0.8 =
* Added Right to left language support to the theme.

= 1.0.7 =
* Added Editor Stylesheet to the theme.

= 1.0.6 =
* Added linkedin social link to the header.

= 1.0.5 =
* Changed slider locations.

= 1.0.4 =
* Changed files calling method (__FILE__ to get_template_directory())

= 1.0.3 =
* Added a method to remove footer credit links.

= 1.0.2 =
* Fixed a issue in featured slider.

= 1.0.1 =
* Fixed a issue in mobile menu.
* Added social media feature.
* Changed redux framework embeded option to plugin option.

= 1.0.0 =
* Initial Release

== Resources ==

External resources linked to the theme. 
* Source Sans Pro Font by Paul D. Hunt http://www.google.com/fonts/specimen/Source+Sans+Pro
  Licensed under SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
  
* Ubuntu Font by Dalton Maag https://www.google.com/fonts/specimen/Ubuntu
  License - http://font.ubuntu.com/ufl/ubuntu-font-licence-1.0.txt

* Oswald Font by Vernon Adams https://www.google.com/fonts/specimen/Oswald
  Licensed under SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL
  Dalton Maag

Resources packed within the theme. 
* Underscores (_S) starter theme by automattic Inc is licensed under GNU GPL. https://github.com/Automattic/underscores.me/blob/master/license.txt
* FontAwesome.
  Font Awesome is fully open source and is GPL friendly. http://fortawesome.github.io/Font-Awesome/license/
* Bootstrap by twitter.
  Bootstrap is Licensed under the MIT License. https://github.com/twbs/bootstrap/blob/master/LICENSE.
* FlexSlider by woothemes.
  FlexSlider is Licensed under the GPLv2 license. http://www.gnu.org/licenses/gpl-2.0.html
* HTML5 Shiv @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed
* Redux Framework by reduxframework.com licensed under the GPLv3 license https://github.com/ReduxFramework/redux-framework/blob/master/license.txt
* TGM Plugin activation library by Thomas Griffin is licensed under the GPL-2.0 or later license.http://tgmpluginactivation.com/#license
* Other custom js files are our own creation and is licensed under the same license as this theme. 
* Images in the screenshot *
	Image 1 - http://pixabay.com/en/urban-people-crowd-citizens-438393/
	Image 1 - License - http://creativecommons.org/publicdomain/zero/1.0/deed.en
	
	Image 2 - http://pixabay.com/en/taxi-cab-taxicab-taxi-cab-new-york-238478/
	Image 2 - License - http://creativecommons.org/publicdomain/zero/1.0/deed.en
	
	Image 3 - http://pixabay.com/en/girl-summer-sun-stroll-sunset-380621/
	Image 3 - License - http://creativecommons.org/publicdomain/zero/1.0/deed.en
	
	Image 4 - http://pixabay.com/en/keyboard-apple-input-keys-hardware-338505/
	Image 4 - License - http://creativecommons.org/publicdomain/zero/1.0/deed.en
	
	Image 5 - http://pixabay.com/en/live-concert-concert-stage-people-455762/
	Image 5 - License - http://creativecommons.org/publicdomain/zero/1.0/deed.en

 Image used for default placeholder thumbnail creation.
 	- http://pixabay.com/en/photo-lens-lenses-photographer-old-256888/
 	- License - http://creativecommons.org/publicdomain/zero/1.0/deed.en
 
 Image used for default 300x250 placeholder image creation.
	- http://pixabay.com/en/urban-people-crowd-citizens-438393/
	- License - http://creativecommons.org/publicdomain/zero/1.0/deed.en 	

All other resources and theme elements are licensed under the [GNU GPL](http://www.gnu.org/licenses/old-licenses/gpl-2.0.html), version 2 or later.