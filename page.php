<?php get_header(); ?>
    <div class="container" id="content">
        <div class="row">
            <div class="col-md-12 clearfix" role="main">

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
                    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                  
                        <header class="page-head article-header">
                                <h1 class="page-title entry-title" itemprop="headline">
                                    <?php the_title(); ?>
                                </h1>
                        </header> 
                
                        <section class="content" itemprop="articleBody">
                            <?php the_content(); ?>
                        </section> 
                  
                        <footer>
                            
                        </footer> 

                    </article> 
                        
                <?php endwhile; endif; ?>
        
            </div> 
            <?php //get_sidebar(); ?>
        </div> 
    </div> 
<?php get_footer(); ?>
