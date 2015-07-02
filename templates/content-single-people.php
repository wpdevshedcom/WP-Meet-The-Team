<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/meet_the_team/content-single-people.php
 *
 * @author 		WPDev
 * @package 	Meet The Team/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<!--div class="container"-->
	<div class="single-people-item" itemscope itemtype="http://schema.org/People">
		
		<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />
		
		<?php do_action( 'single_people_item_start' ); ?>
			
			<div class="clearfix">
				<div class="images">
					<figure>
						<?php
							$attr = array(
								'class'	=> "blog-attachment-media",
								'alt'	=> trim(strip_tags( get_the_title() )),
								'title'	=> trim(strip_tags( get_the_title() ))
							);
							
							echo get_the_post_thumbnail( get_the_ID(), apply_filters( 'meet_the_team_people_loop_item_thumbnail_size', 'thumbnail' ), $attr );
						?>
					</figure>
				</div>
				
				<div class="summary entry-summary">
					<!--h1 itemprop="name" class="people-title entry-title">	
						<?php the_title(); ?>
					</h1-->

					<div class="people-job-title">
						<?php
							$job_title = get_post_meta( get_the_ID(), '_meet_the_team_job_title', true );
						?>
						
						<h4><?php echo $job_title; ?></h4>
					</div>
					
					<?php
						$phone_number = get_post_meta( get_the_ID(), '_meet_the_team_phone_number', true );
						
						if( $phone_number )	{
							?>
								<div class="people-phone-number">
									<?php echo $phone_number; ?>
								</div>
							<?php
						}
					?>
					
					<?php get_meet_the_team_template_part( 'content', 'social-sharing' ); ?>
				</div>
			</div>
			
			<div class="people-item-description" itemprop="description">
				
				<div class="people-content entry-content">
					<?php echo wpautop( apply_filters( 'the_people_description', get_the_content() ) ); ?>
				</div>
				
			</div>
		
		<?php do_action( 'single_people_item_end' ); ?>
		
	</div>
<!--/div-->