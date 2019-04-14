<?php while ( have_posts() ) : the_post(); ?>

<div class="show-for-small-only">
  <?php get_template_part('template-parts/menus/'.get_post_type().'-header-menu'); ?>
</div>

<div id="header-grid" class="grid-container">
  <div class="grid-x">
    <div class="small-10 small-offset-1 large-12 large-offset-0 show-for-medium-only">
      <?php get_template_part('template-parts/menus/'.get_post_type().'-tablet-menu'); ?>
    </div>
    <div class="small-10 small-offset-1 large-12 large-offset-0 show-for-large">
      <?php get_template_part('template-parts/menus/'.get_post_type().'-header-menu'); ?>
    </div>
  </div>
</div>

<section class="taxonomy-intro">
  <div class="grid-container">
    <div class="grid-x">
      <div class="large-8 medium-10 medium-offset-1 large-offset-2 cell text-center">
        <h1 class="blue"><?php get_field('product_title') ? the_field('product_title') : the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>

<section id="tax-posts" class="taxonomy-products" style="padding-top: 0">
  <div class="grid-container">
    <div class="grid-x">
      <div class="small-10 small-offset-1 large-12 large-offset-0 cell">
        <div class="grid-x grid-margin-x grid-margin-y">
          <?php
            // Get current url and split it up by '/'
            $current_url =  $_SERVER['REQUEST_URI'];
            $url_array   = explode('/', $current_url);
            $url1_split  = explode('-', $url_array[1]);
            $url1_joined = implode(' ', $url1_split);
            $url3_split  = explode('-', $url_array[3]);
            $url3_joined = implode(' ', $url3_split);
            $url4_split  = explode('-', $url_array[4]);
            $url4_joined = implode(' ', $url4_split);
          ?>
          <div class="small-12 large-10 large-offset-1 cell">
            <div id="breadcrumbs" class="breadcrumbs" style="margin:20px 0 0">
              <h5 class="breadcrumb-title"><a href="<?php echo '/'. $url_array[1]; ?>"><?php echo $url1_joined; ?></a>
                <i class="fas fa-chevron-right"></i> <a
                  href="<?php echo '/'. $url_array[1] .'/'. $url_array[2]; ?>"><span><?php echo $url_array[2]; ?></span></a>
                <?php if($url4_joined){ ?><i class="fas fa-chevron-right"></i> <a
                  href="<?php echo '/'. $url_array[1] .'/'. $url_array[2] .'/'. $url_array[3] . '/' . $url_array[4]; ?>"><span><?php echo $url4_joined; ?></span></a>
              </h5><?php } ?>
            </div>
          </div>
          <div id="single-post" class="small-12 large-10 large-offset-1 cell module auto-height" style="margin-top:0">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" style="margin-bottom:0">

            <div class="meta">
              <div class="grid-x grid-margin-x grid-margin-y">
                <?php if( have_rows('product_specs') ): 
									$show_product_colums = 'medium-12 large-6 cell ';
									else:
									$show_product_colums = 'medium-12 cell '; 
								endif; ?>
                <div class="<?php echo $show_product_colums; ?>single-product-details">
                  <h4 style="margin-bottom:20px"><?php _e('Product Details','madx'); ?></h4>
                  <div class="content" style="margin-bottom:0"><?php the_content(); ?></div>
                </div>

                <?php if( have_rows('product_specs') ): ?>
                <div class="<?php echo $show_product_colums; ?>single-product-specs">
                  <div class="table">
                    <div class="grid-x grid-margin-x small-margin-collapse film-performance-measurements align-middle">
                      <div class="cell small-6 medium-7 data-title text-center alt-left">
                        <p>Film Performance Measurements</p>
                      </div>
                      <div class="cell small-6 medium-5 data-title text-center alt-right">
                        <ul class="tabs" v-tabs id="product-tabs">
                          <select id="product-list" @change="openProductTab" style="margin-bottom:0">

                            <?php $rowCount = 0; ?>
                            <?php while ( have_rows('product_specs') ) : the_row();
                              
                              $each_product = get_sub_field_object('specsheet_product_name'); ?>

                            <option value="#panel<?php echo $rowCount; ?>"><?php echo $each_product['value']; ?>
                            </option>
                            <?php $rowCount++;endwhile; ?>

                          </select>
                        </ul>
                      </div>

                      <div id="tabs-content" class="tabs-content small-12 cell" data-tabs-content="product-tabs">
                        <div class="grid-x">

                          <?php $rowCount = 0; ?>
                          <?php while ( have_rows('product_specs') ) : the_row(); ?>

                          <div id="panel<?php echo $rowCount; ?>"
                            class="small-12 cell tabs-panel<?php if($rowCount === 0){echo ' is-active';} ?>">

                            <div class="grid-x">
                              <?php if( have_rows('specsheet_product_specs')):
                                    while ( have_rows('specsheet_product_specs') ) : the_row();
                                      $each_label = get_sub_field('specsheet_data_item_label');
                                      $each_value = get_sub_field('specsheet_data_item_value');
                                      echo '<div class="cell medium-7 small-6 data-element text-center">'.$each_label.'</div>';
                                      echo '<div class="cell medium-5 small-6 data-element text-center">'.$each_value.'</div>';
                                    endwhile; endif; ?>
                            </div>

                          </div>

                          <?php $rowCount++;endwhile; ?>
                        </div>
                      </div> <!-- /#tabs-content -->
                    </div> <!-- /film-performance-measurements -->
                  </div> <!-- /.table -->
                </div>
                <?php endif; // /if statement from line 69 ?>

                <div id="single-benefits" class="medium-12 cell" style="margin-bottom: 30px;">
                  <h4 style="margin-bottom:20px"><?php _e('Benefits','madx'); ?></h4>
                  <div class="grid-x">
                    <?php get_template_part('template-parts/taxonomy/benefits'); ?>
                  </div>
                </div>

                <?php if(get_field('product_secondary_data_title')): ?>
                  <div class="small-12 cell">
                    <h4><?php the_field('product_secondary_data_title'); ?></h4>
                  </div>
                <?php endif; ?>
                
                <?php if(get_field('product_secondary_data_content')): ?>
                  <div class="small-12 cell">
                    <div class="content" style="margin-bottom:0px"><?php the_field('product_secondary_data_content'); ?></div>
                  </div>
                <?php endif; ?>

                <?php if( have_rows('product_downloads') ) : ?>
                
                <div class="small-12 cell">
                  <h4><?php _e(ucfirst(get_post_type()) . ' Resources','madx') ?></h4>
                  <hr>
                  <div class="grid-x grid-margin-y grid-margin-x file-downloads">

                    <?php
                        $dl_count = 1;
                        while ( have_rows('product_downloads') ) : the_row(); ?>

                    <div
                      class="medium-6 large-5<?php if($dl_count % 2 !== 0){echo ' medium-offset-0 large-offset-1';} ?> cell">
                      <div class="grid-x grid-margin-x grid-margin-y">
                        <div class="medium-2 cell text-center">
                          <i class="fal fa-file-pdf"></i>
                        </div>
                        <div class="medium-10 cell">
                          <?php if(get_post_type() === 'specialty'): ?>

                          <a href="#!" class="data-sheet"
                            data-pdf="<?php the_sub_field('document_file'); ?>"><?php the_sub_field('document_title'); ?></a>

                          <?php else: ?>

                          <a href="<?php the_sub_field('document_file'); ?>" class="data-sheet"
                            target="_blank"><?php the_sub_field('document_title'); ?></a>

                          <?php endif; ?>
                          <p><?php the_sub_field('document_download_cta'); ?></p>
                        </div>
                      </div>
                    </div>

                    <?php $dl_count++;endwhile; ?>

                  </div>
                  <hr style="margin-bottom:40px">
                </div>
                <?php endif; ?>

                <p class="go-back"><a href="<?php echo '/'. $url_array[1] .'/'. $url_array[2]; ?>">
                    <button class="btn-lt-blue border"><i class="fas fa-arrow-alt-left"></i>&nbsp; Back</button>
                  </a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<?php if(strpos($current_url, 'specialty-solutions') !== false){ ?>
<?php get_template_part('template-parts/taxonomy/specialty-solutions/contact'); ?>
<?php } ?>

