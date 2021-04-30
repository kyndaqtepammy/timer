<?php
namespace MET\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;
class Countdown extends Widget_Base {
    public function __construct( $data = [], $args = null) {
        parent::__construct($data, $args) ;
            wp_register_style('ctdncss', plugins_url( '/assets/css/countdown.css' , __FILE__ ));
            wp_register_script('ctdnjs', plugins_url( '/assets/js/countdown.js' , __FILE__ ));

    }

    public function get_script_depends() {
        return ['ctdnjs'];
    }

    public function get_style_depends() {
        return ['ctdncss'];
    }

   public function get_name() {
      return 'countdown';
   }
   public function get_title() {
      return __( 'Services Countdown' );
   }
   public function get_icon() {
      return 'fa fa-clock';
   }
   public function get_categories(){
      return ['general'];
   }
   
   protected function register_controls() {
  
         $this->end_controls_section();

         $this->start_controls_section(
            'content',
            [
               'label' => __( 'Content', 'plugin-name' ),
               'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
         );
         $this->add_control(
            'text_align',
            [
               'label' => __( 'Alignment', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::CHOOSE,
               'options' => [
                  'left' => [
                     'title' => __( 'Left', 'plugin-domain' ),
                     'icon' => 'fa fa-align-left',
                  ],
                  'center' => [
                     'title' => __( 'Center', 'plugin-domain' ),
                     'icon' => 'fa fa-align-center',
                  ],
                  'right' => [
                     'title' => __( 'Right', 'plugin-domain' ),
                     'icon' => 'fa fa-align-right',
                  ],
               ],
               'default' => 'center',
               'toggle' => true,
            ]
         );
            $this->end_controls_section();

         $this->start_controls_section(
            'style_section',
            [
               'label' => __( 'Style', 'plugin-name' ),
               'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
         );
         $this->add_control(
            'countdown_title',
            [
               'label' => __( 'Countdown Numbers Settings', 'plugin-name' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );
         $this->add_control(
            'countdown_style',
            [
               'label' => __( 'Timer Style', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::SELECT,
               'default' => 'style1',
               'options' => [
                  'style1'  => __( 'Style 1', 'plugin-domain' ),
                  //'style2' => __( 'Style 2', 'plugin-domain' ),
                  'style2' => __( 'Style 2', 'plugin-domain' ),
               ],
            ]
         );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
               'name' => 'background',
               'label' => __( 'Background', 'plugin-domain' ),
               'types' => [ 'classic', 'gradient', 'video' ],
               'selector' => '{{WRAPPER}} .time-span',
            ]
         );

   

         $this->add_control(
            'countdown_bgcolor',
            [
               'label' => __( 'Timer text color', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::COLOR,
               'scheme' => [
                  'type' => \Elementor\Core\Schemes\Color::get_type(),
                  'value' => \Elementor\Core\Schemes\Color::COLOR_1,
               ],
               'selectors' => [
                  '{{WRAPPER}} .countdown' => 'color: {{VALUE}}',
               ],
            ]
         );

         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
               'name' => 'content_typography',
               'label' => __( 'Typography', 'plugin-domain' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selectors' => '{{WRAPPER}} .countdown, .units',
            ]
         );
         $this->add_control(
            'hr',
            [
               'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
         );
         $this->add_control(
            'hr2',
            [
               'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
         );
        
         //FOR THE SERVICES TITLE
         $this->add_control(
            'services_title',
            [
               'label' => __( 'Service Title Settings', 'plugin-name' ),
               'type' => \Elementor\Controls_Manager::HEADING,
               'separator' => 'before',
            ]
         );

         $this->add_control(
            'show_title',
            [
               'label' => __( 'Show Service Title', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::SWITCHER,
               'label_on' => __( 'Show', 'your-plugin' ),
               'label_off' => __( 'Hide', 'your-plugin' ),
               'return_value' => 'yes',
               'default' => 'yes',
            ]
         );

         $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
               'name' => 'title_background',
               'label' => __( 'Background', 'plugin-domain' ),
               'types' => [ 'classic', 'gradient', 'video' ],
               'selector' => '{{WRAPPER}} .serviceTitle',
            ]
         );

         $this->add_control(
            'title_bgcolor',
            [
               'label' => __( 'Service title text color', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::COLOR,
               'scheme' => [
                  'type' => \Elementor\Core\Schemes\Color::get_type(),
                  'value' => \Elementor\Core\Schemes\Color::COLOR_1,
               ],
               'selectors' => [
                  '{{WRAPPER}} .serviceTitle' => 'color: {{VALUE}}',
               ],
            ]
         );

         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
               'name' => 'title_typography',
               'label' => __( 'Typography', 'plugin-domain' ),
               'scheme' => Scheme_Typography::TYPOGRAPHY_1,
               'selector' => '{{WRAPPER}} .serviceTitle',
            ]
         );     
      
       $this->end_controls_section();
     }
     protected function render(){
      $settings = $this->get_settings_for_display();
      $align = "";
      $show_title = "";

      switch( $settings['text_align'] ) {
         case "left":
            $align = "float:left";
            break;
         case "right":
            $align = "float:right";
            break;
         case "center":
            $align = "display: grid; place-items: center;";
            break;
      }

      if( $settings['show_title'] === "yes") {
          $show_title = "display: block";
      } else {
         $show_title = "display: none";
      }

      
       ?>
      
     <div class="countdown-wrapper" style="<?php echo $align ?>">
        <div class="countdown <?php echo $settings['countdown_style'] ?>" id="countdown">
         <span class="time-span">0d: </span>
         <span class="time-span">0h: </span>
         <span class="time-span">0m: </span>
         <span class="time-span">0s: </span>
      </div>
      <div class="serviceTitle" style="<?php echo  $show_title ?>" id="serviceTitle">Service Title  </div>

        
     </div>
<?php
     }

    
   }


   