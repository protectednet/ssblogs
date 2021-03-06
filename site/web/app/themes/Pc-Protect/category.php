<?php get_header(); ?>

<div class="content">
  <div class="row">
    <div class="columns large-3 d-n d-lg-b">
      <div class="sidebar-card sidebar-card--drop-shadow">
        <div class="sidebar-card__title">
          Sections
        </div>
        <hr>

        <a href="/" class="sidebar-card__category clearfix mb-1">
          <div class="sidebar-card__category-name">All</div>
          <div class="sidebar-card__category-number"><?= wp_count_posts()->publish ?></div>

          <?php foreach(get_categories() as $category): ?>
            <a href="/category/<?= $category->slug ?>" class="sidebar-card__category clearfix mb-1">
              <div class="sidebar-card__category-name"><?= $category->cat_name ?></div>
              <div class="sidebar-card__category-number"><?= $category->category_count ?></div>
            </a>
          <?php endforeach; ?>
        </a>
      </div>

      <?php include('twitter-feed.php') ?>

      <div class="sidebar-card">
        <div class="sidebar-card__title">
          Most Viewed
        </div>

        <?php
        $popularpost = new WP_Query(
          [
            'posts_per_page' => 3,
            'meta_key'       => 'wpb_post_views_count',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC'
          ]
        ); ?>
        <?php while($popularpost->have_posts()) : $popularpost->the_post() ?>

          <hr>
          <span class="sidebar-card__viewed-category">
            <?= getFilteredCategory(get_the_category()) ?>
          </span>
          <a class="sidebar-card__viewed-title mt-2" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
          <p class="sidebar-card__viewed-date mt-2"><?php the_time('F j, Y'); ?></p>

        <?php endwhile; ?>


      </div>

    </div>
    <main class="columns collapse large-9">
      <div role="main">
        <?php if(have_posts()): while(have_posts()) : the_post(); ?>

          <article
            class="columns medium-6 large-4 pr-0 pr-md-3 pl-md-3 pl-0 end">
            <div class="card">
              <a href="<?php the_permalink(); ?>"
                 class="card__image"
                 style="background-image: url('<?= get_the_post_thumbnail_url() ?>')"></a>
              <div class="card__text-container">
                <p class="card__category-title"><?= getFilteredCategory(get_the_category()) ?></p>
                <a href="<?php the_permalink(); ?>" class="card__title mb-1"><?php the_title(); ?></a>
                <div class="card__text">
                  <?php html5wp_excerpt('html5wp_index'); ?>
                </div>
                <div class="card__date"><?php the_time('F j, Y'); ?></div>
              </div>
            </div>
          </article>

        <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </main>
  </div>
</div>

<?php get_footer(); ?>
