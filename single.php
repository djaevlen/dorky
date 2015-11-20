<?php get_header(); ?>    
    <div class="container">  
		<div id="content" class="clearfix row">
			<div id="main" class="col-md-8 clearfix" role="main">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

						<header class="article-header">
							<div class="titlewrap clearfix">
								<h1 class="single-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<p class="byline vcard">
									by <span class="author"><em><?php the_author_posts_link() ?></em></span> - 
									<time class="updated" datetime="<?php get_the_time('Y-m-j') ?>"><?php echo get_the_time(get_option('date_format')) ?></time>
									<span class="sticky-ind pull-right"><i class="fa fa-star"></i></span>
								</p>
							</div>
						</header>

						<section class="entry-content single-content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							<?php wp_link_pages(
                            	array(

                                    'before' => '<div class="page-link"><span>' . __( 'Pages:', 'brew' ) . '</span>',
                                    'after' => '</div>'
                            	) 
                            ); ?>
						</section> <?php // end article section ?>

						<footer class="article-footer single-footer clearfix">
							<span class="tags pull-left"><?php printf( '<span class="">' . __( 'in %1$s&nbsp;&nbsp;', 'bonestheme' ) . '</span>', get_the_category_list(', ') ); ?> <?php the_tags( '<span class="tags-title">' . __( '<i class="fa fa-tags"></i>', 'bonestheme' ) . '</span> ', ', ', '' ); ?></span>
          					<span class="commentnum pull-right"><a href="<?php comments_link(); ?>"><?php comments_number( '<i class="fa fa-comment"></i> 0', '<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %' ); ?></a></span>
        				</footer> <?php // end article footer ?>


					</article>

					<?php get_template_part( 'author-info' ); ?>
      				<?php comments_template(); ?>

				<?php endwhile; endif; ?>

			</div> 
			<?php get_sidebar(); ?>
		</div> 
    </div> 
<?php get_footer(); ?>
