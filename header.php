<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>La Pizzeria</title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>

    <header class="site-header">
      <div class="container">
        <div class="logo">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo get_template_directory_uri()?>/img/logo.svg" class="logoimage">
          </a>
        </div><!-- Logo -->
        <div class="header-information">
          <div class="socials">
             <?php
               $args = array(
                 'theme_location' => 'social-menu',
                 'container'      => 'nav',
                 'container_class' => 'socials',
                 'container_id'    => 'socials',
                 'link_before'     => '<span class="sr-text">',
                 'link_after'      => '</span>'
               );
             wp_nav_menu($args);

            ?>
          </div><!-- .Socials -->
          <div class="address">
            <p><?php echo esc_html(get_option( 'lapizzeria1_location')); ?></p>
            <p>Phone Number: <?php echo esc_html(get_option( 'lapizzeria1_phonenumber')); ?></p>
          </div>
        </div> <!-- .header-information -->
      </div> <!-- .container -->
    </header>

    <div class="main-menu">
      <div class="mobile-menu">
        <a href="#" class="mobile"><i class="fa fa-bars"></i>Menu</a>
      </div>
      <div class="naivigation container">
        <?php
        $args = array(
          'theme_location' => 'header-menu',
          'container'      => 'nav',
          'container_class' => 'site-nav'
        );
        wp_nav_menu($args);
         ?>
      </div>
    </div>
