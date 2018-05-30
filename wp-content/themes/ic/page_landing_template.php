<?php 

/* Template Name:Landing Page

*/


 get_header('landing_page'); ?>

  <?php if ( have_rows('landing_page') ) : while( have_rows('landing_page') ) : the_row(); ?>
<!--banner-->
        <?php if(get_row_layout() == 'banner') :?>   
            <div class="landing-page-logo">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_sub_field('landing_page_logo')['url']?>" alt="<?php echo get_sub_field('landing_page_logo')['title']?>"/></a>
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
                            <p><i class="fa fa-arrow-right"></i>
                            <?php echo get_sub_field('list_options'); ?></p>
                        </div>
                    <?php }else { ?>
                        <div class="con-col2">
                              <p><i class="fa fa-arrow-right"></i>
                            <?php echo get_sub_field('list_options'); ?></p>                     
                        </div>
                    <?php } ?>
                <?php $counter++; endwhile; endif; ?>
                <div class="clear"></div>
            </div>                  
        <?php endif; ?>
<!--Photo Slider                    -->
        <?php if(get_row_layout() == 'photo_slider') : ?>
              <div class="lp-slider">
                <?php if ( have_rows('slider') ) : while( have_rows('slider') ) : the_row(); ?>                 
                    <div class="slider-container">
                        <img  class="items" src="<?php echo get_sub_field('slider_image')['url'] ?>" alt="<?php echo get_sub_field('slider_caption')?>">
                        <div class="slider-caption"><p ><?php echo get_sub_field('slider_caption')?></p></div>
                        <a href="<?php echo get_sub_field('slider_image')['url'] ?>" class="lp-icon-link"><div class="icon-expand"><img src="<?php bloginfo ('template_url'); ?>/images/expandicon.png"></div></a>           
                        <div class="lp-slider-prev"><i class="fa fa-angle-left"></i></div>
                        <div class="lp-slider-next"><i class="fa fa-angle-right"></i></div>
                        
                  </div>

                 <?php endwhile; endif; ?>
             </div>    
        <?php endif; ?>
<!--accordion                    -->
                        
        <?php if(get_row_layout() == 'accordion_layout') : ?> 
                    <div class="accordion-main-title"><h2><?php the_sub_field('accordion_title'); ?></h2></div>        
            <div class="accordion-layout">        
                <?php if ( have_rows('accordion_type') ) : while( have_rows('accordion_type') ) : the_row(); ?>

                <div class="accordion-section">
                    <?php if(get_sub_field('right_title')) : ?>
                        <div class="accordion acc-right">
                            <div class="accordion-item">
                                <div class="accordion-titlebox">
                                    <div class="accordion-title"><h3><?php the_sub_field('right_title'); ?></h3></div>
                                    <div class="accordion-btn accordion-btn-plus"></div>
                                </div>
                                <div class="accordion-contentbox">
                                    <?php the_sub_field('right_content'); ?>
                                </div>
                            </div>
                         </div>
                     <?php endif; ?>
                    <?php if(get_sub_field('left_title')) : ?>
                         <div class="accordion acc-left">
                            <div class="accordion-item">
                                <div class="accordion-titlebox">
                                    <div class="accordion-title"><h3><?php the_sub_field('left_title'); ?></h3></div>
                                    <div class="accordion-btn accordion-btn-plus"></div>
                                </div>
                                <div class="accordion-contentbox">
                                    <?php the_sub_field('left_content'); ?>
                                </div>
                             </div>            
                        </div>
                    <?php endif; ?>
                     <?php if(get_sub_field('title')) : ?>
                         <div class="accordion acc-full">
                            <div class="accordion-item">
                                <div class="accordion-titlebox">
                                    <div class="accordion-title"><h3><?php the_sub_field('title'); ?></h3></div>
                                    <div class="accordion-btn accordion-btn-plus"></div>
                                </div>
                                <div class="accordion-contentbox">
                                    <?php the_sub_field('content'); ?>
                                </div>
                             </div>            
                        </div>
                     <?php endif; ?>    
                </div>      
                 <?php endwhile; endif; ?> 
        </div>        
        <?php endif; ?>            
                    
