<?php 
$term = get_queried_object();

if ($term->slug == 'case-studies' || $term->slug == 'safety-security') {
	include( locate_template( '/template-parts/taxonomy/residential/residential-'.$term->slug.'.php', false, false ) );
}else if($term->slug == 'anti-intrusion' || $term->slug == 'natural-disaster-mitigation'){
  include( locate_template( '/template-parts/taxonomy/residential/residential-safety.php', false, false ) );
}else{ ?>

	<div class="show-for-small-only">
		<?php get_template_part('template-parts/menus/residential-header-menu'); ?>
	</div>

	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
				<?php get_template_part('template-parts/menus/residential-tablet-menu'); ?>
			</div>
			<div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
				<?php get_template_part('template-parts/menus/residential-header-menu'); ?>
			</div>
		</div>
	</div>

<section class="taxonomy-intro">
	<div class="grid-container">
		<div class="grid-x">
			<div class="large-8 small-10 small-offset-1 large-offset-2 cell text-center">
				<h1 class="blue"><?php the_field('intro_heading',$term); ?></h1>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('intro_subhead',$term); ?></p>
			</div>
		</div>
		<div class="grid-x">
					
			<?php get_template_part('template-parts/taxonomy/benefits'); ?>

		</div>
	</div>
</section>

<?php if ($term->slug == 'decorative') { ?>
	<section class="deco-example" style="padding-top:0">
		<?php $deco_image = get_field('decorative_image1',$term); ?>
		<img src="<?php echo $deco_image['url']; ?>" alt="<?php echo $deco_image['alt']; ?>" style="width:100%">
	</section>
<?php } ?>

<section id="tax-posts" class="taxonomy-products" style="padding-top: 0">
	<div class="grid-container">
		<div class="grid-x">
			<div class="small-10 large-8 small-offset-1 large-offset-2 text-center">
				<h2 class="blue"><?php the_field('products_heading',$term); ?></h2>
				<aside class="yellow-underline center"></aside>
				<p class="subhead"><?php the_field('products_subhead',$term); ?></p>
			</div>
		</div>

      <?php if($term->slug == 'solar') { ?>
        
        <?php include(locate_template('template-parts/taxonomy/product-tabs.php')); ?>

      <?php }else if($term->slug == 'decorative') { ?>
        
        <?php include(locate_template('template-parts/taxonomy/decorative-posts.php')); ?>

      <?php } ?>

	</div>
</section>

<?php if ($term->slug == 'decorative') { ?>
	<section class="deco-example" style="padding:0">
		<?php $deco_image = get_field('decorative_image2',$term); ?>
		<img src="<?php echo $deco_image['url']; ?>" alt="<?php echo $deco_image['alt']; ?>" style="width:100%">
	</section>
<?php } ?>

<?php get_template_part('/template-parts/taxonomy/faqs'); ?>

<?php if($term->slug == 'solar') { ?>
<?php get_template_part('/template-parts/taxonomy/find-film'); ?>
<?php }} ?>

<?php get_template_part('/template-parts/top-level-page/find-dealer'); ?>