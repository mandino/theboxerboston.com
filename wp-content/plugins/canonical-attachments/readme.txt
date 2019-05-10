=== Canonical Attachments ===
Contributors: hivedigital, jblifestyles
Donate link: https://www.hivedigital.com/2017/01/19/canonical-attachments-in-wordpress/?utm_source=wordpress&utm_campaign=canonical-attachments&utm_medium=donate-link
Tags: canonical, attachments, canonical tags, canonicalize, pdf, doc, ppt, media, powerpoints
Requires at least: 4.5.1
Tested up to: 4.9.1
Stable tag: 1.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Get more information from analytics and higher rankings by utilizing canonical http headers in htaccess for non image media attachments like pdfs.
 
== Description ==

This plugin was developed to allow canonical tags to be created for attachment files such as pdfs and docs.

The plugin:

*   Generates an htaccess file to manage the wp-content/uploads directory where these files are being uploaded
*   Updates the htaccess file with canonical tags which are delivered via a header when the attachment is called
*   Creates a dashboard where you can easily filter and find attachments without canonicals or that are not attached to a post.
*   Creates a dashboard where you can easily attach a file to its parent post (one at a time or in bulk) or manually add/remove a canonical tag for a file
*   Allows you to add a canonical url from the media file in the library or when you upload
*   Creates a dashboard to edit the .htacess file directly for the uploads directory in case there are additional files in the directory that were uploaded outside of wordpress (e.g. during a site migration)

**The challenge:**  Analytics software such as Google Analytics, cannot track a user that enters a website via a pdf file in Google search results. Files cannot have a standard canonical tag added in the &lt;head&gt; and instead the canonical tag has to be added via an http header when the file is requested from the server. In order to accomplish this, we need to have an htaccess file listening for a request to that file, and then sending the header.

**Expected outcome:**  PDF files and other attachments will be replaced in search results with the post or page counterparts, and we will be able to measure the traffic to those pages and provide calls to action for downloading the file, submitting contact forms, etc. Note: Canonical tags do not force a search engine to index one url vs. another, but act as a guideline/request to the search engine. As long as the attachment content is similar to the canonical URL, you should have no problem encouraging the search engines to choose the correct version.
 
== Installation ==
 
This section describes how to install the plugin and get it working.
 
1. Search for "Canonical Attachments" from the Add Plugins page and click install
2. Alternatively: Upload `canonical-attachements.zip` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Enjoy!
 
== Frequently Asked Questions ==
 
= Will this work on wordpress installs that do not use apache server =
 
No.  This plugin only works for wordpress installations on servers running apache, as it is depending on writing the rules to the .htaccess file.
 
= Do I have to manually create the .htaccess file in the uploads directory? =
 
The plugin will need to be able to write to the directory in order to work.  When you install the plugin, it will create the .htaccess file with the proper permissions.

= What happens to the .htaccess file if I uninstall the plugin =
 
As there may be other items in the htaccess file that are important, uninstalling this plugin does not remove the .htaccess file.  You will have to do this manually.  It is important to note that uninstalling this plugin does not remove any content of the htaccess file.  If you wish to remove canonicals, you should use the bulk editor or manually edit the .htaccess file using the editor option.  When you remove by manually editing the htaccess file, the associations will still exist in the wordpress database as an option for that media item, but since they are not in the .htaccess file, they will be "useless". This is why it is recommended to use the bulk editor vs. editing htaccess directly.

= Why is there an option to edit the .htaccess directly? =

In some instances there may be files outside of wordpress's database that you wish to canonical, so we wanted to make it accessible for adding those items. The most likely case for this would be if you migrated to wordpress and manually moved a directory or files into the uploads folder vs. uplaoding through wordpress.  Future iterations of this plugin might include a way to better manage non wordpress linked media files.

= Some of my media files aren't attached to a post, what happened? =

This has nothing to do with our plugin, but occurs when you upload media files when you are not editing / creating a post.  The wordpress library has a filter for unattached media items, and you can attach them manually there.  Our editor does not require the media item be attached to a post, it just makes it possible to use the bulk feature to attach vs. having to do it one at a time. You can also use the post finder from the "attach media" option in our bulk editor.

= Who built this awesome plugin? =

This plugin was developed by the good folks at [Hive Digital](https://www.hivedigital.com/?utm_source=wordpress&utm_campaign=canonical-attachments&utm_medium=plugin-page "Awesome Digital Marketing Agency")
 
== Screenshots ==
 
1. Plugin dashboard with options for bulk editing or individual editing to create canonicals for attachment files, and easy filters to drill down to those files needing fixed!

2. Main page with options explained / highlighted

3. Editor page for the uploads .htaccess file

4. Media pages have an input field for the canonical URL

5. Option to enter canonical url when you upload a file

== Changelog ==

= 1.5 = 

* Bug Fix .. thank you @dglingren for pointing out the return $post issues
* Updated screenshots to highlight new functionality
* Shortcut to plugin settings / options page

= 1.4 =
* Bug Fix .. thank you @philippmuenchen for pointing this out!

= 1.3 =
* Added options to filter the main canonical page 
* Added options to attach/detach media to posts

= 1.2 =
* Security update for $_POST data

= 1.1 =
* Fixing function names with prefix
* More security updates
* Addressing issue with file location requests to allow for non-standard installs

= 1.0 =
* Polishing plugin for submission to wordpress repository
* Security Fix: Requiring nonces for form submissions

= .5 =
* Bug Fix: Delete canonical when media file is deleted
* Security Fix: Checks user permissions for access to bulk editing tools

= .1 =
* Initial plugin creation
 
== Upgrade Notice ==

= 1.2 =
This version addresses a security vulnerability.  Upgrade immediately.

= 1.1 =
This version addresses multiple security vulnerabilities.  Upgrade immediately.

= 1.0 =
This version has prettier code and addresses security issues. Upgrade immediately.

= .5 =
Fixes a bug that caused canonicals to remain in .htaccess despite the media file being deleted

== Future Features and Development == 

Based on the feedback, we hope to continue developing additional features to support user requests.  Current future feature ideas include:

* Automatic canonicalization of non-image files to attached post
* Integration with non-apache servers
* Canonical builder for non-wordpress media files
* Option to bulk delete canonical associations and delete htaccess on uninstall