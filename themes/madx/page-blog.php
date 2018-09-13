<?php 
/* Template Name: Blog */
get_header(); ?>

<section class="page-hero small" style="background-image: url(<?php the_field('blog_hero'); ?>);">

	<?php get_template_part('template-parts/menus/auto-header-menu'); ?>

</section>

<main>
	<section class="blog-container">
		<div class="grid-container">
			<div class="grid-x grid-margin-x grid-margin-y">
				
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			$args = array(
				'post_type'      => 'post',
			  'posts_per_page' => 9,
			  'paged'          => $paged
			);
			 
			$post_query = new WP_Query( $args );
			 
			if ( $post_query->have_posts() ) {
			  while ( $post_query->have_posts() ) {
			    $post_query->the_post(); ?>
			 
			    <div class="medium-4 cell module auto-height">
			    	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) ); ?></a>
			    	<div class="meta">
			    		<p class="post-date"><i class="fal fa-calendar-alt"></i> &nbsp; <?php the_date(); ?></p>
			    		<a href="<?php the_permalink(); ?>"><h4 class="blue"><?php the_title(); ?></h4></a>
			    		<div class="content">
			    			<?php echo wp_trim_words(get_the_content(),20,''); ?>
			    		</div>
			    		<a href="<?php the_permalink(); ?>" class="read-more">Read More &nbsp;<i class="far fa-long-arrow-right"></i></a>
			    	</div>
			    </div>
			 
			<?php } //endwhile ?>
				<div class="pagination small-12 cell">
			    <?php 
		        echo paginate_links( array(
		            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		            'total'        => $post_query->max_num_pages,
		            'current'      => max( 1, get_query_var( 'paged' ) ),
		            'format'       => '?paged=%#%',
		            'show_all'     => true,
		            'type'         => 'plain',
		            'end_size'     => 2,
		            'mid_size'     => 1,
		            'prev_next'    => true,
		            'prev_text'    => sprintf( '<i class="fal fa-long-arrow-left"></i>&nbsp; %1$s', __( 'Previous', 'text-domain' ) ),
		            'next_text'    => sprintf( '%1$s &nbsp;<i class="fal fa-long-arrow-right"></i>', __( 'Next', 'text-domain' ) ),
		            'add_args'     => false,
		            'add_fragment' => '',
		        ) );
			    ?>
				</div>
		  <?php }wp_reset_postdata(); ?>

			</div>
		</div>
	</section>
</main>

<?php get_footer();