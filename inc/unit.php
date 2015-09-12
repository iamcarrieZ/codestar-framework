<?php
/**
 *
 * Register Widget for Developer
 *
 */
if( ! function_exists( 'cs_widgets_init' ) ) {
  function cs_widgets_init() {

    register_sidebar( array(
      'name'          => 'Widget Area',
      'id'            => 'sidebar-1',
      'description'   => 'Add widgets here to appear in your sidebar.',
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    ) );

  }
  add_action( 'widgets_init', 'cs_widgets_init' );
}

/**
 *
 * Codestar Framework Example Widget
 *
 */
if( ! class_exists( 'CS_Widget' ) ) {
  class CS_Widget extends WP_Widget {

    function __construct() {

      $widget_ops     = array(
        'classname'   => 'cs_widget_example',
        'description' => '- Codestar Framework Example Widget.'
      );

      parent::__construct( 'cs_widget', '- Codestar Framework Widget', $widget_ops );

    }

    function widget( $args, $instance ) {

      extract( $args );

      echo $before_widget;

      if ( ! empty( $instance['title'] ) ) {
        echo $before_title . $instance['title'] . $after_title;
      }

      echo '<div class="textwidget">';
      echo '<img src="'. $instance['logo'] .'" />';
      echo '<p>'. $instance['content'] .'</p>';
      echo '</div>';

      echo $after_widget;

    }

    function update( $new_instance, $old_instance ) {

      $instance            = $old_instance;
      $instance['title']   = $new_instance['title'];
      $instance['logo']    = $new_instance['logo'];
      $instance['sure']    = $new_instance['sure'];
      $instance['content'] = $new_instance['content'];

      return $instance;

    }

    function form( $instance ) {

      //
      // set defaults
      // -------------------------------------------------
      $instance   = wp_parse_args( $instance, array(
        'title'   => 'bla bla bla',
        'logo'    => '',
        'sure'    => '',
        'content' => '',
      ));

      //
      // text field example
      // -------------------------------------------------
      $text_value = esc_attr( $instance['title'] );
      $text_field = array(
        'id'    => $this->get_field_name('title'),
        'name'  => $this->get_field_name('title'),
        'type'  => 'text',
        'title' => 'Title',
      );

      echo cs_add_element( $text_field, $text_value );

      //
      // upload field example
      // -------------------------------------------------
      $upload_value = esc_attr( $instance['logo'] );
      $upload_field = array(
        'id'    => $this->get_field_name('logo'),
        'name'  => $this->get_field_name('logo'),
        'type'  => 'upload',
        'title' => 'Logo',
        'desc'  => 'Content',
      );

      echo cs_add_element( $upload_field, $upload_value );

      //
      // notice field example
      // -------------------------------------------------
      $notice_field = array(
        'type'      => 'notice',
        'class'     => 'info',
        'content'   => 'A Notice field example here.',
      );

      echo cs_add_element( $notice_field );

      //
      // image field example
      // -------------------------------------------------
      $switcher_value = esc_attr( $instance['sure'] );
      $switcher_field = array(
        'id'    => $this->get_field_name('sure'),
        'name'  => $this->get_field_name('sure'),
        'type'  => 'switcher',
        'title' => 'Switcher',
        'info'  => 'Are you sure for this ?',
      );

      echo cs_add_element( $switcher_field, $switcher_value );

      //
      // textarea field example
      // -------------------------------------------------
      $textarea_value = esc_attr( $instance['content'] );
      $textarea_field = array(
        'id'    => $this->get_field_name('content'),
        'name'  => $this->get_field_name('content'),
        'type'  => 'textarea',
        'title' => 'Content',
        'info'  => 'Some description for this field',
      );

      echo cs_add_element( $textarea_field, $textarea_value );

    }
  }
}

if ( ! function_exists( 'cs_widget_init' ) ) {
  function cs_widget_init() {
    register_widget( 'CS_Widget' );
  }
  add_action( 'widgets_init', 'cs_widget_init', 2 );
}