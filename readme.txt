=== Twitter Search Widget ===
Contributors: frankieroberto
Tags: twitter, widget
Requires at least: 2.8
Tested up to: 2.9.1
Stable tag: 0.3.3

This plugin makes a widget available which will display the most recent tweets containing your search term.

== Description ==

This plugin adds a Twitter Search widget. 

== Installation ==

Install this plugin in the usual way, by downloading and unzipping the folder into your plugins directory (/wp-content/plugins).

The plugin then needs to be activated before it can be used.

To use, simply drag the 'Twitter Search' widget into a sidebar. To use the widget, your theme must be widget-enabled.

== Frequently Asked Questions ==

= How do I style the widget? =

You can style the list of 'tweets' by adding the following code to the style.css file in your chosen theme:

    /* Styles for Twitter Search Widget */
		#sidebar .widget_twitter_search ul {}  /* Style for tweet list */
		#sidebar .widget_twitter_search ul li {} /* Style for an individual tweet */
		#sidebar .widget_twitter_search ul li:before { content: '';} /* Style for content inserted at beginning of tweet */

== Screenshots ==

1. Widget editing interface.
2. How the widget appears in the default theme.

== Changelog ==

= 0.1 =
* Initial upload

= 0.2 =
* General security enhancements
* Improved documentation

= 0.3.0 =
* Removed language param from Twitter search URLs - this seems to be broken.

= 0.3.1 =
* Updated documentation

= 0.3.2 =
* Minor fix.

= 0.3.3 =
* Added default widget title