=== WooCommerce PDF Invoices, Packing Slips, Delivery Notes & Shipping Labels ===
Contributors: webtoffee
Version: 4.4.3
Tags: woocommerce invoice, woocommerce invoice generator, woocommerce send invoice, woocommerce invoice email, woocommerce receipt plugin, woocommerce vat invoice, woocommerce pdf invoices, print shipping label, woocommerce custom invoice, Packinglist, Invoice printing, Shipping, Wordpress
Requires at least: 3.0.1
Requires PHP: 5.6
Tested up to: 6.0
Stable tag: 4.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WooCommerce PDF Invoices, Packing Slips, Delivery Notes & Shipping Labels

== Description ==

== Screenshots ==

== Changelog ==

= 4.4.3 =
* [New] - Added value-based review seeking banner
* [New] - Added a separate page for the addons promotions
* [Tweak] - Added tax column option in credit note template
* [Tweak] - Added more placeholders such as the number of items and package number to the packaging document templates
* [Enhancement] - Improved the address label customizer to control the styles from the layout properties itself
* [Enhancement] - Improved Invoice number generation using the action scheduler when a high number of orders need to get the invoice number
* [Enhancement] - Added a few new templates in the shipping label document, and improved all the templates in all the documents
* [Compatibility] - Added extra product option compatibility for the packaging documents
* [Compatibility] - With WC up to v6.9.2

= 4.4.2 =
* [New] - Added the tool to delete/reset the invoice number into the WooCommerce Tools list
* [New] - Add the show print button option pagewise
* [New] - Added the QR Code addon plugin promotion tab when the QR code add-on is not installed/activated
* [New] - Changed the UI of the home screen of the plugin
* [New] - Added prompt when leaving the dynamic customizer without saving the template
* [Tweak] - Added filter to handle overlapping the footer with the product table when long footer content is used
* [Tweak] - Changed the UI of the Save button bar in the dynamic customizer
* [Enhancement] - Improved the order meta listing using autocomplete method in the dynamic customizer
* [Enhancement] - Rearranged the fields and added an option to see the instant preview of the invoice number when changing the settings
* [Enhancement] - Added tax display option to the proforma invoice, dispatch label and credit note modules
* [Compatibility] - with WC v6.6 and v6.7

= 4.4.1 =
* [Fix] - Solved the memory exhausted issue in wordpress admin dashboard

= 4.4.0 =
* [Enhancement] - Added the option to add the QRcode on the invoice using QR Code Add-on for WooCommerce PDF Invoices by webtoffee
* [Enhancement] - Added QR code placeholders in all the invoice templates
* [Enhancement] - Updated the UI - Changed the radio buttons to checkboxes
* [Enhancement] - Updated the UI of the filter listing screen
* [Enhancement] - Added preview images for the tax option on the invoice settings page
* [Enhancement] - Combined all the default tax-related meta keys (vat,vat_number,eu_vat_number) into one meta key named as "VAT"
* [Enhancement] - Made the order meta fields (billing_phone, ssn, vat, and customer_note) be selected by default
* [Enhancement] - Added placeholder and option to show/hide the package numbers in shipping label, delivery note, and packing list templates.
* [Enhancement] - Show the product details and weight after the refund on the packing slip, delivery note, and shipping label
* [Fix] - Get the formatted order number instead of the order id for the invoice pdf file name
* [Fix] - Hide the border of the empty column when loading the templates in the dynamic customizer
* [Fix] - Shows the assets when clicking on empty columns in the dynamic customizer
* [Fix] - Solved the package weight issue in the shipping label document
* [Compatibility] - with WC v6.5
* [Compatibility] - with WP v6.0

= 4.3.5 =
* [Enhancement] - Added additional controls to address label customizer
* [Enhancement] - Added the document title in the delivery note and packing slip templates and added the controls to customize it in their customizer properties
* [Enhancement] - Improved the language translations
* [Fix] - Solved the conflict with the WooCommerce status manager plugin
* [Fix] - Solved the credit note number issue
* [Fix] - Solved the payment instruction showing twice on checkout page and order mail templates when using the pay later option
* [Fix] - Solved the Bold letter issue of product names in the invoice product table when using the MPDF
* [Compatibility] - with WC v6.2 and v6.3

= 4.3.4 =
* [Enhancement] - Fixed footer in the invoice templates
* [Enhancement] - Added an option to search the filter
* [Enhancement] - Added system configuration screen
* [Enhancement] - Improved the styles of dynamic customizer
* [Enhancement] - Improved the language translations
* [Tweak] - Changed the date format into m-d-Y in all the document templates
* [Tweak] - Made shipping address to be compatible with dynamic customizer
* [Fix] - solved the issue of altering the packing slip and picklist separate email template
* [Fix] - Solved the total tax column issue when using different tax rate products
* [Fix] - Solved the issue of returning zero when customer note is empty
* [Compatibility] - with WC v6.1
* [Compatibility] - with WP v5.9

