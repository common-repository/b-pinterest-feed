<?php 
  if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
  }

/**
 * Sanitize function for text field.
 */
if ( ! function_exists( 'kpfpinterest_sanitize_text' ) ):
  function kpfpinterest_sanitize_text( $value ) {

    $text = filter_var( $value, FILTER_SANITIZE_STRING );
    return $text;

  }
endif;

//
// Metabox of the pinterest post type.
// Set a unique slug-like ID.
//
$prefix_shortcode_opts = 'kp_pinterest_options';

CSF::createMetabox(
  $prefix_shortcode_opts, array(
    'title'     => esc_html__( 'Pinterest Settings', 'pinterest-free' ),
    'class'     => 'kpp-main-class',
    'post_type' => 'kpp_pinterest',
    'context'   => 'normal',
    'id'=> 'my_box'
  )
);


//
// General Settings section.
//
// Create a section
  CSF::createSection( $prefix_shortcode_opts, array(
    'fields' => array(
  
      // Rule: The show to the text field if opt-select equal "Option 2 (opt-2)"
      array(
        'id'       => 'kp-pinterest-username',
        'type'     => 'text',
        'title'    => esc_html__( 'Username', 'pinterest-free' ),
        'subtitle' => esc_html__( 'This text field is required, Enter Username.', 'pinterest-free' ),
        'validate' => 'csf_validate_required',
        'after'    => ' <small class="csf-text-error">( * required )</small>',
      ),

      array(
        'id'       => 'kp-pinterest-boardName',
        'type'     => 'text',
        'title'    => esc_html__( 'BoardName', 'pinterest-free' ),
        'subtitle' => esc_html__( 'This text field is required, Enter boardName.', 'pinterest-free' ),
        'validate' => 'csf_validate_required',
        'after'    => ' <small class="csf-text-error">( * required )</small>',
      ),
      array(
        'id'          => 'layout',
        'type'        => 'select',
        'title'       => 'Layout',
        'placeholder' => 'Select',
        'options'     => array(
          'default'  => 'Default',
          'masonry'  => 'Masonry',
          'slider'   => 'Carousel',
          'justified' => 'Justified'
        ),
        'default'     => 'default',
        'class'       => 'bplugins-meta-readonly'
      ),
      array(
        'id'         => 'bpinterest_justified_margin',
        'type'       => 'spinner',
        'title'   => __('Margin', 'pinterest-free'),
        'subtitle'=> __('Space between two items', 'pinterest-free'),
        'desc'    => __('Working only layout justified', 'pinterest-free'),
        'default'    => 5,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '==', 'justified')
      ),
      array(
        'id'         => 'bpinterest_device',
        'type'       => 'button_set',
        'title'   => __('Device', 'pinterest-free'),
        'options'    => array(
          'desktop'  => 'Desktop',
          'tablet'  => 'Tablet',
          'mobile'  => 'mobile',
        ),
        'default'    => 'desktop',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array('layout', '==', 'default')
      ),
      array(
        'id'         => 'column',
        'type'       => 'button_set',
        'title'   => __('Column', 'pinterest-free'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',  
          '5'  => '5 Col',
        ),
        'default'    => '4',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array( array( 'bpinterest_device', '==', 'desktop' ), array( 'layout', '==', 'default')),
      ),
      array(
        'id'         => 'col_tablet',
        'type'       => 'button_set',
        'title'   => __('Column ', 'bgallery'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',
          '5'  => '5 Col',
        ),
        'default'    => '2',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array (array('bpinterest_device', '==', 'tablet'), array( 'layout', '==', 'default'))
      ),
      array(
        'id'         => 'col_mobile',
        'type'       => 'button_set',
        'title'   => __('Column', 'bgallery'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',
          '5'  => '5 Col',
        ),
        'default'    => '1',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array (array('bpinterest_device', '==', 'mobile'), array( 'layout', '==', 'default') ) 
      ),
      // Slider Column 
      array(
        'id'         => 'slider_device',
        'type'       => 'button_set',
        'title'   => __('Device', 'pinterest-free'),
        'options'    => array(
          'desktop'  => 'Desktop',
          'tablet'  => 'Tablet',
          'mobile'  => 'Mobile',
        ),
        'default'    => 'desktop',
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('layout', '==', 'slider')
      ),
      array(
        'id'         => 'slider_column',
        'type'       => 'button_set',
        'title'   => __('Item Show', 'pinterest-free'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',  
          '5'  => '5 Col',
        ),
        'default'    => '4',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array( array( 'slider_device', '==', 'desktop' ), array( 'layout', '==', 'slider')),
      ),
      array(
        'id'         => 'slider_col_tablet',
        'type'       => 'button_set',
        'title'   => __('Item Show ', 'pinterest-free'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',
          '5'  => '5 Col',
        ),
        'default'    => '2',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array( array( 'slider_device', '==', 'tablet' ), array( 'layout', '==', 'slider')),
      ),
      array(
        'id'         => 'slider_col_mobile',
        'type'       => 'button_set',
        'title'   => __('Item Show', 'pinterest-free'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',
          '5'  => '5 Col',
        ),
        'default'    => '1',
        'class'       => 'bplugins-meta-readonly',
        'dependency' => array( array( 'slider_device', '==', 'mobile' ), array( 'layout', '==', 'slider')),
      ),
      array(
        'id'      => 'loop',
        'type'    => 'switcher',
        'title'   => __('Loop', 'pinterest-free' ),
        'default' => true,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('layout', '==', 'slider')
      ),
      array(
        'id'      => 'mouseWheel',
        'type'    => 'switcher',
        'title'   => __('MouseWheel', 'pinterest-free' ),
        'default' => true,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('layout', '==', 'slider')
      ),
      array(
        'id'      => 'autoPlay',
        'type'    => 'switcher',
        'title'   => __('Auto Play', 'pinterest-free' ),
        'default' => true,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('layout', '==', 'slider')
      ),
      array(
        'id'      => 'delay',
        'type'    => 'number',
        'title'   => __('Delay', 'bgallery'),
        'default' => 2500,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array(array('layout', '==', 'slider'),array('autoPlay', '==', true))
      ),
      array(
        'id'          => 'effect',
        'type'        => 'select',
        'title'       => __('Effect', 'pinterest-free'),
        'placeholder' => 'Select an effect',
        'options'     => array(
          'none'     => 'Default',
          'fade'     => 'Fade',
          'flip'     => 'Flip',
          'cards'    => 'Cards'
        ),
        'default'     => 'none',
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('layout', '==', 'slider')
      ),
      
      // Masonry column  
      array(
        'id'         => 'masonry_col',
        'type'       => 'button_set',
        'title'   => __('Column', 'bgallery'),
        'options'    => array(
          '1'  => '1 Col',
          '2'  => '2 Col',
          '3'  => '3 Col',
          '4'  => '4 Col',
          '5'  => '5 Col',
        ),
        'default'    => '4',
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '==', 'masonry')
      ),
      array(
        'id'         => 'bpinterest_row_gap',
        'type'       => 'spinner',
        'title'   => __('Row Gap', 'pinterest-free'),
        'subtitle'=> __('Space between two items', 'pinterest-free'),
        'desc'    => __('Working only layout default and masonry', 'pinterest-free'),
        'default'    => 5,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '!=', 'slider')
      ),
      array(
        'id'         => 'bpinterest_col_gap',
        'type'       => 'spinner',
        'title'   => __('Column Gap', 'pinterest-free'),
        'subtitle'=> __('Space between two items', 'pinterest-free'),
        'desc'    => __('Working only layout default and masonry', 'pinterest-free'),
        'default'    => 5,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '!=', 'slider')
      ),
      array(
        'id'         => 'slider_item_gap',
        'type'       => 'spinner',
        'title'   => __('Item Space', 'pinterest-free'),
        'subtitle'=> __('Item space', 'pinterest-free'),
        'default'    => 5,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '==', 'slider')
      ),
      // Justified
      array(
        'id'      => 'isCssAnimation',
        'type'    => 'switcher',
        'title'   => __('Css Animation', 'pinterest-free' ),
        'default' => true,
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '==', 'justified')
      ),
      array(
        'id'          => 'lastrow',
        'type'        => 'select',
        'title'       => __('Last Row', 'pinterest-free'),
        'placeholder' => 'Select an Ratio',
        'options'     => array(
          'nojustify'  => 'No Justify',
          'justify'  => 'Justify',
          'center'  => 'Center',
          'right'  => 'Right',
           
        ),
        'default'     => 'nojustify',
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array( 'layout', '==', 'justified')
      ),
    // all layout needed 
      array(
        'id'          => 'ratio',
        'type'        => 'select',
        'title'       => __('Ratio', 'pinterest-free'),
        'desc'        => __('Working only layout default and Carousel', 'pinterest-free'),
        'placeholder' => 'Select an Ratio',
        'options'     => array(
          'landscape'  => '16:9 - Landscape',
          'horizontal'  => '4:3 - Horizontal',
          'square'  => '1:1 - Square',
          'vertical'  => '3:4 - Vertical',
          'potrait'  => '9:16 - Potrait',
        ),
        'default'     => 'square',
        'class'       => 'bplugins-meta-readonly'
      ),
      array(
        'id'      => 'isOverly',
        'type'    => 'switcher',
        'title'   => __('Overly', 'pinterest-free' ),
        'default' => false,
        'class'       => 'bplugins-meta-readonly',
      ),
      array(
        'id'    => 'overlyColor',
        'type'  => 'color',
        'title' => __('Color', 'pinterest-free'),
        'default' => '#00000038',
        'class'       => 'bplugins-meta-readonly',
        'dependency' =>  array('isOverly', '==', true)
      ),
      array(
        'id'      => 'isTransform',
        'type'    => 'switcher',
        'title'   => __('Transform', 'pinterest-free' ),
        'default' => false,
        'class'       => 'bplugins-meta-readonly',
      ),
      array(
        'id'      => 'border',
        'type'    => 'border',
        'title'   => 'Border',
        'default' => array(
          'top'    => '0',
          'right'  => '0',
          'bottom' => '0',
          'left'   => '0',
          'style'  => 'dashed',
          'color'  => '#1e73be',
          'unit'   => 'px',
        ),
        'class'       => 'bplugins-meta-readonly',
      ),
      array(
        'id'      => 'borderRadius',
        'type'    => 'number',
        'title'   => __('Border Radius', ''),
        'default' => 5,
        'class'       => 'bplugins-meta-readonly',
        'desc' =>  'only support px'
      ),
    )
  ) );


// metabox for wordpress
if ( ! function_exists( 'kp_pinterest_meta_init' ) ) :
    function kp_pinterest_meta_init(){
        add_meta_box('kp_pinterest_shortcode', 'Pinterest Shortcode', 'kp_pinterest_shortcode_setup', 'kpp_pinterest', 'normal', 'high');
    }
endif;


add_action('admin_init','kp_pinterest_meta_init');

if ( ! function_exists( 'kp_pinterest_shortcode_setup' ) ) :
    function kp_pinterest_shortcode_setup(){
        global $post;
        ?>
        <div class="kpp-main-class">
          <div class="csf-field csf-field-text">
            <div class="csf-title"><h4><?php echo esc_html__( 'Shortcode', 'pinterest-free' ) ?></h4></div>
            <div class="csf-fieldset">
              <input type='text' id='kp_pinterest_shortcode' onfocus='this.select();' readonly  value='[pinterest id="<?php echo $post->ID; ?>"]' /> 
              <p><?php echo esc_html__( 'Copy this shortcode and paste it into your post, page, or text widget content', 'pinterest-free' ) ?></p>
            </div>
          </div>
        </div>
        <?php
    }
endif;

