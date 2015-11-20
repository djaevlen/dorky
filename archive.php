<?php get_header(); ?>
    <div class="container">
			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">
					<?php global $brew_options; ?>
					<?php if ( $brew_options['breadcrumb'] == 0) { ?>

						<?php if (is_category()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Posts Categorized:', 'bonestheme' ); ?></span> <?php single_cat_title(); ?>
							</h1>

						<?php } elseif (is_tag()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
							</h1>

						<?php } elseif (is_author()) {
							global $post;
							$author_id = $post->post_author;
						?>
							<h1 class="archive-title h2">

								<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

							</h1>
						<?php } elseif (is_day()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
							</h1>

						<?php } elseif (is_month()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
								</h1>

						<?php } elseif (is_year()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
								</h1>
						<?php } ?>

					<?php } else { ?>

						<?php get_template_part( 'breadcrumb' ); ?>
						
					<?php } ?>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">
								<header class="article-header">
									<div class="titlewrap clearfix">
										<h1 class="post-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
										<p class="byline vcard">
											by <span class="author"><em><?php the_author_posts_link(); ?> </em></span> - 
											<time class="updated" datetime="<?php get_the_time('Y-m-j') ?>"><?php echo get_the_time(get_option('date_format')) ?></time>
											<span class="sticky-ind pull-right"><i class="fa fa-star"></i></span>
										</p>
									</div>
								</header>

								<section class="entry-content clearfix">
									<?php the_excerpt(''); ?>
									<?php wp_link_pages(
                                		array(
                                		
	                                        'before' => '<div class="page-link"><span>' . __( 'Pages:', 'brew' ) . '</span>',
	                                        'after' => '</div>'
                                		) 
                                	); ?>
								</section>

								<footer class="article-footer clearfix">
									<span class="tags pull-left"><?php printf( '<span class="">' . __( 'in %1$s&nbsp;&nbsp;', 'bonestheme' ) . '</span>', get_the_category_list(', ') ); ?> <?php the_tags( '<span class="tags-title">' . __( '<i class="fa fa-tags"></i>', 'bonestheme' ) . '</span> ', ', ', '' ); ?></span>
                  					<span class="commentnum pull-right"><a href="<?php comments_link(); ?>"><?php comments_number( '<i class="fa fa-comment"></i> 0', '<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %' ); ?></a></span>
                				</footer>

							</article>
					<?php endwhile; endif; ?>
				</div> 
				<?php get_sidebar(); ?>
			</div>
    </div>

<?php get_footer(); ?>
