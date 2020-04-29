<?php


/**
	 End  API ouput partial code example
	 */



		// Only continue if required logged-in cookies are set.
		if ( $this->determine_if_should_render() ) {

			// Get the public Blaize middleware userdata setup for use.
			$this->setup_middleware_userdata();

			// Setup the Delighted account ID and API keys ready for use.
			$this->setup_account_settings();

			// Only continue if the middleware has given us the required userdata - Otherwise error.
			if ( $this->userdata_email && $this->userdata_firstname && $this->userdata_lastname && $this->userdata_brand ) {

				// If the Delighted API class isn't available, make sure it is loaded.
				$this->load_required_libraries();

				// Initialise the Delighted API with our unique API key and set the API property.
				$api_response = $this->delighted_api_init();

				if ( $api_response ) {

					$this->returned_data = $api_response;

					// Setup the core Delighted JS with relevant Delighted ID.
					add_action( 'wp_head', array( $this, 'register_delighted_js' ) );

					// Hook the dynamic JS into the footer with a low priority to ensure the core Delighted JS loads first.
					add_action( 'wp_footer', array( $this, 'render_script' ), 20 );

				}
			} // No Blaize middleware data available. Trigger error.
			else {
				$this->trigger_delighted_error( 'Required Blaize Middleware userdata is not present. Is the user logged in?' );
			}
		} // User is logged out, or cookies aren't getting set.
		else {

			$this->trigger_delighted_error( 'Required session cookies are not present. Is the user logged in?' );

			if ( isset( $_COOKIE['blaize_session'] ) ) { // phpcs:ignore
				$this->trigger_delighted_error( 'Blaize blaize_sessioncookie cookie: ' . esc_html( $_COOKIE['blaize_session'] ) ); // phpcs:ignore
			} else {
				$this->trigger_delighted_error( 'Blaize blaize_session cookie is not set.' );
			}

			if ( defined( 'BLAIZE_BRAND' ) ) {
				$this->trigger_delighted_error( 'Blaize brand: ' . BLAIZE_BRAND );
			} else {
				$this->trigger_delighted_error( 'Blaize brand is not set.' );
			}
		}

		/**
		 * Handle/enqueue Delighted errors.
		 */
		if ( empty( $this->error_message ) ) {
			$this->trigger_delighted_error( 'No Delighted errors.' );
		}

		add_action( 'wp_footer', array( $this, 'enqueue_delighted_errors' ) );

		/**
		 * Print the Blaize API returned data to the front end, commented out. It isn't ideal, but this is required for debugging when logged out of WP.
		 */
		add_action(
			'wp_footer', function() {
			?>
			<!-- Blaize userdata response: <?php print_r( $this->raw_userdata ); // phpcs:ignore ?> -->
			<?php
			}
		);
	}

	/**
	 * Load the required Delighted API library and it's dependancies.
	 */
	
	public function fake_blaize_datalayer( $customerid = 'a57277e2-9ee2-4664-8e92-62e1b45df2fb', $userstatus = 'authenticated', $companyid = 'prag', $jobtitle = 'Accountant', $usercountry = '02c11ff0-072b-e011-aaa9-00155dc21b03', $subscriptiontype = 'gold', $allowaccess = 'true' ) {
	?>

		<script>
			(function(scope) {
					scope.dataLayer = (scope.dataLayer || []);
					var blaizeUserData = {};

					blaizeUserData['customerId'] = '<?php echo esc_attr( $customerid ); ?>';

					blaizeUserData['userStatus'] = '<?php echo esc_attr( $userstatus ); ?>';

					blaizeUserData['companyId'] = '<?php echo esc_attr( $companyid ); ?>';

					blaizeUserData['jobTitle'] = '<?php echo esc_attr( $jobtitle ); ?>';

					blaizeUserData['userCountry'] = '<?php echo esc_attr( $usercountry ); ?>';

					blaizeUserData['subscriptionType'] = '<?php echo esc_attr( $subscriptiontype ); ?>';

					blaizeUserData['allowAccess'] = '<?php echo esc_attr( $allowaccess ); ?>';

					scope.dataLayer.push(blaizeUserData);

				})(window);
		</script>

		<?php
	}

}