= 4.3.3 =
* [Enhancement] - Added persian language translation
* [Tweak] - Added filter to alter the name and price of the product when it is deleted or not available
* [Fix] - Invoice number generation issue with respective the timezone
* [Fix] - Credit note generated with the original variable order_item
* [Fix] - Saving the address label template issue
* [Fix] - Solved the issue of credintnote printnode button in order details page
* [Compatibility] - with WC v6.0

= 4.3.2 =
* [Enhancement] - Added an option to not generate the invoice for the old orders which are created already before the installation of plugin
* [Enhancement] - Changed the home screen of plugin
* [Enhancement] - Added the warning bar to show the status of license if it is expired or not activated
* [Enhancement] - Made the company logo as default option instead of company name and moved the footer to the bottom of the invoice templates
* [Tweak] - Changed the get_line_subtotal() to get_line_total()
* [Fix] - Solved the shipping amount issue when including the tax
* [Fix] - Solved the private variable issue when using the printnode
* [Compatibility] - with WC v5.9

= 4.3.1 =
* [Enhancement] - Added filters of print node in credit note
* [Tweak] - Added filter to alter the print button in credit note and dispatch label
* [Fix] - Solved the syntax error issue in payment link
* [Compatibility] - with WC v5.8

= 4.3.0 =
* [Enhancement] - Added dynamic customizer for invoice templates
* [Enhancement] - Added review seeking banner
* [Enhancement] - Sort the invoice number column in order listing page
* [Tweak] - Added shipping phone number to make compatible with WC v5.6
* [Fix] - Inserting the table to the respective site in case of using multisite
* [Fix] - Solved the warning message regarding the backward version property on payment link
* [Compatibility] - with WC v5.7

= 4.2.1 =
* [Enhancement] - Improved the credit note by showing the refunds on separate pages
* [Enhancement] - Added option to use the latest settings for the invoice
* [Enhancement] - Added option to show the payment link in the invoice
* [Tweak] - Updated the invoice templates to be compatible with the payment link
* [Tweak] - Added document title in the invoice templates (Classic and Modern)
* [Tweak] - Added option to show the print dispatch label button in the order received mail
* [Tweak] - Added the document links with respective help texts
* [Tweak] - Search the order using invoice number
* [Tweak] - Added option to alter the creditnote date format
* [Fix] - Show the deleted products in the invoice
* [Fix] - Sorting the product as per in the order edit page(By default)

= 4.2.0 =
* Compatible with Extra product options (themecomplete)
* Added tax columns in dispatch label and proforma invoice templates
* [bug fix] – Non numeric value error when printing the invoice, packingslip
* [Improvement] Styles in invoice templates
* [bug fix] - Solved the mismatch issue of line total and credit amount in creditnote

= 4.1.9 =
* Compatible with WOOCS - WooCommerce Currency Switcher
* Compatible with Multi Currency for WooCommerce
* Added option to disable the generating of invoice for free orders
* Added option to display/hide the free line items in invoice
* Added option to customize the pdf file name for invoice
* Added option to group the items by category in proforma invoice
* Added order statuses in print node
* Added tax column in credit note template

= 4.1.8 =
* Licence manager updated
* Check okay with WP 5.7

= 4.1.7 =
* [Bug fix] Name in address block is at bottom (For customers who are using old templates)
* [Bug fix] Showing empty placeholder for customer note

= 4.1.6 =
* Check okay with WC 5.1
* Improved WPML compatibility
* Added compatibility for Bundled product plugins. Woocommerce Product Bundles, YITH WooCommerce Product Bundle add-on.
* Template updates for Invoice (3 new templates)
* Improved Compatibility with DHL plugin.
* Doc title customization option added in Invoice
* Individual tax/ Total tax display options with filters added
* Individual placeholder compatibility added for addresses (So blocks of addresses can rearrange via HTML code editor)
* [Improvement] If current active PDF library is not found then automatically switch default one. (Previously showing a warning message)
* [Improvement] WC not exists message added. (Previously the plugin will just stop working)

= 4.1.5 =
* Added compatibility for PHP8
* Checked okay with WP 5.6
* Check okay with WC 4.9
* Improved WPML compatibility
* [Bug fix] Wrong quantity on Picklist when packaging is selected as Pack items individually
* [Bug fix] Product does not exist error on non package documents
* [Bug fix] Subtotal calculation issue

= 4.1.4 =
* Tested okay with WC 4.8 
* Tested okay with WP 5.6
* [Bug fix] Items missing in Picklist while bulk printing when sorting is enabled.
* [Bug fix] Not showing meta with same display key

= 4.1.3 =
* Option added to sort Product table in documents. By SKU, Product name.
* Image column added in Picklist
* [Bug fix] Print button missing in Shipping label

= 4.1.2 =
* Bug fix to version 4.1.1. Missing some meta items.
* Improved translation (Spanish)

= 4.1.1 =
* Style customization option added in address label
* Border customization added in shipping label
* Template translation improved
* Automatic address update from Woo added
* Tested okay with WC 4.7

