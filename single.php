<?php get_header(); ?>

    <?php while (have_posts()): the_post(); ?>

  <div class="hero" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
    <div class="hero-content">
      <div class="hero-text">
        <h2><?php the_title(); ?></h2>
      </div>
    </div>
  </div>
  <div class="main-content container">
    <main class="text-center content-text">
      <div class="entry-information clear">
        <div class="date">
          <time>
            <?php echo the_time('d'); ?>
            <span><?php echo the_time('M'); ?></span>
          </time>
        </div><!--.date-->
        <p class="author">
          <i class="fa fa-user" aria-hidden=true></i>
          <?php the_author(); ?>
        </p><!--.author-->
      </div>

      <?php the_content(); ?>
    </main>
  </div>

  <div class="container comments">
    <?php comment_form(); ?>
  </div>

  <div class="container comment-list">
    <ol class="commentlist">
      <?php
        $comments = get_comments(array(
          'post_id' => $post->ID,
          'status'  => 'approve'
        ));
        wp_list_comments(array(
          'per_page' => 10,
          'reverse_top_level' => false
        ), $comments);
      ?>
    </ol>
  </div>

    <?php endwhile; ?>

<?php get_footer(); ?>
