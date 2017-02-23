<?php
/**
 * Options Page.
 */

namespace WPDiscourse\Admin;

use WPDiscourse\Utilities\Utilities as DiscourseUtilities;

class OptionsPage {

	protected static $instance;

	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function __construct() {
	}

	/**
	 * Displays the options options page and options page tabs.
	 *
	 * @param string $active_tab The current tab, used if `$_GET['tab']` is not set.
	 */
	public function display( $active_tab = '', $parent_tab = null, $fields = 'fields' ) {
		?>
        <div class="wrap discourse-options-page-wrap">
            <h2>
                <img
                        src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyhpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTExIDc5LjE1ODMyNSwgMjAxNS8wOS8xMC0wMToxMDoyMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTUgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MUYxNjlGNkY3NjAxMTFFNjkyRkZBRTlDQTMwREJDQzUiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MUYxNjlGNzA3NjAxMTFFNjkyRkZBRTlDQTMwREJDQzUiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDoxRjE2OUY2RDc2MDExMUU2OTJGRkFFOUNBMzBEQkNDNSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDoxRjE2OUY2RTc2MDExMUU2OTJGRkFFOUNBMzBEQkNDNSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pq7th6IAAAP8SURBVHjalFbbT5tlHH56grKWnicw5ijdAjNGg5CxbPGIM7qx7cIlxihxd7oLr/wHlpgsu/FWjbdeeOWFwUQixmW6GGbKpDKcgqhj7AA90CM9t/j8Xr+vKZW08Gue0O/jfZ/n/R3fGg73+dHE2ogzxEvEU4SPMBJxYon4kZjUnnc0QxOBD4j3iX40txjxKfEhUdqNwJPE58SwWmAwoFQqoVQsolqtwmgyoa2tDWazGVtbW/X7FokJYrb+pbGB/DliTsiNRiPyuRw2YjEY+HF7fejqOQCHw4FcNotoOKyEZZ1mg0SQeKWe0Fz3PUBck3cGCepGDE6XG8dOnIQ/cBgutwcmnrpcLiEaieB2KIRfgj+jnd54fT5UKhWdZ1oTW2oUmFTkDEl8Y4OkAbx69jwOPn5IhaO76zH0dHfB7Xaj3WpFMpXGt1Pf4KOrV7Fy9x/4+wMUL+tcX2sitRxckkQJeTIRRy9J35h4B06nEz6vFyPDQ/D3HYKJ8W+0UGgeFyfexh93fqeIv94TKZCPdYH7RK/EVBJ54c23MHD0CXXiU2MvorPT3rSM7q7cw8ljo8xZFr79+xUH7SFxUDL0gpDLm81MBkcGj6qY2237cOrl1uRi4t3lK1dQYojy+Zz++gAxJgJj8iQlJyHo6e1VZTgy/Aw67a3JdXvt9GmcePZ5hjihSlszJTAg38QtIXY4nHC5nAgE+rEX28fED42MwGazq/LVS1cEOvQn8UKEfCy7Dmv7ngTyhbyKv4coFAr6a58IqNqShimyW1OpJOx2G/ZqaZatgRxWelKt1ippq9aGErdKpYzVlRWeprBngYeP1lApVxSMhhptZNuosDGpfy0t4vr31+rruaWtcWys3n9AL5LIpFOwWCz6v37bJmC1dnBBGqG5ORRK5V2RS1hv3gyqA/29/CcS8Q20tdfyN10/Kv5rdYZq9Pgoq6J1ktPpDG78NIP1cASRSBi/3rrFsWJRHKyYZS6Z2SZQZOzFi7Pj402Js9kcVu6tYmHhDuLJJDY3M5ia/Arh9Udwe7z6GL/cOOwQjUVxZvwchoaeRjyRxPztBczOztKzCr06rhovzW6PcYTH2VClYkkNuh++m8Yyc+fkINTIZ4gv/icgwy3HeXLp3fcQDM5ifW1dzReLxYwjA4Po4wiRNSazCSkKPFhdxfLiIkOVgsvjUZVIgRSpXq+/0b7k3wvyINlPcGMkGoHD3qlq2sLulubLMgxym0kIhahYLCgPbDabGt/ayRPabJvf6cJRLS4bBI2mSCgk1SKTRkaCsdOoiDVy+QFwUYZr443Wvat6JImcXC6f+tGinfYT4rOdtsnqKSkMfWS0MIOGtEZ8g7jebMO/AgwANr2XXAf8LaoAAAAASUVORK5CYII="
                        alt="Discourse logo" class="discourse-logo">
				<?php esc_html_e( 'WP Discourse', 'wp-discourse' ); ?>
            </h2>
			<?php settings_errors(); ?>

			<?php
			if ( isset( $_GET['tab'] ) ) { // Input var okay.
				$tab = sanitize_key( wp_unslash( $_GET['tab'] ) ); // Input var okay.
			} elseif ( $active_tab ) {
				$tab = $active_tab;
			} else {
				$tab = 'connection_options';
			}

			if ( isset( $_GET['parent_tab'] ) ) {
				$parent = sanitize_key( wp_unslash( $_GET['parent_tab'] ) );
			} elseif ( $parent_tab ) {
				$parent = $parent_tab;
			} else {
				$parent = null;
			}
			?>

            <h2 class="nav-tab-wrapper nav-tab-first-level">
                <a href="?page=wp_discourse_options&tab=connection_options"
                   class="nav-tab <?php echo 'connection_options' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Connection', 'wp-discourse' ); ?>
                </a>
                <a href="?page=wp_discourse_options&tab=publishing_options"
                   class="nav-tab <?php echo 'publishing_options' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Publishing', 'wp-discourse' ); ?>
                </a>
                <a href="?page=wp_discourse_options&tab=commenting_options"
                   class="nav-tab <?php echo 'commenting_options' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Commenting', 'wp-discourse' ); ?>
                </a>
                <a href="?page=wp_discourse_options&tab=text_content_options"
                   class="nav-tab <?php echo 'text_content_options' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Text Content', 'wp-discourse' ); ?>
                </a>
                <a href="?page=wp_discourse_options&tab=sso_options"
                   class="nav-tab <?php echo 'sso_options' === $tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'SSO', 'wp-discourse' ); ?>
                </a>
				<?php do_action( 'discourse/admin/options-page/append-settings-tabs', $tab, $parent ); ?>
            </h2>

			<?php do_action( 'discourse/admin/options-page/after-settings-tabs', $tab, $parent ); ?>

			<?php if ( 'fields' === $fields ) : ?>

                <form action="options.php" method="post" class="wp-discourse-options-form">
					<?php
					switch ( $tab ) {
						case 'connection_options':
							settings_fields( 'discourse_connect' );
							do_settings_sections( 'discourse_connect' );
							break;

						case 'publishing_options':
							settings_fields( 'discourse_publish' );
							do_settings_sections( 'discourse_publish' );
							break;

						case 'commenting_options':
							settings_fields( 'discourse_comment' );
							do_settings_sections( 'discourse_comment' );
							break;

						case 'text_content_options':
							settings_fields( 'discourse_configurable_text' );
							do_settings_sections( 'discourse_configurable_text' );
							break;

						case 'sso_options':
							settings_fields( 'discourse_sso' );
							do_settings_sections( 'discourse_sso' );
							break;
					}

					do_action( 'discourse/admin/options-page/after-tab-switch', $tab );

					submit_button( 'Save Options', 'primary', 'discourse_save_options', false );
					?>
                </form>
				<?php if ( 'text_content_options' === $tab ) : ?>
                    <form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
                          method="post">
						<?php wp_nonce_field( 'process_options_reset', 'process_options_reset_nonce' ); ?>

                        <input type="hidden" name="action" value="process_options_reset">
						<?php submit_button( 'Reset Default Values', 'secondary', 'discourse_reset_options', false ); ?>
                    </form>
				<?php endif; ?>

			<?php endif; ?>

        </div>
		<?php
	}

	/**
	 * Resets the `discourse_configurable_text` option to its default values.
	 */
	public function process_reset() {
		if ( ! isset( $_POST['process_options_reset_nonce'] ) || // Input var okay.
		     ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['process_options_reset_nonce'] ) ), 'process_options_reset' ) // Input var okay.
		) {
			exit;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			exit;
		}

		delete_option( 'discourse_configurable_text' );
		add_option( 'discourse_configurable_text', get_option( 'discourse_configurable_text_backup' ) );

		$configurable_text_url = add_query_arg( array(
			'page' => 'wp_discourse_options',
			'tab'  => 'text_content_options',
		), admin_url( 'admin.php' ) );

		wp_safe_redirect( esc_url_raw( $configurable_text_url ) );

		exit;
	}
}