= 4.1.0 =
*  [Improvement] Product attribute option added to applicable documents
*  [Improvement] Edit/Delete option added for Product Meta, Order meta, Product attribute
*  [Improvement] Print button added in My account order listing page.
*  [Improvement] PDF download option added for customers.(Invoice, Pro-forma Invoice)

= 4.0.9 =
*  [Improvement] Added cloud print option
*  [Improvement] Enhanced RTL support enabled with mPDF addon
*  [Improvement] Multiple PDF library support added
*  [Improvement] New filter added to toggle email/my account print buttons
*  [Improvement] Showing custom checkout field values in order detail page
*  Tested OK with WP 5.5.1
*  Tested OK with WC 4.5

= 4.0.8 =
*  [Improvement] Separate Email option(trigger automatically based on settings or manual) added for Packinglist and Picklist.  
*  [Improvement] Email attachment option added for Packinglist and Picklist
*  [Improvement] Order by category option added in invoice
*  [Improvement] Italian language files added
*  [Improvement] Sequential order number compatibility in orders listing section of Picklist.
*  [Improvement] New filters added to documentation. And add_filter section added to code example block.
*  [Bug fix] Print button missing in email and MyAccount->Ordres, for WooCommerce latest version
*  [Bug fix] Meta duplicate comparison fails when string contains some ascii values.
*  [Bug fix] Duplicate entries on picklist when group by category/order are not enabled.
*  [Bug fix] Network error issue while downloading PDF in some cases
*  [Bug fix] Broken PDF when multiple attachment on same mail
*  [Bug fix] Col span issue when some table columns are hidden



= 4.0.7 =
*  New filter wf_pklist_alter_print_margin_css added to alter print margin
*  New filter wf_pklist_alter_print_css added to alter print css
* [Bug fix] Extra line break within product table when variation data, product meta are empty
* [Bug fix] Product variants merged in picklist
* [Bug fix] Duplicate Meta data in certain cases for meta added via third party addons
* [Bug fix] Activation conflict with basic plugin

= 4.0.6 =
* Drop down menu converted from clickable to hover in edit order page
* [Bug fix] Total price excluded in price filter
* Restricted direct access of upload directory


= 4.0.5 =
* [Improvement] Included options for delete/download/scheduled delete of the temp files
* [Improvement] PDF option introduced for all documents
* [Improvement] Email attachment option added for proforma invoice
* [Improvement] Form validation improved
* [Improvement] Blocked all third party script tags from the HTML template for better security.
* [Improvement] Reduced temp storage
* [Improvement] Limited user capability for saving HTML document to only admins and shop owners
* [Improvement] New public filter added to alter order packages `wf_pklist_alter_order_packages`
* [Improvement] PHP 7.4 compatibility
* Tested OK with WooCommerce 3.9

= 4.0.4 =
* Introduced Proforma invoice
* Introduced Credit note
* Tested OK with Wordpress 5.3

= 4.0.3 =
* Introduced Pick list
* Optimized the PDF size to KBs
* Included option for watermarking with custom text
* Included option to edit/delete checkout fields
* [Bug fix] Image not found issue within customizer
* [Bug fix] Issue with Preview PDF for refunded orders
* [Bug fix] Missing Variation data
* Added new filter to alter the generated file for print/PDF, wf_pklist_alter_pdf_file_name
* Compatibility with Sequential order number


= 4.0.2 =
* Tested OK with WooCommerce 3.7
* PDF preview option added.
* Copy address from woocommerce option added.
* Tax column option in invoice product table.
* Bug fix and usability improvements. 

= 4.0.1 =
* [Bug fix] Email attachment missing for admin orders
* [Bug fix] Non alphabet character issue in additional checkout fields
* [Bug fix] Fixed PDF invoice template bug 

= 4.0.0 =
* UI/UX improvements
* Improved Performance
* Improved RTL support
* Improved WPML support
* Reduced plugin size


= Contact Us =
Support: https://www.webtoffee.com/category/documentation/print-invoices-packing-list-labels-for-woocommerce/
Or make use of questions and comments section in individual product page.

== Installation ==
https://www.webtoffee.com/how-to-download-install-update-woocommerce-plugin/


== Tutorial / Manual ==
https://www.webtoffee.com/product/woocommerce-pdf-invoices-packing-slips/

== Upgrade Notice ==

= 4.4.3 =
* [New] - Added value-based review seeking banner
* [New] - Added a separate page for the addons promotions
* [Tweak] - Added tax column option in credit note template
* [Tweak] - Added more placeholders such as the number of items and package number to the packaging document templates
* [Enhancement] - Improved the address label customizer to control the styles from the layout properties itself
* [Enhancement] - Improved Invoice number generation using the action scheduler when a high number of orders need to get the invoice number
* [Enhancement] - Added a few new templates in the shipping label document, and improved all the templates in all the documents
* [Compatibility] - Added extra product option compatibility for the packaging documents
* [Compatibility] - With WC up to v6.9.2