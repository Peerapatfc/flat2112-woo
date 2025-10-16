<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-content">
        <div class="site-branding">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            </h1>
            <?php 
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo $description; ?></p>
            <?php endif; ?>
        </div>
        
        <nav class="main-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'fallback_cb' => 'wp_page_menu',
            ));
            ?>
        </nav>
    </div>
</header>

<main class="site-main">
    <div class="content-area">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <header class="post-header">
                        <h2 class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="post-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                            <span class="post-author">by <?php the_author(); ?></span>
                            <?php if (has_category()) : ?>
                                <span class="post-categories">in <?php the_category(', '); ?></span>
                            <?php endif; ?>
                        </div>
                    </header>
                    
                    <div class="post-content">
                        <?php
                        if (is_single()) {
                            the_content();
                        } else {
                            the_excerpt();
                            echo '<a href="' . get_permalink() . '" class="btn">Read More</a>';
                        }
                        ?>
                    </div>
                </article>
            <?php endwhile; ?>
            
            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '&laquo; Previous',
                    'next_text' => 'Next &raquo;',
                ));
                ?>
            </div>
        <?php else : ?>
            <article class="post">
                <h2>Welcome to Your New WordPress Site!</h2>
                <p>This is a sample WordPress website deployed on Render. You can start creating content by logging into your WordPress admin panel.</p>
                <p><a href="<?php echo admin_url(); ?>" class="btn">Go to Admin Panel</a></p>
            </article>
        <?php endif; ?>
    </div>
    
    <aside class="sidebar">
        <div class="widget">
            <h3 class="widget-title">About This Site</h3>
            <p>This is a sample WordPress website running on Render. It's built with a custom theme and ready for your content!</p>
        </div>
        
        <div class="widget">
            <h3 class="widget-title">Quick Links</h3>
            <ul>
                <li><a href="<?php echo admin_url(); ?>">Admin Panel</a></li>
                <li><a href="<?php echo admin_url('post-new.php'); ?>">Write a Post</a></li>
                <li><a href="<?php echo admin_url('themes.php'); ?>">Customize Theme</a></li>
            </ul>
        </div>
        
        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <?php dynamic_sidebar('sidebar-1'); ?>
        <?php endif; ?>
    </aside>
</main>

<footer class="site-footer">
    <div class="footer-content">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Powered by WordPress on Render.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>