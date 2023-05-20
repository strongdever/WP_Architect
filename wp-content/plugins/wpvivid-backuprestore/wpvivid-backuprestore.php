<?php
/**
 * @link              https://wpvivid.com
 * @since             0.9.1
 * @package           wpvivid
 *
 * @wordpress-plugin
 * Plugin Name:       WPvivid Backup Plugin
 * Description:       Clone or copy WP sites then move or migrate them to new host (new domain), schedule backups, transfer backups to leading remote storage. All in one.
 * Version:           0.9.86
 * Author:            WPvivid Team
 * Author URI:        https://wpvivid.com
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/copyleft/gpl.html
 * Text Domain:       wpvivid-backuprestore
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'WPVIVID_PLUGIN_VERSION', '0.9.86' );
//
define('WPVIVID_RESTORE_INIT','init');
define('WPVIVID_RESTORE_READY','ready');
define('WPVIVID_RESTORE_COMPLETED','completed');
define('WPVIVID_RESTORE_RUNNING','running');
define('WPVIVID_RESTORE_ERROR','error');
define('WPVIVID_RESTORE_WAIT','wait');
define('WPVIVID_RESTORE_TIMEOUT',180);

define('WPVIVID_PLUGIN_SLUG','WPvivid');
define('WPVIVID_PLUGIN_NAME',plugin_basename(__FILE__));
define('WPVIVID_PLUGIN_URL',plugins_url('',__FILE__));
define('WPVIVID_PLUGIN_DIR',dirname(__FILE__));
define('WPVIVID_PLUGIN_DIR_URL',plugin_dir_url(__FILE__).'admin/');
define('WPVIVID_PLUGIN_IMAGES_URL',WPVIVID_PLUGIN_URL.'/admin/partials/images/');
//We set a long enough default execution time (10 min) to ensure that the backup process can be completed.
define('WPVIVID_MAX_EXECUTION_TIME',300);
define('WPVIVID_RESTORE_MAX_EXECUTION_TIME', 300);
define('WPVIVID_MEMORY_LIMIT','256M');
define('WPVIVID_RESTORE_MEMORY_LIMIT','512M');
define('WPVIVID_MIGRATE_SIZE', '2048');
//If the server uses fastcgi then default execution time should be set to 2 min for more efficient.
define('WPVIVID_MAX_EXECUTION_TIME_FCGI',180);
//Default number of reserved backups
define('WPVIVID_MAX_BACKUP_COUNT',7);
define('WPVIVID_DEFAULT_BACKUP_COUNT',3);
define('WPVIVID_DEFAULT_COMPRESS_TYPE','zip');
//Max zip file size.
define('WPVIVID_DEFAULT_MAX_FILE_SIZE',200);
//Instruct PclZip to use all the time temporary files to create the zip archive or not.The default value is 1.
define('WPVIVID_DEFAULT_USE_TEMP',1);
//Instruct PclZip to use temporary files for files with size greater than.The default value is 16M.
define('WPVIVID_DEFAULT_USE_TEMP_SIZE',16);
//Exclude the files which is larger than.The default value is 0 means unlimited.
define('WPVIVID_DEFAULT_EXCLUDE_FILE_SIZE',0);
//Add a file in an archive without compressing the file.The default value is 200.
define('WPVIVID_DEFAULT_NO_COMPRESS',true);
//Backup save folder under WP_CONTENT_DIR
define('WPVIVID_DEFAULT_BACKUP_DIR','wpvividbackups');
//Log save folder under WP_CONTENT_DIR
define('WPVIVID_DEFAULT_LOG_DIR','wpvividbackups'.DIRECTORY_SEPARATOR.'wpvivid_log');
//Old files folder under WPVIVID_DEFAULT_BACKUP_DIR
define('WPVIVID_DEFAULT_ROLLBACK_DIR','wpvivid-old-files');
//
define('WPVIVID_DEFAULT_ADMIN_BAR', true);
define('WPVIVID_DEFAULT_TAB_MENU', true);
define('WPVIVID_DEFAULT_DOMAIN_INCLUDE', true);
//
define('WPVIVID_DEFAULT_ESTIMATE_BACKUP', true);
//Specify the folder and database to be backed up
define('WPVIVID_DEFAULT_SUBPACKAGE_PLUGIN_UPLOAD', false);

//define schedule hooks
define('WPVIVID_MAIN_SCHEDULE_EVENT','wpvivid_main_schedule_event');
define('WPVIVID_RESUME_SCHEDULE_EVENT','wpvivid_resume_schedule_event');
define('WPVIVID_CLEAN_BACKING_UP_DATA_EVENT','wpvivid_clean_backing_up_data_event');
define('WPVIVID_TASK_MONITOR_EVENT','wpvivid_task_monitor_event');
define('WPVIVID_CLEAN_BACKUP_RECORD_EVENT','wpvivid_clean_backup_record_event');
//backup resume retry times
define('WPVIVID_RESUME_RETRY_TIMES',6);
define('WPVIVID_RESUME_INTERVAL',60);

define('WPVIVID_REMOTE_CONNECT_RETRY_TIMES','3');
define('WPVIVID_REMOTE_CONNECT_RETRY_INTERVAL','3');

define('WPVIVID_PACK_SIZE',1 << 20);

define('WPVIVID_SUCCESS','success');
define('WPVIVID_FAILED','failed');
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
//when active plugin redirect plugin page.


function wpvivid_plugin_activate()
{
    add_option('wpvivid_do_activation_redirect', true);
}
function wpvivid_init_plugin_redirect()
{
    if (get_option('wpvivid_do_activation_redirect', false))
    {
        delete_option('wpvivid_do_activation_redirect');

        $active_plugins = get_option('active_plugins');
        if(!function_exists('get_plugins'))
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        $plugins=get_plugins();
        $pro_wpvivid_slug='wpvivid-backup-pro/wpvivid-backup-pro.php';
        $b_redirect_pro=false;
        if(!empty($plugins))
        {
            if(isset($plugins[$pro_wpvivid_slug]))
            {
                if(in_array($pro_wpvivid_slug, $active_plugins))
                {
                    $b_redirect_pro=true;
                }
            }
        }

        if($b_redirect_pro)
        {
            $url=apply_filters('wpvivid_backup_activate_redirect_url','admin.php?page=wpvivid-dashboard');
            if (is_multisite())
            {
                wp_redirect(network_admin_url().$url);
            }
            else
            {
                wp_redirect(admin_url().$url);
            }
        }
        else
        {
            $url=apply_filters('wpvivid_backup_activate_redirect_url','admin.php?page=WPvivid');
            if (is_multisite())
            {
                wp_redirect(network_admin_url().$url);
            }
            else
            {
                wp_redirect(admin_url().$url);
            }
        }
    }
}
register_activation_hook(__FILE__, 'wpvivid_plugin_activate');
add_action('admin_init', 'wpvivid_init_plugin_redirect');

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.9.1
 */
if(isset($wpvivid_plugin)&&is_a($wpvivid_plugin,'WPvivid'))
{
    return ;
}

require plugin_dir_path( __FILE__ ) . 'includes/class-wpvivid.php';

function run_wpvivid()
{
    $wpvivid_plugin = new WPvivid();
    $GLOBALS['wpvivid_plugin'] = $wpvivid_plugin;
}
run_wpvivid();