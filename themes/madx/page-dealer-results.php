<?php 
	/* Template Name: Dealer Results */
	get_header();
  // This takes in a zip code and returns all zip codes in a specific radius
  // using the zip code api: https://www.zipcodeapi.com/API#radius
  $api_root   = 'https://www.zipcodeapi.com/rest';
	$api_key    = $ZIP_CODE_API_KEY;
	$zip_radius = isset($_POST['radius']) ? $_POST['radius'] : 25;
	$zip_code   = $_POST['zip'];
	$type       = isset($_POST['type']) ? $_POST['type'] : array('architectural','auto','safety-security');
	
	$api_url    = $api_root.'/'.$api_key.'/radius.json/'.$zip_code.'/'.$zip_radius.'/miles?minimal';


	$curl = curl_init($api_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$curl_response = curl_exec($curl);
	if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additional info: ' . var_export($info));
	}

	//This will return an array of zip codes in the specified radius
	// header('Content-Type: application/json');
	
	// Because all zip codes come back as strings, we set up an array to push 
	// the new zip code integers into
	$zip_array = array();

	// Change zip code strings to integers and push into zip_array
	foreach ($curl_response as $zipcode) {
		array_push($zip_array, intval($zipcode));
	}
  
	$meta_query_args = array(
		'post_type' => 'dealer',
		'meta_query' => array(
			array(
				'key' => 'zip',
				'value' => $zip_array,
				'compare' => 'IN'
			)
		),
		'tax_query' => array(
			array(
				'taxonomy' => 'types',
				'field'    => 'slug',
				'terms'    => $type
			)
		)
	);
	$meta_query = new WP_Query( $meta_query_args );

	?>

	<section class="results-header" style="background-image: url(<?php the_post_thumbnail_url($post->ID); ?>);">
		<div class="grid-container">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<div class="grid-x">
					
					<find-dealer-page></find-dealer-page>

				</div>
			</div>
		</div>
	</section>


<section class="dealer-results">
	<div class="grid-container">
		<div class="grid-x grid-margin-x grid-margin-y">
			<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
				<h1 class="blue">Dealer Directory Results</h1>
				<p class="subhead">Here is a list of <span class="underline"><?php echo $type; ?></span> dealers within <span class="underline"><?php echo $zip_radius; ?></span> miles of <span class="underline"><?php echo $zip_code; ?></span></p>
			</div>

      <?php if ($meta_query->have_posts()) : while ( $meta_query->have_posts() ) : $meta_query->the_post(); 
      	$dealer_street = get_post_meta($post->ID,'street',true);
      	$dealer_zip    = get_post_meta($post->ID,'zip',true);
      	$dealer_city   = get_post_meta($post->ID,'city',true);
      	$dealer_state  = get_post_meta($post->ID,'state',true);
      	$dealer_phone  = get_post_meta($post->ID,'phone_number',true);
      	$dealer_email  = get_post_meta($post->ID,'email',true);
      	$dealer_name   = get_the_title();
      	$dealer_page   = get_the_permalink();
      	?>

      	<div class="medium-6 large-3 cell module auto-height">
      		<div class="dealer-tag"><i class="fal fa-car"></i></div>
      		<h5 class="blue"><a href="<?php echo $dealer_page; ?>"><?php echo $dealer_name; ?></a></h5>
      		<ul class="dealer-meta">
      			<li><address><i class="fas fa-map-marker-alt"></i> &nbsp;<?php echo $dealer_street; ?><br> <?php echo $dealer_city; ?>, <?php echo $dealer_state; ?> <?php echo $dealer_zip; ?></address></li>
      			<li><address><i class="fas fa-phone"></i> &nbsp;<?php echo $dealer_phone; ?></address></li>
      			<?php if($dealer_email) { ?>
      			  <li class="email"><address><i class="fas fa-envelope"></i> &nbsp;<?php echo $dealer_email; ?></address></li>
      			<?php } ?>
      		</ul>
      	</div>

			<?php endwhile;else : ?>

				<div class="small-10 small-offset-1 large-12 large-offset-0 cell">
					<h4>Sorry, no dealers found in that area. Please try a different zip code or a wider radius.</h4>
				</div>

			<?php endif; wp_reset_postdata(); ?>

		</div>
	</div>
</section>



<?php get_footer();