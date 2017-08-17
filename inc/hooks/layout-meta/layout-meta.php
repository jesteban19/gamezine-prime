<?php
/**
 * Implement theme metabox.
 *
 * @package magazine-prime
 */

if ( ! function_exists( 'magazine_prime_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function magazine_prime_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'theme-settings',
				esc_html__( 'Single Page/Post Settings', 'magazine-prime' ),
				'magazine_prime_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'magazine_prime_add_theme_meta_box' );

if ( ! function_exists( 'magazine_prime_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 */
	function magazine_prime_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;
		$magazine_prime_post_meta_value = get_post_meta($post_id);

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'magazine_prime_meta_box_nonce' );
		// Fetch Options list.
		$magazine_prime_global_layout = magazine_prime_get_option('global_layout');
		$magazine_prime_single_image_layout = magazine_prime_get_option('single_post_image_layout');
	?>
	<div id="magazine-prime-settings-metabox-container" class="magazine-prime-settings-metabox-container">
		<div id="magazine-prime-settings-metabox-tab-layout">
			<h4><?php echo __( 'Layout Settings', 'magazine-prime' ); ?></h4>
			<div class="magazine-prime-row-content">
				 <!-- Checkbox Field-->
				     <p>
				     <div class="magazine-prime-row-content">
				         <label for="magazine-prime-meta-checkbox">
				             <input type="checkbox" name="magazine-prime-meta-checkbox" id="magazine-prime-meta-checkbox" value="yes" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-checkbox'] ) ) checked( $magazine_prime_post_meta_value['magazine-prime-meta-checkbox'][0], 'yes' ); ?> />
				             <?php esc_html_e( 'Check To Use Featured Image As Banner Image', 'magazine-prime' )?>
				         </label>
				     </div>
				     </p>
			     <!-- Select Field-->
			        <p>
			            <label for="magazine-prime-meta-select-layout" class="magazine-prime-row-title">
			                <?php esc_html_e( 'Single Page/Post Layout', 'magazine-prime' )?>
			            </label>
			            <select name="magazine-prime-meta-select-layout" id="magazine-prime-meta-select-layout">
			            	<?php if ($magazine_prime_global_layout == 'right-sidebar') { ?>
			                	<option value="right-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'right-sidebar' ); ?>><?php esc_html_e( 'Content - Primary Sidebar', 'magazine-prime' )?></option>';
				                <option value="left-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'left-sidebar' ); ?>><?php esc_html_e( 'Primary Sidebar - Content', 'magazine-prime' )?></option>';
				                <option value="no-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'no-sidebar' ); ?>><?php esc_html_e( 'No Sidebar', 'magazine-prime' )?></option>';
			            	<?php }
			            		elseif ($magazine_prime_global_layout == 'left-sidebar') { ?>
				                <option value="left-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'left-sidebar' ); ?>><?php esc_html_e( 'Primary Sidebar - Content', 'magazine-prime' )?></option>';
			                	<option value="right-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'right-sidebar' ); ?>><?php esc_html_e( 'Content - Primary Sidebar', 'magazine-prime' )?></option>';
				                <option value="no-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'no-sidebar' ); ?>><?php esc_html_e( 'No Sidebar', 'magazine-prime' )?></option>';
			            	<?php }
			            		elseif ($magazine_prime_global_layout == 'no-sidebar'){ ?>
				                <option value="no-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'no-sidebar' ); ?>><?php esc_html_e( 'No Sidebar', 'magazine-prime' )?></option>';
			            	    <option value="left-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'left-sidebar' ); ?>><?php esc_html_e( 'Primary Sidebar - Content', 'magazine-prime' )?></option>';
			                	<option value="right-sidebar" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-select-layout'][0], 'right-sidebar' ); ?>><?php esc_html_e( 'Content - Primary Sidebar', 'magazine-prime' )?></option>';
			            	<?php } ?>
			            </select>
			        </p>

		         <!-- Select Field-->
		            <p>
		                <label for="magazine-prime-meta-image-layout" class="magazine-prime-row-title">
		                    <?php esc_html_e( 'Single Page/Post Image Layout', 'magazine-prime' )?>
		                </label>
		                <select name="magazine-prime-meta-image-layout" id="magazine-prime-meta-image-layout">
		                	<?php if ($magazine_prime_single_image_layout == 'full') { ?>
		                    	<option value="full" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'full' ); ?>><?php esc_html_e( 'Full', 'magazine-prime' )?></option>';
		    	                <option value="right" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'right' ); ?>><?php esc_html_e( 'Right', 'magazine-prime' )?></option>';
		    	                <option value="left" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'left' ); ?>><?php esc_html_e( 'Left', 'magazine-prime' )?></option>';
		    	                <option value="no-image" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'no-image' ); ?>><?php esc_html_e( 'No-Image', 'magazine-prime' )?></option>';
		                	<?php }
		                		elseif ($magazine_prime_single_image_layout == 'right') { ?>
		    	                <option value="right" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'right' ); ?>><?php esc_html_e( 'Right', 'magazine-prime' )?></option>';
		    	                <option value="full" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'full' ); ?>><?php esc_html_e( 'Full', 'magazine-prime' )?></option>';
		    	                <option value="left" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'left' ); ?>><?php esc_html_e( 'Left', 'magazine-prime' )?></option>';
		    	                <option value="no-image" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'no-image' ); ?>><?php esc_html_e( 'No-Image', 'magazine-prime' )?></option>';
		                	<?php }
		                		elseif ($magazine_prime_single_image_layout == 'left'){ ?>
		                		<option value="left" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'left' ); ?>><?php esc_html_e( 'Left', 'magazine-prime' )?></option>';
		                		<option value="right" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'right' ); ?>><?php esc_html_e( 'Right', 'magazine-prime' )?></option>';
		                		<option value="full" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'full' ); ?>><?php esc_html_e( 'Full', 'magazine-prime' )?></option>';
		                		<option value="no-image" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'no-image' ); ?>><?php esc_html_e( 'No-Image', 'magazine-prime' )?></option>';
		                	<?php }
		                		elseif ($magazine_prime_single_image_layout == 'no-image'){ ?>
		                		<option value="no-image" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'no-image' ); ?>><?php esc_html_e( 'No-Image', 'magazine-prime' )?></option>';
		                		<option value="right" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'right' ); ?>><?php esc_html_e( 'Right', 'magazine-prime' )?></option>';
		                		<option value="full" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'full' ); ?>><?php esc_html_e( 'Full', 'magazine-prime' )?></option>';
		                		<option value="left" <?php if ( isset ( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'] ) ) selected( $magazine_prime_post_meta_value['magazine-prime-meta-image-layout'][0], 'left' ); ?>><?php esc_html_e( 'Left', 'magazine-prime' )?></option>';
		                	<?php } ?>
		                </select>
		            </p>
			</div><!-- .magazine-prime-row-content -->
		</div><!-- #magazine-prime-settings-metabox-tab-layout -->
	</div><!-- #magazine-prime-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'magazine_prime_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function magazine_prime_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['magazine_prime_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['magazine_prime_meta_box_nonce'], basename( __FILE__ ) ) ) {
			  return; }

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return; }
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

			// Checks for input and saves (checkbox)
			    if( isset( $_POST[ 'magazine-prime-meta-checkbox' ] ) ) {
			    	   $valid_values = array(
                       'yes',
                       '',
   						);
			    	$new = sanitize_text_field($_POST['magazine-prime-meta-checkbox'],'yes');
			    	if( in_array( $new, $valid_values ) ) {
				    	update_post_meta($post_id, 'magazine-prime-meta-checkbox', $new);
			    	}
			    } else {
			    	$valid_values = array(
                       'yes',
                       '',
   					);
			    	$new = sanitize_text_field($_POST['magazine-prime-meta-checkbox'],'');
			    	if( in_array( $new, $valid_values ) ) {
			    		update_post_meta($post_id, 'magazine-prime-meta-checkbox', $new);
			    	}
			    }

			// Checks for input and saves if needed (select field)
			  	if( isset( $_POST[ 'magazine-prime-meta-select-layout' ] ) ) {
			  		$valid_values = array(
                       'right-sidebar',
                       'left-sidebar',
                       'no-sidebar',
   					);
			  		$new = sanitize_text_field($_POST['magazine-prime-meta-select-layout']);
			  		if( in_array( $new, $valid_values ) ) {
			  			update_post_meta($post_id, 'magazine-prime-meta-select-layout', $new);
			  		}
			  	}
			// Checks for input and saves if needed (select field)
			  	if( isset( $_POST[ 'magazine-prime-meta-image-layout' ] ) ) {
			  		$valid_values = array(
                       'full',
                       'right',
                       'left',
                       'no-image',
   					);
			  		$new = sanitize_text_field($_POST['magazine-prime-meta-image-layout']);
			  		if( in_array( $new, $valid_values ) ) {
				  		update_post_meta($post_id, 'magazine-prime-meta-image-layout', $new);
			  		}
			  	}
	}

endif;

add_action( 'save_post', 'magazine_prime_save_theme_settings_meta', 10, 3 );