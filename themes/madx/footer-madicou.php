</div><!-- Close div#app from header.php -->

<footer class="footer">
  <div class="grid-container">
  	<div class="grid-x grid-margin-x grid-margin-y">
      <div class="small-10 small-offset-1 large-12 large-offset-0">
    		<div class="grid-x grid-margin-x grid-margin-y">
          <div class="small-6 medium-4 large-2 cell">
            <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/logo-blue.png" alt="Madico">
          </div>
          <div class="small-6 medium-4 large-2 cell">
            <ul>
              <li class="heading"><h6 class="blue">Company</h6></li>
              <li><a href="/about">About</a></li>
              <li><a href="/about/history">History</a></li>
              <li><a href="/about/madico-cares">Madico Cares</a></li>
              <li><a href="/blog/news">News</a></li>
              <li><a href="/about/careers">Careers</a></li>
              <li><a href="/faqs">FAQs</a></li>
              <li><a href="/about/procurement">Procurement</a></li>
              <li><a href="/about/quality-environment-and-contingency">Quality, Environment & Contingency</a></li>
              <li><a href="/contact">Contact Us</a></li>
            </ul>
          </div>
          <div class="small-6 medium-4 large-2 cell">
            <ul>
              <li class="heading"><h6 class="blue">Dealers</h6></li>
              <li><a href="/dealer-portal">Dealer Portal</a></li>
              <li><a href="/dealer-portal">Become a Dealer</a></li>
              <li><a href="/dealer-portal">Products</a></li>
              <li><a href="/madicou">Madico U</a></li>
              <li><a href="/dealer-portal">Dealer Programs</a></li>
              <li><a href="/distribution">Distribution</a></li>
            </ul>
          </div>
          <div class="small-6 medium-4 large-2 cell">
            <ul>
              <li class="heading"><h6 class="blue">Connect</h6></li>
              <li><a href="https://www.facebook.com/MadicoInc/" target="_blank"><i class="fab fa-facebook"></i>&nbsp; Facebook</a></li>
              <li><a href="https://twitter.com/MadicoInc" target="_blank"><i class="fab fa-twitter"></i>&nbsp; Twitter</a></li>
              <li><a href="https://plus.google.com/+MadicoInc" target="_blank"><i class="fab fa-google-plus-g"></i>&nbsp; Google Plus</a></li>
              <li><a href="https://www.linkedin.com/company/madicoinc" target="_blank"><i class="fab fa-linkedin"></i>&nbsp; LinkedIn</a></li>
              <li><a href="https://www.youtube.com/channel/UCu9s60dm8xsrjHsXtqT49Nw" target="_blank"><i class="fab fa-youtube"></i>&nbsp; YouTube</a></li>
              <li><a href="https://www.instagram.com/clearplex" target="_blank"><i class="fab fa-instagram"></i>&nbsp; Instagram</a></li>
            </ul>
          </div>
          <div class="small-12 medium-4 large-4 cell">
            <h3>Become a Madico Dealer</h3>
            <p>As a Madico Dealer, you'll always have a product and partner you can trust. We offer exceptional products that combine quality, function, and style backed by outstanding support and personal attention through a dedicated, knowledgable team. It's all part of the Madico Experience.</p>
            <div class="btn-box"><a href="" class="btn-yellow solid btn-bad">Become A Dealer</a></div>
          </div>
          <div class="small-12 cell text-center credits">
            <div class="payment-types">
              <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/card-visa.png" alt="visa">
              <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/card-master.png" alt="master card">
              <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/card-discover.png" alt="discover">
              <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/card-amex.png" alt="american express">
              <img src="<?php bloginfo('template_directory'); ?>/dist/assets/images/card-paypal.png" alt="paypal">
            </div>
            <div class="small-12 cell text-center credits">
              <p><?php _e( 'For window film assistance, call a Madico Service Center at +1 (888) 887-2022', 'madx' ); ?></p>
              <p><?php _e( 'For corporate or Specialty Solutions assistance, call +1 (727) 327-2544', 'madx' ); ?></p>
              <address><a target="_blank" href="https://www.google.com/maps/place/9251+Belcher+Rd+N,+Pinellas+Park,+FL+33782/@27.856469,-82.7361847,17z/data=!3m1!4b1!4m5!3m4!1s0x88c2e4cb5830069f:0xa9227c508134fcc1!8m2!3d27.856469!4d-82.733996"><?php _e( '9251 Belcher Road N. Pinellas Park, FL 33782', 'madx' ); ?></a></address>
              <p><?php _e( 'Copyright', 'madx' ); ?> <?php echo date('Y'); ?> <?php _e( 'Madico', 'madx' ); ?><sup>&reg;</sup>, Inc. | <a href="/privacy-policy"><?php _e( 'Privacy Policy', 'madx' ); ?></a></p>
              <p><a href="/wp-content/uploads/2018/11/QMS-0863a_ENG_MADICO-Inc..pdf" target="_blank"><?php _e( 'ISO 9001:2015', 'madx' ); ?></a><?php _e( ' | ISO 14001', 'madx' ); ?></p>
            </div>
          </div>
        </div>
      </div>
  	</div>
  </div>
</footer>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	</div><!-- Close off-canvas content -->
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/postscribe/2.0.8/postscribe.min.js"></script>

<?php wp_footer(); ?>
<script src="//cdn.leadmanagerfx.com/js/mcfx/2201" type="text/javascript"></script>
<script type='text/javascript' src='//cdn.leadmanagerfx.com/phone/js/2201'></script>

<?php wp_footer(); ?>
<?php do_action('madico_scripts'); ?>
</body>
</html>