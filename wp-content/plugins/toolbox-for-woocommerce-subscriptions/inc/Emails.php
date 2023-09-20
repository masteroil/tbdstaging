<?php
/**
 * Toolbox sends four emails when a customer sets a new subscription renewal date or skips a shipment.
 *
 * Change Next Ship Date - sent to store admin and customer.
 * Skip Next Ship date - sent to store admin and customer.
 */
namespace Javorszky\Toolbox;

class Emails {

	/**
	 * Emails constructor.
	 */
	public function __construct() {
		add_action( 'woocommerce_email_classes', array( $this, 'register_emails' ) );

		// Emails are not loaded on frontend so need to be hooked. This hooks the toolbox action to the email trigger.
		add_action( 'jgtb_after_change_next_ship_date', array( $this, 'jgtb_after_change_next_ship_date_email' ), 20, 6 );
		add_action( 'jgtb_after_skip_next_date', array( $this, 'jgtb_after_skip_next_date_email' ), 20, 4 );
	}

	/**
	 * Register four new emails with WooCommerce.
	 *
	 * @param array $emails Array of emails.
	 * @hook woocommerce_email_classes
	 * @return array
	 */
	public function register_emails( $emails ) {
		$emails['CustomerSkipRenewal']        = include 'emails/CustomerSkipRenewal.php';
		$emails['AdminSkipRenewal']           = include 'emails/AdminSkipRenewal.php';
		$emails['CustomerNextPaymentChanged'] = include 'emails/CustomerNextPaymentChanged.php';
		$emails['AdminNextPaymentChanged']    = include 'emails/AdminNextPaymentChanged.php';
		return $emails;
	}

	/**
	 * Sends email to store admin and customer when customer sets a new renewal date.
	 *
	 * @hook jgtb_after_change_next_ship_date
	 *
	 * @param \WC_Subscription $subscription
	 * @param integer          $user_id
	 * @param \DateTime        $old_next_date
	 * @param \DateTime        $next_payment_date
	 * @param \DateTime        $old_end_date
	 * @param bool             $adjust_end_date
	 */
	public function jgtb_after_change_next_ship_date_email( $subscription, $user_id, $old_next_date, $next_payment_date, $old_end_date, $adjust_end_date ) {
		\WC_Emails::instance();
		// Admin email
		$email = new \Javorszky\Toolbox\Emails\AdminNextPaymentChanged();
		$email->trigger( $subscription, $user_id, $old_next_date, $next_payment_date, $old_end_date );

		// Customer email
		$email = new \Javorszky\Toolbox\Emails\CustomerNextPaymentChanged();
		$email->trigger( $subscription, $user_id, $old_next_date, $next_payment_date, $old_end_date );
	}

	/**
	 * Sends email to store admin and customer when when customer skips a renewal.
	 *
	 * @hook jgtb_after_skip_next_date
	 *
	 * @param \WC_Subscription $subscription
	 * @param integer          $user_id
	 * @param string           $old_next_date
	 * @param string           $next_payment_date
	 */
	public function jgtb_after_skip_next_date_email( $subscription, $user_id, $old_next_date, $next_payment_date ) {
		\WC_Emails::instance();
		// Admin email
		$email = new \Javorszky\Toolbox\Emails\AdminSkipRenewal();
		$email->trigger( $subscription, $user_id, $old_next_date, $next_payment_date );

		// Customer email
		$email = new \Javorszky\Toolbox\Emails\CustomerSkipRenewal();
		$email->trigger( $subscription, $user_id, $old_next_date, $next_payment_date );
	}

}
