<?php
/**
 * The template for displaying people content within loops.
 *
 * Override this template by copying it to yourtheme/meet_the_team/content-team-listing.php
 *
 * @version     1.0
 */
 
global $meet_the_team_loop;

// Store loop count we're currently on
if( empty( $meet_the_team_loop['loop'] ) )
	$meet_the_team_loop['loop'] = 0;

// Store column count for displaying the grid
if( empty( $meet_the_team_loop['columns'] ) )
	$meet_the_team_loop['columns'] = apply_filters( 'loop_columns', 3 );

// Increase loop count
$meet_the_team_loop['loop']++;

// Extra post classes
$classes = array();

// add column class
$column_class = 12 / $meet_the_team_loop['columns'];
$classes[] = 'col-' . $column_class;

if( 0 == ( $meet_the_team_loop['loop'] - 1 ) % $meet_the_team_loop['columns'] || 1 == $meet_the_team_loop['columns'] )
	$classes[] = 'first';

if( 0 == $meet_the_team_loop['loop'] % $meet_the_team_loop['columns'] )
	$classes[]= 'last';


$classes[] = 'people';
?>

<div id="people-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php do_action( 'meet_the_team_before_people_loop_item' ); ?>
	
	<?php
		$profile_link_url = '';
		$enable_profile_page = get_option( 'meet_the_team_enable_profile_page', 1 );
		
		if( $enable_profile_page )
			$profile_link_url = get_the_permalink();
		else
			$profile_link_url = '';
	?>
	
	<div class="people-item">		
		<figure>
			<?php if( $profile_link_url ) { ?>
				<a href="<?php echo esc_url( $profile_link_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
			<?php } ?>
			
				<?php
					$attr = array(
						'class'	=> "blog-attachment-media",
						'alt'	=> trim(strip_tags( get_the_title() )),
						'title'	=> trim(strip_tags( get_the_title() ))
					);
					
					echo get_the_post_thumbnail( get_the_ID(), apply_filters( 'meet_the_team_people_loop_item_thumbnail_size', 'thumbnail' ), $attr );
				?>
				
			<?php if( $profile_link_url ) { ?>
				</a>
			<?php } ?>
		</figure>	
		
		<div class="text-center">
			<header>

				<?php if( $profile_link_url ) { ?>
					<a href="<?php echo esc_url( $profile_link_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
				<?php } ?>
				
					<?php get_meet_the_team_template_part( 'loop/title' ); ?>
					
				<?php if( $profile_link_url ) { ?>
					</a>
				<?php } ?>
				
			</header>

			<div class="people-job-title">
				<?php
					$job_title = get_post_meta( get_the_ID(), '_meet_the_team_job_title', true );
				?>
				
				<h4><?php echo $job_title; ?></h4>
			</div>
			
			<?php get_meet_the_team_template_part( 'content', 'social-sharing' ); ?>
		</div>
	</div>
	
	<?php do_action( 'meet_the_team_after_people_loop_item' ); ?>
	
</div>