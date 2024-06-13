<?php
/*
Template Name: PageAdvertorial
*/
?>

    <!DOCTYPE html>
<html <?php language_attributes(); ?>>

    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="format-detection" content="telephone=no">
        <meta name="theme-color" content="<?php echo ot_get_option('accent_color', '#e74c3c'); ?>">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
        <?php wp_head(); ?>
    </head>

<?php
$body_class = '';

if( ot_get_option('sticky_sidebar') != 'off' ) {
    $body_class = 'sticky-sidebar';
}

if ( class_exists('Mobile_Detect') ){
    $detect = new Mobile_Detect;
    if ( $detect->isMobile() ) {
        $body_class = '';
    }
}
?>

<body <?php body_class( esc_attr( $body_class ) ); ?> id="site-body" itemscope itemtype="http://schema.org/WebPage">
<div id="wrapper">
<?php get_sidebar('top'); ?>

<?php get_template_part( 'site-header' ); // Include site-header.php ?>

<?php get_template_part( 'pre-content' ); // Include pre-content.php ?>

<?php //get_template_part( 'title' ); // Include title.php ?>

    <div id="main" class="clearfix">




<?php if ( ! function_exists( 'mnky_ajax_enqueue_scripts' )) { mnky_setPostViews( get_the_ID() );} ?>
<?php get_sidebar('before-post'); ?>

    <div id="container" class="clearfix">

        <div id="content" class="float-left">

            <?php while ( have_posts() ) : the_post(); ?>

                <article itemtype="http://schema.org/Article" itemscope="" id="post-<?php the_ID(); ?>" <?php post_class('single-layout clearfix'); ?> >

                    <link itemprop="mainEntityOfPage" href="<?php the_permalink(); ?>" />

                    <?php if (get_post_meta( get_the_ID(), 'single_post_header', true ) != 'off') : ?>
                        <header class="entry-header clearfix">
                            <?php mnky_label(); ?>
                            <?php if ( ot_get_option('post_category') != 'off' ) : ?>
                                <h5><?php the_category( ', ' ); ?></h5>
                            <?php endif; ?>
                            <?php if (is_advertorial()): ?>
                                <h1 itemprop="headline" class="entry-title"><div class="ocm_adv_title"></div></h1>
                            <?php else : ?>
                                <h1 itemprop="headline" class="entry-title"><?php the_title(); ?></h1>
                            <?php endif; ?>
                            <?php mnky_post_meta(); ?>
                            <?php get_sidebar('post-header'); ?>
                            <?php if( get_post_meta( get_the_ID(), 'post_lead_text', true) != '' ) {
                                echo '<div class="post_lead_text clearfix">'. wp_kses_post( get_post_meta( get_the_ID(), 'post_lead_text', true ) ) .'</div>';
                            } ?>
                        </header><!-- .entry-header -->
                    <?php endif; ?>

                    <?php if ( get_post_meta( get_the_ID(), 'content_featured_img', true ) != 'off' && has_post_thumbnail() ) {
                        echo '<div class="post-preview">', the_post_thumbnail('large') .'</div>';
                    } ?>
                    <?php if( get_post_meta( get_the_ID(), 'mnky_featured_image_caption_text', true) != '' && has_post_thumbnail() ) {
                        echo '<div class="mnky-featured-image-caption clearfix">'. wp_kses_post( get_post_meta( get_the_ID(), 'mnky_featured_image_caption_text', true ) ) .'</div>';
                    } ?>

                    <?php if ( get_post_meta( get_the_ID(), 'review_position', true ) == 'top' ) { ?>
                        <?php get_template_part( 'review' ); ?>
                    <?php } ?>

                    <?php get_sidebar('post-content-top'); ?>

                    <?php if( get_post_meta( get_the_ID(), 'top_post_advertisement', true) != '' ) {
                        echo '<div class="article-top-advertisement">'. do_shortcode( '[mnky_ads id="'. esc_html(get_post_meta( get_the_ID(), 'top_post_advertisement', true)) .'"]' ) . '</div>';
                    } ?>

                    <div itemprop="articleBody" class="entry-content">
                        <?php if (is_advertorial()) : ?>
                            <div class="ocm_adv_desc entry-content"></div>
                        <?php else: ?>
                            <?php
                            the_content(); ?>
                        <?php endif; ?>
                    </div><!-- .entry-content -->
                    <?php if ( get_post_meta( get_the_ID(), 'review_position', true ) == 'bottom' ) { ?>
                        <?php get_template_part( 'review' ); ?>
                    <?php } ?>

                    <?php if( get_post_meta( get_the_ID(), 'bottom_post_advertisement', true) != '' ) {
                        echo '<div class="article-bottom-advertisement">'. do_shortcode( '[mnky_ads id="'. esc_html(get_post_meta( get_the_ID(), 'bottom_post_advertisement', true)) .'"]' ) . '</div>';
                    } ?>

                    <?php get_sidebar('post-content-bottom'); ?>
                    <?php mnky_post_meta_footer(); ?>

                    <aside class="publisher-teaser google-publication">
                        Ακολουθήστε το Patrisnews.gr στο <a target="_blank" rel="nofollow noopener" href="https://news.google.com/publications/CAAqBwgKMPjNpAswu9i8Aw?hl=el&gl=GR&ceid=GR%3Ael"><strong>Google News</strong></a> και μάθετε πρώτοι όλες τις ειδήσεις
                    </aside>
                    <aside class="publisher-teaser">
                        Ακολουθήστε το Patrisnews και <a target="_blank" rel="nofollow noopener" href="https://youtube.com/@patrisnews?feature=shared"><strong>στο κανάλι μας στο YouTube</strong></a>
                    </aside>
                    <style>
                        aside.publisher-teaser {
                            margin: 1em 0;
                            font-size: 1em;
                            background: #f5f5f5;
                            padding: .5em .75em;
                            border: 1px solid #ddd;
                            border-radius: 3px;
                        }
                        .gnews-text {
                            font-weight: bold;
                            color: #004771;
                        }
                        .gnews-inner {
                            display: flex;
                            margin: 0 auto;
                            background: #f1f1f1;
                            padding: 9px 46px;
                            align-items: center;
                            border-radius: 10px;
                            justify-content: center;
                            color: #4175df;
                            font-size: 1.25em;
                        }
                        .gnews-img {
                            margin-right: 15px;
                        }
                    </style>

                    <?php mnky_post_links(); ?>

                    <?php if( ot_get_option('post_date') == 'off' || get_post_meta( get_the_ID(), 'single_post_header', true ) == 'off' ) : ?>
                        <time datetime="<?php echo esc_attr(get_the_date( 'c' )) ?>" itemprop="datePublished"></time><time datetime="<?php echo esc_attr(get_the_modified_date( 'c' )) ?>" itemprop="dateModified"></time>
                    <?php endif; ?>

                    <?php if( ot_get_option('post_author') == 'off' || get_post_meta( get_the_ID(), 'single_post_header', true ) == 'off' ) : ?>
                        <div class="hidden-meta" itemprop="author" itemscope itemtype="http://schema.org/Person"><meta itemprop="name" content="<?php echo esc_html(get_the_author()) ?>"></div>
                    <?php endif; ?>

                    <?php if (get_post_meta( get_the_ID(), 'single_post_header', true ) == 'off') : ?>
                        <meta itemprop="headline " content="<?php the_title(); ?>">
                    <?php endif; ?>

                    <?php if ( has_post_thumbnail() ) :
                        $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        ?>
                        <div class="hidden-meta" itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="<?php echo esc_url($thumb_url_array[0]) ?>"><meta itemprop="width" content="<?php echo esc_html($thumb_url_array[1]) ?>"><meta itemprop="height" content="<?php echo esc_html($thumb_url_array[2]) ?>"></div>
                    <?php elseif( ot_get_option('default_post_image') ) :
                        $thumb_url_array = wp_get_attachment_image_src( ot_get_option('default_post_image'), 'full' );
                        ?>
                        <div class="hidden-meta" itemprop="image" itemscope itemtype="https://schema.org/ImageObject"><meta itemprop="url" content="<?php echo esc_url($thumb_url_array[0]) ?>"><meta itemprop="width" content="<?php echo esc_html($thumb_url_array[1]) ?>"><meta itemprop="height" content="<?php echo esc_html($thumb_url_array[2]) ?>"></div>
                    <?php endif; ?>

                    <div class="hidden-meta" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <div class="hidden-meta" itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?php echo esc_attr(ot_get_option('logo')) ?>">
                            <meta itemprop="width" content="<?php echo esc_attr(str_replace( "px", "", ot_get_option('retina_logo_width') )) ?>">
                            <meta itemprop="height" content="<?php echo esc_attr(str_replace( "px", "", ot_get_option('retina_logo_height') )) ?>">
                        </div>
                        <meta itemprop="name" content="<?php echo esc_attr(get_bloginfo('name')) ?>">
                    </div>
                </article><!-- #post-<?php the_ID(); ?> -->

                <?php if ( get_the_author_meta( 'description' ) && ot_get_option('author_description') != 'off' ) : ?>
                    <div class="author vcard clearfix">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 100); ?>
                        <div class="fn">
                            <?php echo '<a class="url" href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )) .'" title="'. esc_attr(sprintf( __( 'View all posts by %s', 'bitz' ), get_the_author() )) .'" rel="author">'. get_the_author() .'</a>'; ?>
                        </div><!-- .fn -->
                        <div class="author-info description note">
                            <?php the_author_meta( 'description' ); ?>
                        </div><!-- .author-info .description .note -->
                    </div><!-- .author .vcard-->
                <?php endif; ?>

                <?php get_sidebar('after-post'); ?>

                <?php
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                } ?>

            <?php endwhile; ?>

        </div><!-- #content -->

        <div itemscope itemtype="http://schema.org/WPSideBar" id="sidebar" class="float-right">
            <?php get_sidebar('blog'); ?>
        </div>

    </div><!-- #container -->

<?php get_footer(); ?>