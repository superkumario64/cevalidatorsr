=== CeValidationsr ===
Contributors: rjoseph
Tags: cevalidation, cediploma, cecredentialtrust
Requires at least: 3.0.1
Tested up to: 5.8.3 (recommended)
Stable tag: 4.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

CeValidationsr is a first-effort example of how to call the CeCredentialTrust.com Web API to validate a student credential with optional ScholarRecord(tm)
(experimental at present)

== Description ==

Major features in CeValidationsr include:

* Allows for supplied implementation details to be entered in the Admin dashboard settings form.
*
PS: You'll need a set of API keys and values to actually validate a credential (examples provided below are for 'Sample University' sandbox testing)

== Installation ==

1\. A development environment is highly recommended
2\. Backup your settings prior to installation.
3\. Using Wordpress Dashboard, upload 'cevalidationsr.zip' (will deploy to the '/wp-content/plugins/' directory)
4\. Activate the plugin through the 'Plugins' menu in WordPress
5\. Enter your institution's Paradigm-supplied API values under the Admin Dashboard Settings -> CeValidationsr Settings menu option
6\. Place [cevsrform] shortcode on a page you would like to host the CeValidationsr

== TEST Implementation Notes ==
* TEST ClientId = '80DBC6A0-6CCF-4BA3-AAD8-89B2AE22FFA9'

TEST Sample Student values to test the validation.
* CeDiD = '1628-A38C-J8E8'
* Name = 'Jonathan Sample Name' (for reference)

== Notes: ==
You may encounter an issue with a truncation of the response data returned back from our service due to your PHP configuration.
Try adding/editing the following settings in your .htaccess file (if you're on Apache) to the sizes you need with a File Manager.
Example settings:

`php_value upload_max_filesize 64M`
`php_value post_max_size 64M`
`php_value memory_limit 64M`

= If your Wordpress site already employs Twitter Bootstrap v3.3.x in its main theme, you can potentially comment out the code for 'bootstrap3jscdn': =

Open the ../wp-content/plugins/cevalidationsr/public/class-cevalidationsr-public.php file and comment out the code for 'bootstrap3jscdn' under the public function function enqueue_scripts()


== Frequently Asked Questions ==

= What if I want to use the shortcode on a page/post/widget/??? that doesn't have a heading placeholder? =

Open the ../wp-content/cevalidationsr/public/cevalidationsr-form.php file and uncomment the code for the heading.


== Screenshots ==

1. none

== Changelog ==

= 1.0 =
*Release Date - 12 May 2019*

* Initial version

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`