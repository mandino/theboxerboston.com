<?php 

/* Template Name:Landing Page

*/


 get_header('landing_page'); ?>

  <?php if ( have_rows('landing_page') ) : while( have_rows('landing_page') ) : the_row(); ?>
<!--banner-->
        <?php if(get_row_layout() == 'banner') :?>   
            <div class="landing-page-logo">
                <img src="<?php echo get_sub_field('landing_page_logo')['url']?>" alt=""/>
            </div>    

            <div class="fullpic banner">  
                <img src="<?php echo get_sub_field('banner_image')['url']?>" alt=""/>
            </div>
        <?php endif; ?>
<!--intro titles-->
        <?php if(get_row_layout() == 'intro_with_titles') :?>   
        <div id="rooms" class="section">

            <div class="container">


                <div class="post-content postwidth">

                     <?php
    //                    if ( function_exists('yoast_breadcrumb') ) {
    //                    yoast_breadcrumb('
    //                    <p id="breadcrumbs">','</p>
    //                    ');
    //                    }
                    ?>


                    <div class="intro text-center">
                        <div> <h2 ><?php echo get_sub_field('main_title'); ?></h2> </div>
                        <div> <h3 ><?php echo get_sub_field('sub_title'); ?></h3> </div>
                        <div class="intro-content"><?php echo get_sub_field('intro_content'); ?> </div>
                        <a class="reserve fixeer button intro-btn" id="idp4"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php echo get_option('cebo_genbooklink'); ?>"><?php echo get_sub_field('booking_btn'); ?></a>
                    </div>
        <?php endif; ?> 
<!--content list                    -->
        <?php if(get_row_layout() == 'content_list') :?> 
                    <div class="content-list-title"> <h3 class="text-center"><?php echo get_sub_field('content_list_title'); ?></h3> </div>
            <div class=" content-list">                
                <?php $counter = 0; ?>
                 <?php if ( have_rows('list_type') ) : while( have_rows('list_type') ) : the_row(); ?>
                    <?php if (($counter%2) == 0) { ?>
                        <div class="con-col1">    
                            <p><i class="fas fa-arrow-right"></i>
                            <?php echo get_sub_field('list_options'); ?></p>
                        </div>
                    <?php }else { ?>
                        <div class="con-col2">
                              <p><i class="fas fa-arrow-right"></i>
                            <?php echo get_sub_field('list_options'); ?></p>                     
                        </div>
                    <?php } ?>
                <?php $counter++; endwhile; endif; ?>
            </div>                  
        <?php endif; ?>
<!--Photo Slider                    -->
        <?php if(get_row_layout() == 'photo_slider') : ?>
              <div class="lp-slider">
                <?php if ( have_rows('slider') ) : while( have_rows('slider') ) : the_row(); ?>                 
                    <div class="slider-container">
                        <img src="<?php echo get_sub_field('slider_image')['url'] ?>" alt="<?php echo get_sub_field('slider_caption')?>">
                        <div class="slider-caption"><p ><?php echo get_sub_field('slider_caption')?></p></div>
                        <div class="icon-expand"><img src="<?php bloginfo ('template_url'); ?>/images/expandicon.png"></div>           <div class="lp-slider-next"></div>
                        <div class="lp-slider-prev"></div>
                  </div>

                 <?php endwhile; endif; ?>
             </div>    
        <?php endif; ?>            
                    
    <?php endwhile; endif; ?>
                    
                    
                    
                    
					<div class="imagegal thumbgal">
						
						<ul>
							
							 <?php  query_posts(
							array(
							'post_type' => 'specials',
							'posts_per_page'=> 4
							
							)); if(have_posts()) : while(have_posts()) : the_post(); 
							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
							
							<li>
								
								<a href="<?php the_permalink(); ?>" class="overlink"></a>
					
								<?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>
								
								<div class="from-price">
									<?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
								</div>
								
								<?php } ?>
								
								<?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>"
 style="width: 100%"></a>
								
								<?php } else { ?>
								
								<a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" style="width: 100%"></a>
								
								<?php } ?>
								
								<?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>
								
								<h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>
								
								
								<?php } ?>

								<div class="hover-effect">
									
									<?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>
									
									<h3><a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></a></h3>
									
									<?php } ?>
									
									
									<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
									<a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
								</div>
								
							</li>
						
							
							<?php endwhile; endif; wp_reset_query(); ?>	
								
								<div class="clear"></div>
						</ul>
						
					<div class="clear"></div>
					</div>

			</div>

		</div>

	</div>

<div id="neighborhood" class="section">

		<!-- section containing the to do map -->

	<ul style="" class="right-links right" id="toggles">

		<li class="dine"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=74" title="Dining">Eat</a></li>
		<li class="shop"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=76" title="Dining">Shop</a></li>
		<li class="arts"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=72" title="Dining">Culture</a></li>
		<li class="sights"><a class="linkerd active" href="<?php bloginfo('url'); ?>/?page_id=78" title="Dining">Landmarks</a></li>

	</ul>



		<a href="#features-1" id="link" class="navigateTo page-down"></a>


    <!-- begins map area -->
	<div id="maparea" style="width: 100%; height: 500px; position: relative;">
	</div>
    <!-- begins map area -->
</div>
	
					
<?php get_footer(); ?>