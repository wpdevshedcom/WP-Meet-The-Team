<?php
	$facebook_username = get_post_meta( get_the_ID(), '_meet_the_team_facebook_username', true );
	$twitter_username = get_post_meta( get_the_ID(), '_meet_the_team_twitter_username', true );
	$linkedin_url = get_post_meta( get_the_ID(), '_meet_the_team_linkedin_url', true );
	$instagram_username = get_post_meta( get_the_ID(), '_meet_the_team_instagram_username', true );
	$googleplus_url = get_post_meta( get_the_ID(), '_meet_the_team_googleplus_url', true );
	$email = get_post_meta( get_the_ID(), '_meet_the_team_email', true );
?>
<ul class="social-profile">
	<?php if( $facebook_username ) { ?>
		<li>
			<a href="https://www.facebook.com/<?php echo $facebook_username; ?>" class="facebook" target="_blank">
				<i class="fa fa-facebook"></i>
			</a>
		</li>
	<?php } ?>
	
	<?php if( $twitter_username ) { ?>
		<li>
			<a href="https://twitter.com/<?php echo $twitter_username; ?>" class="twitter" target="_blank">
				<i class="fa fa-twitter"></i>
			</a>
		</li>
	<?php } ?>
	
	<?php if( $googleplus_url ) { ?>
		<li>
			<a href="<?php echo $googleplus_url; ?>" class="google-plus" target="_blank">
				<i class="fa fa-google-plus"></i>
			</a>
		</li>
	<?php } ?>
	
	<?php if( $linkedin_url ) { ?>
		<li>
			<a href="<?php echo $linkedin_url; ?>" class="linkedin" target="_blank">
				<i class="fa fa-linkedin"></i>
			</a>
		</li>
	<?php } ?>
	
	<?php if( $instagram_username ) { ?>
		<li>
			<a href="https://instagram.com/<?php echo $instagram_username; ?>" class="instagram" target="_blank">
				<i class="fa fa-instagram"></i>
			</a>
		</li>
	<?php } ?>
	
	<?php if( $email ) { ?>
		<li>
			<a href="mailto:<?php echo $email; ?>" class="envelope" target="_blank">
				<i class="fa fa-envelope-o"></i>
			</a>
		</li>
	<?php } ?>
</ul>