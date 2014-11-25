Installation of SEO - Header Tags Reloaded - v2014.04.10
========================================================

Pre-Pre Step
============
Before you do anything, make a full backup of your site, including your database!


Pre Step
========
Determine if you are using "normal" osCommerce or "bootstrap" osCommerce.  If you are
unsure, post your URL at http://forums.oscommerce.com/topic/394978-seo-header-tags-reloaded-support/
and someone will let you know.


Step 1.
=======
Load the SQL changes using PHPMyAdmin or similar (this is found in your hosting control panel)


Step 2.
=======
If you are using "normal" osCommerce
------------------------------------
Upload or Merge the files in normal_osCommerce/catalog/ to your site.

If you are using "bootstrap" osCommerce
---------------------------------------
Upload or Merge the files in bootstrap_osCommerce/catalog/ to your site.

In either case, bear in mind these things;

a.  If you have a modified bootstrapped osCommerce you should MERGE the files taking extra care not to overwrite your existing files.
b.  You might have renamed your admin folder to something different than "admin"
c.  Your site might not be installed in /catalog/

Step 3.
=======
Install the modules you require to use.  Admin > Modules > Header Tags

Step 4.
=======
Create your content (mainly done in admin/categories.php when adding/editing a product)


Get this installed.
===================
If you require a quotation to have this addon installed from start to finish, doesn't matter if your site is brand new or modified
or even if it has one of the other SEO addons installed...contact me via the Forum: http://forums.oscommerce.com/user/69-burt/




--
To your success
Gary







Version History
===============

2013 07 25
----------
- Initial Release

2013 11 12
----------
- Removal of Twitter Cards (now included in Core osCommerce)
- Removal of Adwords Conversion (now included in Core osCommerce)
- Removal of ht_product_og_facebook (replaced by ht_product_opengraph)
- Addition of ht_product_opengraph
- Addition of category description output in index.php
- Addition of manufacturer description output in index.php

2013 11 17
----------
- Fixed error in index.php (display of manufacturer description)
- Addition of SEO given names in Breadcrumb Output (amendments in /includes/application_top.php)

2013 11 19
----------
- addition of G+ Publisher Header Tag Module

2013 12 02
----------
- update to ht_product_opengraph module (change of some keys, eg:  og:price:amount is now product:price:amount)

2014 01 10
----------
- update to ht_product_opengraph module (addition of check for product_seo_title and show it if exists, addition of global product_check), affected files:
>> includes/modules/header_tags/ht_product_opengraph.php
- reintroduction of Twitter Cards (addition of check for product_seo_title and show it if exists, addition of global product_check)
- add missing text constant for product_reviews_info.php, affected files:
>> includes/languages/english/product_reviews_info.php
- replace product name with product_seo_title in product_info.php, affected files:
>> product_info.php

2014 02 10
----------
- addition of new OPTIONAL HT module for Information Pages - courtesy of Joli1811 - see below
- add nullif to all COALESCE statements to solve a display problem when contents are not exactly NULL but just blank, affected files:
>> includes/application_top.php
>> includes/functions/general.php
>> includes/modules/header_tags/ht_product_opengraph.php
>> includes/modules/header_tags/ht_twitter_product_card.php
>> product_info.php


2014 04 10
----------
- addition of bootstrap enabled files
- add missing language define:
>> normal_osCommerce/catalog/includes/languages/testimonials.php


2014 11 24 Cluster Solutions
----------------------------

- Primary remove functionalities that weren't header tag or bootstrap
  related. Also, update files to OSC2.3.4-BS.


Optional Extras
===============

HT Module now included for Information Pages courtesy of Joli1811
-----------------------------------------------------------------

http://addons.oscommerce.com/info/1026

You need to already have the Information Pages addon installed, then overwrite three files, run
the SQL file, upload the HT module and turn it on.  Everything needed is in the extra_uploads folder.
This is not a part of the standard SEO package, but is included as an optional extra.