<?php endwhile; ?>

<script type="text/javascript">
var _ss = _ss || [];
var callThisOnReturn = function(resp) {
  if (location.href.indexOf('specialty-solutions/products') > -1) {
    jQuery('.data-sheet').on('click', function() {
      var that = $(this);
      if (resp && resp.contact) {
        jQuery('#specialty-pdf-modal').find('iframe').attr('src', jQuery(this).data('pdf'))
        jQuery('#specialty-pdf-modal').foundation('open');
      } else {
        jQuery('#specialty-form-modal').foundation('open');
        var pdfLink = jQuery(this).data('pdf');
      }
    });
  }
};
_ss.push(['_setResponseCallback', callThisOnReturn]);
_ss.push(['_setDomain', 'https://koi-3QNHJKLJ4E.marketingautomation.services/net']);
_ss.push(['_setAccount', 'KOI-42O9KA253C']);
_ss.push(['_trackPageView']);
(function() {
  var ss = document.createElement('script');
  ss.type = 'text/javascript';
  ss.async = true;
  ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') +
    'koi-3QNHJKLJ4E.marketingautomation.services/client/ss.js?ver=1.1.1';
  var scr = document.getElementsByTagName('script')[0];
  scr.parentNode.insertBefore(ss, scr);
})();
</script>
<!-- Form Modal -->
<div class="reveal" id="specialty-form-modal" v-reveal>
  <h3 class="blue">Please fill out the form to access the product's data sheet</h3>
  <?php echo do_shortcode(get_field('jotspring_code')); ?>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<!-- /Form Modal -->

<!-- PDF Modal -->
<div class="reveal" id="specialty-pdf-modal" v-reveal style="height:100%">
  <iframe src="" style="border:0;height:100%;width:100%"></iframe>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<!-- /PDF Modal -->