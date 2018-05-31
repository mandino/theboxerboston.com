<?php 

/* Template Name: Landing Page Template without Map

*/
 get_header(); ?>

  <?php if ( have_rows('landing_page_layout') ) : while( have_rows('landing_page_layout') ) : the_row(); ?>
     <?php if(get_row_layout() == 'landing_page_banner') : ?>   

        <div class="fullpic">

            <div class="slide-header lp-banner-slide">
                <a class="button" onclick="_gaq.push(['_link', this.href]);return false;" href="<?php echo get_sub_field('button_url'); ?>"><?php echo get_sub_field('button_name');?></a>
            </div>
            <img src="<?php echo get_sub_field('landing_page_image')['url']?>" alt="<?php echo get_sub_field('landing_page_image')['title']?>"
         />  
        </div>
     <?php endif; ?>        
<?php endwhile; endif; ?>  



	<div id="page-content" class="section">
		
		<div class="container">

			<div class="post-title section-header">

				<div class="fl">
	
					<?php if(get_option('cebo_shorttitle')) { ?>
					
					<div class="section-pre-title fl"><?php echo get_option('cebo_shorttitle'); ?></div>

					<div class="section-header-divider fl"></div>
					
					<?php } ?>

		
					<h1 class="section-title fr"><?php the_title(); ?></h1>
	
				</div>
	
				<div class="fr">
					
					<ul class="social-buttons">
					<?php if(get_option('cebo_facebook')) { ?>
					
						<li class="facebook"><a href="//facebook.com/<?php echo get_option('cebo_facebook'); ?>" target="_blank"><i class="fa fa-facebook fa-2x"></i><span>facebook</span></a></li>
						
					<?php } ?>
					<?php if(get_option('cebo_twitter')) { ?>
					
						<li class="twitter"><a href="//twitter.com/<?php echo get_option('cebo_twitter'); ?>" target="_blank"><i class="fa fa-twitter fa-2x"></i><span>twitter</span></a></li>
						
					<?php } ?>
					</ul>
	
				</div>
	
			</div>
			
			
				<div class="wonderline"></div>
			     <?php                        
                    if ( function_exists('yoast_breadcrumb') ) {
                        yoast_breadcrumb('
                        <p id="breadcrumbs">','</p>
                        ');
                    }
                ?>  
			<div class="post-content fl">
			
				<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				
					<?php the_content(); ?>
				
				
				<?php endwhile; endif; wp_reset_query(); ?>	
                <!--       exclusive offers-->
                <div class="exc-container">

                    <div class="exc-icons-container">
                        <ul>
                            <?php if ( have_rows('exclusive_offer') ) : while( have_rows('exclusive_offer') ) : the_row(); ?>

                            <li class="exc-icon-items">
                                <span class="exc-icons" > <img src="<?php echo get_sub_field('exc_icons')['url'] ?>" alt="<?php echo get_sub_field('exc_icons')['title'] ?>" /></span>
                                <span class="label"><?php echo get_sub_field('exc_content') ?></span>
                            </li>
                            <?php endwhile; endif; ?>
                        </ul>
                    </div>
                     <?php if ( have_rows('exclusive_offer_button') ) : while( have_rows('exclusive_offer_button') ) : the_row(); ?>            
                    <div class="exc-button">
                         <a class="reserve fixeer button intro-btn exc-btn" id="idp4"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php echo get_sub_field('button_url') ?>"><?php echo get_sub_field('button_text') ?></a>
                    </div>
                    <?php endwhile; endif; ?>
                </div>  
<!--                image slider-->
<!--                -Photo Slider -->
                <div class="slider-container">
                      <div class="lp-slider">
                        <?php if ( have_rows('photo_slider') ) : while( have_rows('photo_slider') ) : the_row(); ?>                 
                            <div class="slider-container">
                                <img  class="items" src="<?php echo get_sub_field('slider_image')['url'] ?>" alt="<?php echo get_sub_field('slider_caption')?>">
                                <div class="slider-caption"><p ><?php echo get_sub_field('slider_caption')?></p></div>
                                <a href="<?php echo get_sub_field('slider_image')['url'] ?>" class="lp-icon-link"><div class="icon-expand"><img src="<?php bloginfo ('template_url'); ?>/images/expandicon.png"></div></a>           
                                <div class="lp-slider-prev"><i class="fa fa-angle-left"></i></div>
                                <div class="lp-slider-next"><i class="fa fa-angle-right"></i></div>

                          </div>

                         <?php endwhile; endif; ?>
                     </div> 
                </div>
<!-- bottom content-->
                <div class="bottom-content">
                    <?php echo the_field('bottom_content'); ?>
                </div>
			</div> 
            

			<div class="sidebar fr">
				
				<a class="button"  onclick="_gaq.push(['_link', this.href]);return false;" href="<?php if(get_post_meta ($post->ID, 'cebo_booklink', true)) { echo get_post_meta ($post->ID, 'cebo_booklink', true); } else { echo get_option('cebo_genbooklink'); } ?>"><?php _e('RESERVE NOW', 'cebolang'); ?></a>
				
				
				<ul class="thumbgal">
						 <?php 
                            $args = array(
                                'numberposts'	=> 3,
                                'post_type'		=> 'page',
                                'meta_key'		=> 'special_featured_list',
                                'meta_value'    => '1'
                            );
                            $lpquery = new WP_Query( $args );
                            $counter = 0;
                        if($lpquery->have_posts()) : while ($lpquery->have_posts()) : $lpquery->the_post();
                            $lpimgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $lpquery->post->ID ), "Full");
                            ?>
                              <?php if($post->ID != $lpquery->post->ID): ?>    
                                      <li>
                                        <a href="<?php the_permalink(); ?>" class="overlink"></a>
                                          <div class="from-price">
                                           <?php while(the_flexible_field('exclusive_offer_button')):
                                                if(get_row_layout() == "button"): ?>
                                                 <?php echo get_sub_field('button_text'); ?>
                                            <?php endif; endwhile; ?>
                                          </div>
                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo tt($lpimgsrc[0], 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $lpquery->post->ID ));?>" style="width: 100%"></a>

                                        <h3><?php the_title(); ?></h3>  	
                                        <div class="hover-effect">

                                            <?php //if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>

                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>


                                            <!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
                                            <a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>

                                        </div>
                                    </li>
                                <?php $counter++;endif; ?>

                         <?php endwhile;endif; wp_reset_query(); ?>
                          <?php                   
                              $climit = 3;
                             if($climit >= $counter){
                                 $climit = $climit - $counter;    
                             }
                          ?>
						<?php 
                            if($climit > 0 ):
                                query_posts(
                                    array(
                                        'post_type'=>'specials',
                                        'posts_per_page'=>$climit
                                    )
                                ); 
                                if(have_posts()) : while(have_posts()) : the_post(); 
                                $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>

                                <li>


                                    <?php if(get_post_meta($post->ID, 'cebo_pricepoint', true)) { ?>

                                    <div class="from-price">
                                        <?php echo get_post_meta($post->ID, 'cebo_pricepoint', true); ?>
                                    </div>

                                    <?php } ?>

                                    <?php if(get_post_meta($post->ID, 'cebo_homethumb', true)) { ?>

                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo tt(get_post_meta($post->ID, 'cebo_homethumb', true), 260, 292); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($post->ID, 'cebo_homethumb', true), ''); ?>"
     ></a>

                                    <?php } else { ?>

                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo tt($imgsrc[0], 260, 292); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $post->ID ));?>" ></a>

                                    <?php } ?>

                                    <?php if(get_post_meta($post->ID, 'cebo_subtagline', true)) { ?>

                                    <h3><?php echo get_post_meta($post->ID, 'cebo_subtagline', true); ?></h3>


                                    <?php } ?>

                                    <div class="hover-effect">

                                        <?php if(get_post_meta($post->ID, 'cebo_tagline', true)) { ?>

                                        <h3><?php echo get_post_meta($post->ID, 'cebo_tagline', true); ?></h3>

                                        <?php } ?>


                                        <!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
                                        <a class="special-external" href="<?php the_permalink(); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
                                    </div>

                                </li>

                                <?php endwhile; endif; wp_reset_query(); ?>
				        <?php endif; ?>			
					
							
						</ul>
		
				</div>
			
			<div class="clear"></div>

		</div>

	</div>


<div class="clear"></div>
	
					
<?php get_footer(); ?>