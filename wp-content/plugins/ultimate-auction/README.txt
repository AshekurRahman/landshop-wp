=== Ultimate Wordpress Auction Plugin ===
Contributors: nitesh_singh
Donate link: http://auctionplugin.net/
Tags: auctions,auction,auction plugin,wp auction,wordpress auction,wp auctions,auction script,ebay,ebay auction,bidding
Requires at least: 4.6
Tested up to: 6.0.2
Stable tag: 4.1.7
License: GPLv2 or later

Awesome plugin to host auctions on your wordpress site and sell anything you want.

== Description ==

Ultimate Wordpress Auction plugin allows easy and quick way to setup auctions on your site.
Simple and flexible, Lots of features, very configurable.  Easy to setup.  Great support.


*   [PRO Theme - Create Your New Auction Site instantly &raquo;](https://getultimateauction.com)
&nbsp;

*   [PRO Plugin - Add Auction to existing site &raquo;](https://auctionplugin.net?utm_source=wordpress.org&utm_medium=link&utm_campaign=woo-auction-from-wp.org)


 = PRO Theme Features =
 
	1. Hold Bidding amount on Credit Card
	2. Credit Card Automatic Debit
	3. Timed Auction Events with Lots
	4. Whatsapp Notification
	5. Question & Answer
	6. Automatic or Proxy Bidding
	7. SMS Notification 
	8. Soft-Close or Anti-Sniping feature to extend time.
	9. Add Silent auctions
	10. Variable Increment
	11. Buyer's Premium
	12. Live Bidding without page refresh
	13. WPML and LocoTranslate Compatible
	14. Widgets - Expired, Future 
	15. Custom Emails
	16. Awesome Page Designs

 
 = PRO Plugin Features =

	1. Collect Credit Card and Automatically Debit Winning Amount
	2. Users can add auctions
	3. Automatic or Proxy Bidding
	4. SMS Notification 
	5. Soft-Close or Anti-Sniping feature to extend time
	6. Automatic and Manual Relisting of Expired Auction
	7. Add Auction for Future Dates.
	8. Add Silent auctions
	9. Variable Increment
	10. Buyer's Premium
	11. Reverse Bidding Engine
	12. Bulk Import
	13. Live Bidding without page refresh
	14. Delete User Bids
	15. Support Virtual Products
	16. WPML and LocoTranslate Compatible
	17. Widgets - Expired, Future 
	18. Custom Emails
	19. Many Shortcodes & Filters 

 = Free Plugin (Core) Features =
    1. Registered User can place bids 
	2. Ajax Admin panel for better management.
    3. Add standard auctions for bidding
    4. Buy Now option with paypal
    5. Upload multiple product images
    6. Show auctions in your timezone        
    7. Paypal ready payment settings
    8. Set Reserve price for your product
	9. Set Bid incremental value for auctions
	10. Ability to edit, delete & end live auctions
	11. Re-activate Expired auctions
	12. Email notifications to bidders for placing bids
    13. Email notification to Admin for all activity
    14. Email Sent for Payment Alerts
	15. Outbid Email sent to all bidders who has been outbid.
	16. Count Down Timer for auctions.
	17. Lightbox feature to display auction images
	18. Ability to Cancel last bid 
    and Much more...
	
 = Free Plugin Display Features =
    1. Auction feed Page which shows excertps of live auctions
    2. Pagination feature for feed page
    3. Auction Detail page via wordpress custom post
    4. Comments section for each auction page
	5. Send Private Message section for each auction page
	6. Tested with multiple Wordpress theme


== Installation ==

 = IMPORTANT = 

Please backup your wordpress database before you install/uninstall/activate/deactivate/upgrade Ultimate Wordpress Auction Plugin.

Manual Installation

1. Upload the `ultimate-auction` folder to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Visit Settings tab of the plugin and enter "payment settings" and general settings.

4. After you have setup your settings you can go to "Add Auction" tab to add your auction.

5. After you have added auctions, go to "Pages" inside your admin dashboard and add a new page.

6. Enter this text "[wdm_auction_listing]" as a shortcode inside this new page and publish it. 

7. If you have a Default Wordpress theme installed then the page you published (on step 6) will be accessible through top menu bar. NOTE: For Custom themes you would be required to add the page on top menu bar.

This page is responsible for displaying all live auctions. If you click a specific auction on this page, it'll open specific auction page where your visitors can place bids and perform all actions related to tht auction.

== Frequently Asked Questions ==

= Where can I get support or talk to other users? =

If you get stuck, you can ask for help in the [Ultimate Wordpress Auction Plugin Forum](https://wordpress.org/support/plugin/ultimate-auction/).

= Will this plugin work with my theme? =

This plugin has its own U.I which we have tested with few generic popular Wordpress themes. It should work with majority Wordpress supported theme, but may require some styling to make it match nicely. 

= Where can I request new features, eCommerce themes and extensions? =

You can write to us: nitesh@auctionplugin.net. 

= What shortcodes are available for this plugin = 
1. Shortcode to display auction listing

	[wdm_auction_listing]
	
	[wdm_auction_listing  sortby="title/date" order="asc/desc"]

	[wdm_auction_listing  type="expired" sortby="title/date" order="asc/desc"]
	

= What Hooks are available for this plugin = 
1) If you are going to add some custom text before "Bidding Form",this hook should help you. 

	ultimate_woocommerce_auction_before_bid_form
 
Example of usage this hook
 
	add_action( 'ultimate_woocommerce_auction_before_bid_form', 'here_your_function_name');
	function here_your_function_name() 
	{   
		echo 'Some custom text here';   
	}


= What Filters are available for this plugin = 

1) Bid Button Text

	wdm_ultimate_auction_bid_button_text

How to use this filter? 
Answer : Copy paste in your functions.php file of theme as per your requirement.

	add_filter('wdm_ultimate_auction_bid_button_text', 'your_function_name' );
		function your_function_name(){
			return __('Button Text', 'text domain');
		} 
		
For example:
	add_filter('wdm_ultimate_auction_bid_button_text', 'change_button_text' );
		function change_button_text(){
		return __('Submit Bid', 'abc');
	} 

-----------------------------------------------------------------


== Screenshots ==


== Frequently Asked Questions ==

== Changelog ==

= 4.1.7 =

1. Improvement - We have added changes in the footer to show the "Powered By Ultimate Auction" text.

= 4.1.6 = 

1. Fix - "Unsupported operand types: string + string" error comes with the PHP8. We have fixed it.

= 4.1.5 = 

1. Fix - "Cancel Last Bid" on Manage auctions page was not working. We have fixed this issue.

= 4.1.4 = 

1. Fix - Format specifier error with PHP8 was showing in following places. These have been fixed:
	(a) format specifier error comes in pagination on frontend(auction listing page).
	(b) Admin dashboard -> Ultimate Auction -> settings -> PayPal.
	(c) In email-template.php template file - Because this the winning email with PayPal payment, link was not sent properly.

= 4.1.3 = 

1. Fix - When the text was translated to language which had single quotes then such text were causing Javascript errors. We have fixed this issue. 

= 4.1.2 = 

1. Fix - Timezone Issue - We have changed the underlying function to see that the expiration happens properly based on the timezone set inside General Setting. 

= 4.1.1 = 
1. Fix - When the admin selects any time-zone from the WordPress setting, the plugin displays the appropriate start time and end time for the auction product. Changing the time zone will not make a difference to the countdown timer.

= 4.1.0 = 
1. Improvement - We have updated the points to set "Paypal Auto Return" url and it is now in accordance with the latest Paypal dashboard.

= 4.0.9 = 
1. Fix - Added a flag which will check if the emails are sent and would restrict multiple emails.

2. Fix - Subject field of the email can now have Apostrophe.

= 4.0.8 =

1. Fix - Plugin was affecting the design of WP Admin Dashboard. This has been fixed.

= 4.0.7 =

1. Fix - We have added two separate options for banner image: Dismiss and "Cross" button. Dismiss will remove it permanently and "Cross" button will temporarily hide it until the dashboard is reloaded.

= 4.0.6 =

1. Improvement - We have updated our plugin with security standards of Wordpress to avoid any CSRF/XSS issues. 


= 4.0.5 = 

1. New Feature - New parameter added in auction listing shortcode. Please check above FAQ section for its example.

2. New Feature - New filter added to change text for bid button. Please check above FAQ section for its example.


= 4.0.4 = 
* New Feature - New shortcode for listing expired auction has been added. Shortcode is [wdm_auction_listing type='expired']

= 4.0.3 =

* Fix - If Admin has selected "Without login user can bid" then Visitor can bid multiple times specifying name and email

= 4.0.2 = 

* New Feature - Plugin is now compatible with LocoTranslate plugin.
* Fix - Bidding was not working on Iphone's chrome and safari browser. 
* Fix - Added Tanzanian shilling currency. 

= 4.0.1 = 

* Fix - Localhost url supported to upload image or video at add auction.
* Fix - Plugin updated to support latest WP version 4.9.4. Deprecated functions removed and warning/notices have been fixed.

= 4.0.0 = 
* New Feature - Responsive UI for auction pages.

= 3.7.7 =
* Fix - Add auction wasn't working properly when Ultimate Auction -> Settings -> Auction -> Allow users to bid -> "Only if they are logged in" was configured. This has been fixed.

= 3.7.6 = 
* Fix - Dutch Translation Files updated by Alex


= 3.7.5 = 
* Fix - Plugin would only show comments which are approved by admin.


= 3.7.4 = 
* Fix - False Error while adding auction about empty title and description has been fixed.

= 3.7.3 = 
* Fix - Added UAE's currency support
* Fix - Fixed South African currency symbol issue 
* Fix - Fixed multiple emails problem.


= 3.7.2 = 
* Fix - Missing file "see-more-bidder.php" has been checked in to fix Manage auction section


= 3.7.1 =
* New Feature - Auction feeder and dedicated pages are made responsive.
* New Feature - Now Bid is retained if non logged is redirected to login.
* Fix - Localhost upload problem
* Fix - Usernames are now hyperlinked to show their emails inside Manage auction section.


= 3.4.0 = 
* New Feature - Deleting auction would delete its images too.
* New Feature - Manage Auction -> Expired auction -> Payment column would now highlight payment method for better readability.
* Fix - Description text would appear without HTML code.
* Fix - New layout for Settings tab and separate Payments tab to mention payment related details.


= 3.3.0 =
* Fix - Plugin comments conflicts with theme/site comments.
* Fix - Javascript code has been moved out in separate directory as it was previously posing problem with few wordpress themes.


= 3.2.0 =
* Fix - Warning message appearing under manage auction.


= 3.1.0 =
* Fix - Auction owner cannot place bid on his own auction
* Fix - Feed page overlap issue for few WP themes.
* Fix - Timer is now localized to be converted to local language.
* Fix - Popup message saying "ʺyou can be winner if you amount is close to buy nowʺ is now rectified to show at correct time.

 
= 3.0.0 = 

* Code Update to support Proxy Bidding Addon. One needs to buy Proxy Bidding Addon for free plugin or PRO version for it.
* Code Update to support Automatic Time Extension to avoid snipping. One needs to buy Proxy Bidding Addon for free plugin or PRO version for it.
* Fix - Feed Page Image is now displayed by scaling it ratio wise which does not squeeze or blur the image.
* Fix - Default Image when no images are loaded.
* Fix - Lightbox Image container is fixed for no images. Earlier empty container was shown.


= 2.0.2 = 

* Fix - Email Notification is not working for some wordpress site.
* Fix - Paypal link not proper for email clients like outlook.


= 2.0.1 = 

* Support for new Search feature - Plugin will integrate with Categories Addon to display categories and search box.
* Auction short description field - New field added inside "Add Auction" form. This field is responsible in displaying auction excerpts (1 or 2 lines about auction) on feed page. Prior to this, 
* All prices on front end would display decimal values upto 2 places.
* Bug - Fix provided for HTML Editor for auction description to accept new line characters.
* Bug - Email Sent via plugin would have sender name as website name.

= 2.0.0 = 
* Plugin now supports Category Addon - If you want category feature then you need to buy category addon.
* Added Countdown timer for auctions.
* Breadcrumb added for dedicated auction.
* Bid Now button added on feed page.
* Lightbox feature to display auction images


= 1.0.5 = 
* HTML editor added for Product description field.
* Bulk delete feature added for Manage Auction.
* Feed page Shortcode Issue resolved: Use your own text below and above shortcode.
* Resolved plugin conflicts: Renamed common variables which causes issues with other loosely coded plugins.
* Bug Resolved pertaining to End Auction when 2 bidders are competing for auction till last minute.


= 1.0.4 = 
* Outbid Email which sends emails to all existing bidders that you have been outbid
* Code to integrate with Shipping Cost Addon. This lets you add shipping cost in auctions.


= 1.0.3 = 
* Decimal Pricing is now possible. 
To make this work: Update your plugin to 1.0.3 & then deactivate & re-activate the plugin. 


= 1.0.2 = 
* Pagination bug resolved


= 1.0.1 =
* New Feature added where only registered users can place bids
* Major CRLF bug resolved


= 1.0.0 =
Alpha Launch