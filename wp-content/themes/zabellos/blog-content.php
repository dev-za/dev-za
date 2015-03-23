<div class="post" <?php post_class(); ?>>
    <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    <time datetime="<?php echo the_time('Y-m-d')  ?>"><?php echo the_time(get_option( 'date_format' ) ) ?></time>
    <?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
        <?php the_post_thumbnail('medium', array( 'class' => 'img-responsive' )); ?>
    <?php endif; ?>


    <?php the_excerpt(); ?>
    <hr/>
    <div class="blog-post-link clearfix">
        <div class="post-social pull-left">
            <a href="https://twitter.com" class="tw"></a>
            <a href="https://www.pinterest.com" class="p"></a>
            <a href="https://facebook.com" class="f"></a>
            <a href="https://mail.ru" class="mail"></a>
            <a href="http://www.sharethis.com/" class="c"></a>
        </div>
        <?php $commentsNumber = get_comments_number(get_the_ID());?>
        <?php if ( comments_open() && ! is_single()) : ?>
            <a class="comment pull-left" href="<?php comments_link(); ?>"><span></span><?php echo $commentsNumber?>&nbsp
                <?php comments_number( 'comments', 'comment', 'comments' ); ?>
            </a>
        <?php endif; // comments_open() ?>
    </div>
</div>