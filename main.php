<?php
namespace MET;
if (!defined('ABSPATH')) exit;
class E_MET {
   public function __construct() {
      add_action('init', [$this, 'check_for_install']);
      add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
   }

   private function include_widgets_files() {
      require_once(__DIR__ . '/widgets/countdown.php');
   }
   
   public function register_widgets() {
      $this->include_widgets_files();
      \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Countdown());
   }
   public function check_for_install() {
      E_MET::show_redo_warning();
      return;
   }
   private function show_redo_warning() {
      if (!defined('ELEMENTOR_VERSION')) {
         $link = "https://pl.wordpress.org/plugins/elementor/";
         $plugin = "Elementor Page Builder";
?>
         <div class="notice notice-warning is-dismissible">
            <p>Please install <a href="<?php echo $link; ?>"><?php echo $plugin; ?></a> to use Elementor MetChurch Countdown Widget.</p>
         </div>
      <?php
      }
   }
}
