<?php
namespace Javorszky\Toolbox\Emails;

use Javorszky\Toolbox\Utilities;

if ( ! class_exists( '\Javorszky\Toolbox\Emails\AdminSkipRenewal', false ) ) :

	/**
	 * Class for sending email to administrator after customer skips a subscription renewal.
	 */
	class AdminSkipRenewal extends \WC_Email {

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id             = 'admin_skipped_renewal';
			$this->title          = __( 'Skipped Subscription (Admin)', 'jg-toolbox' );
			$this->description    = __( 'This email is sent to the administrator when a customer skips a subscription renewal.', 'jg-toolbox' );
			$this->template_html  = 'emails/customer_skips_renewal.php';
			$this->template_plain = 'emails/plain/customer_skips_renewal.php';
			$this->template_base  = trailingslashit( JGTB_PATH ) . 'templates/';
			$this->placeholders   = array(
				'{site_title}'   => $this->get_blogname(),
				'{order_number}' => '',
				'{next_date}'    => '',
			);

			// Call parent constructor.
			parent::__construct();

			$this->customer_email = false;
			$this->recipient      = $this->get_option( 'recipient', get_option( 'admin_email' ) );

		}

		/**
		 * Get email subject.
		 *
		 * @since  1.1.0
		 * @return string
		 */
		public function get_default_subject() {
			return __( '[{site_title}]: Subscription Skipped: #{order_number}', 'jg-toolbox' );
		}

		/**
		 * Get email heading.
		 *
		 * @return string
		 */
		public function get_default_heading() {
			return __( 'Subscription Skipped: #{order_number}', 'jg-toolbox' );
		}

		/**
		 * Trigger the sending of this email.
		 *
		 * @param \WC_Subscription $subscription Subscription object.
		 * @param integer          $user_id      User ID.
		 * @param string           $old_next_date Old Next Date.
		 * @param string           $next_payment_date Next Payment Date.
		 */
		public function trigger( $subscription, $user_id, $old_next_date, $next_payment_date ) {
			$this->object                         = $subscription;
			$this->placeholders['{order_number}'] = $subscription->get_order_number();
			$this->placeholders['{next_date}']    = Utilities\email_display_date( $next_payment_date );

			if ( $this->is_enabled() && $this->get_recipient() ) {
				$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
			}
		}

		/**
		 * Default content to show below main email content.
		 *
		 * @return string
		 */
		public function get_default_additional_content() {
			return __( 'Customer skipped subscription #{order_number}. Next Date: {next_date}', 'jg-toolbox' );
		}

		/**
		 * Get content html.
		 *
		 * @return string
		 */
		public function get_content_html() {
			return wc_get_template_html(
				$this->template_html,
				array(
					'notice'        => $this->object,
					'email_heading' => $this->get_heading(),
					'content'       => $this->get_additional_content(),
					'plain_text'    => false,
					'email'         => $this,
				),
				'',
				$this->template_base
			);
		}

		/**
		 * Get content plain.
		 *
		 * @return string
		 */
		public function get_content_plain() {
			return wc_get_template_html(
				$this->template_plain,
				array(
					'subscription'  => $this->object,
					'email_heading' => $this->get_heading(),
					'content'       => $this->get_additional_content(),
					'plain_text'    => true,
					'email'         => $this,
				),
				'',
				$this->template_base
			);
		}

		/**
		 * Initialise settings form fields.
		 */
		public function init_form_fields() {
			/* translators: %s: list of placeholders */
			$placeholder_text  = sprintf( __( 'Available placeholders: %s', 'woocommerce' ), '<code>' . esc_html( implode( '</code>, <code>', array_keys( $this->placeholders ) ) ) . '</code>' );
			$this->form_fields = array(
				'enabled'            => array(
					'title'   => __( 'Enable/Disable', 'woocommerce' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable this email notification', 'woocommerce' ),
					'default' => 'yes',
				),
				'recipient'          => array(
					'title'       => __( 'Recipient(s)', 'woocommerce' ),
					'type'        => 'text',
					/* translators: %s: list of emails that will receive message. Defaults to admin email. */
					'description' => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s.', 'woocommerce' ), '<code>' . esc_attr( get_option( 'admin_email' ) ) . '</code>' ),
					'placeholder' => '',
					'default'     => '',
					'desc_tip'    => true,
				),
				'subject'            => array(
					'title'       => __( 'Subject', 'woocommerce' ),
					'type'        => 'text',
					'desc_tip'    => true,
					'description' => $placeholder_text,
					'placeholder' => $this->get_default_subject(),
					'default'     => '',
				),
				'heading'            => array(
					'title'       => __( 'Email heading', 'woocommerce' ),
					'type'        => 'text',
					'desc_tip'    => true,
					'description' => $placeholder_text,
					'placeholder' => $this->get_default_heading(),
					'default'     => '',
				),
				'additional_content' => array(
					'title'       => __( 'Additional content', 'woocommerce' ),
					'description' => __( 'This text will appear below the main email content.', 'woocommerce' ) . ' ' . $placeholder_text,
					'css'         => 'width:400px; height: 75px;',
					'placeholder' => __( 'N/A', 'woocommerce' ),
					'type'        => 'textarea',
					'default'     => $this->get_default_additional_content(),
					'desc_tip'    => true,
				),
				'email_type'         => array(
					'title'       => __( 'Email type', 'woocommerce' ),
					'type'        => 'select',
					'description' => __( 'Choose to send the email in plain text, HTML, or multi-part.', 'woocommerce' ),
					'default'     => 'html',
					'class'       => 'email_type wc-enhanced-select',
					'options'     => $this->get_email_type_options(),
					'desc_tip'    => true,
				),
			);
		}
	}

endif;

return new AdminSkipRenewal();