<!--    special offers                -->
       <?php if(get_row_layout() == 'special_offers') : ?>              
                    <div class="special-offers-title text-center"><h2><?php the_sub_field('special_offers_title'); ?></h2></div>
					<div class="imagegal thumbgal">
						
						<ul>
							
							 <?php  //query_posts(
							//array(
							//'post_type' => 'specials',
							//'posts_per_page'=> 4
                            if ( have_rows('special_offers_layout') ) : while( have_rows('special_offers_layout') ) : the_row();
							//)); //if(have_posts()) : while(have_posts()) : the_post(); 
                            $id = get_sub_field('special_offer_items');
							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), "Full"); ?>
							
							<li>
								
								<a href="<?php echo get_permalink($id); ?>" class="overlink"></a>
					
								<?php if(get_post_meta($id, 'cebo_pricepoint', true)) { ?>
								
								<div class="from-price">
									<?php echo get_post_meta($id, 'cebo_pricepoint', true); ?>
								</div>
								
								<?php } ?>
								
								<?php if(get_post_meta($id, 'cebo_homethumb', true)) { ?>
								
								<a href="<?php echo get_permalink($id); ?>"><img src="<?php echo tt(get_post_meta($id, 'cebo_homethumb', true), 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text(get_post_meta($id, 'cebo_homethumb', true), ''); ?>"
 style="width: 100%"></a>
								
								<?php } else { ?>
								
								<a href="<?php echo get_permalink($id); ?>"><img src="<?php echo tt($imgsrc[0], 262, 290); ?>" alt="<?php echo get_custom_image_thumb_alt_text('', get_post_thumbnail_id( $id ));?>" style="width: 100%"></a>
								
								<?php } ?>
								
								<?php if(get_post_meta($id, 'cebo_subtagline', true)) { ?>
								
								<h3><?php echo get_post_meta($id, 'cebo_subtagline', true); ?></h3>
								
								
								<?php } ?>

								<div class="hover-effect">
									
									<?php if(get_post_meta($id, 'cebo_tagline', true)) { ?>
									
									<h3><a href="<?php echo get_permalink($id); ?>"><?php echo get_post_meta($id, 'cebo_tagline', true); ?></a></h3>
									
									<?php } ?>
									
									
									<!-- , and Hotel Oceana Tote Bag., and breakfast at the Hotel. -->
									<a class="special-external" href="<?php echo get_permalink($id); ?>"><i class="fa fa-chevron-right fa-lg"></i></a>
								</div>
								
							</li>
						
							
							<?php endwhile; endif; ?>	
								
								<div class="clear"></div>
						</ul>
						
					<div class="clear"></div>
                </div>
    <?php endif; ?>
    <?php endwhile; endif; ?>                
			</div>

		</div>

	</div>

<div id="neighborhood" class="section lp-neighborhood">

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

    <div class="qoute-container">
         
        
            <div class="quote lp-qoute">

                <a class="quote-nav quote-next"><i class="fa fa-angle-right"></i></a>
                <a class="quote-nav quote-prev"><i class="fa fa-angle-left"></i></a>

                <div class="ico-quote quote-left fl"></div>
                 <?php if ( have_rows('testimonial_section') ) : ?>  
                    <div id="cbp-qtrotator" class="cbp-qtrotator">
                        <?php  while( have_rows('testimonial_section') ) : the_row();?>
                            <div class="cbp-qtcontent">
                             <div class="testimonial-image"><img src="<?php echo get_sub_field('testimonial_image')['url']?>"> </div>  
                            <blockquote>
                                  <p><?php echo get_sub_field('testimonial_post')->post_content ; ?></p>
                                  <footer><?php echo get_sub_field('testimonial_post')->post_title; ?></footer>
                                </blockquote>
                            </div>
                        <?php endwhile; ?>


                    </div>
                  <?php endif; ?> 

                </div>
           <div class="ico-quote quote-right fr"></div>
        

    </div>	
<?php include (TEMPLATEPATH . '/library/super-map.php'); ?>
<?php get_footer(); ?>