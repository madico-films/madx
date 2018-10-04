import { apiRoot, acfApiRoot } from './config.js';
export default{
	name: 'specialtyProducts',
	data() {
		return{
	    taxonomies: [],
	    taxPosts: [],
	    taxonomy: '',
	    postType: 'specialty',
	    taxParentSlug: 'products',
	    taxChildSlug: '',
	    taxParentId: 0,
	    activeItem: '',
	    singlePost: [],
	    singlePostActive: false,
	    benefits: [],
	    pdfLink: '',
	    taxDescription: ''
		}
	},
	template:`<div id="posts-container">
	            <div class="grid-x grid-margin-x">
								<div class="small-10 small-offset-1 medium-3 medium-offset-0 cell">
									<ul id="tax-menu" class="tax-menu vertical menu">
								    <li v-for="taxonomy in taxonomies" v-bind:class="{active: (activeItem == taxonomy.name.replace(/®/g,'<sup>®</sup>'))}"><a href="#!" @click="getNewTaxPosts" v-html="taxonomy.name"></a></li>
							    </ul>
								</div>
								<div class="small-10 small-offset-1 medium-9 medium-offset-0 cell" id="all-posts" v-if="!singlePostActive">
									<div class="grid-x grid-margin-x grid-margin-y">
										<div class="medium-12 cell breadcrumbs">
											<h5 class="breadcrumb-title">{{ taxParentSlug | changeSlug }} > <span v-html="activeItem"></span></h5>
										</div>
										<div class="medium-12 cell" style="margin-top:0">
											<p class="animated fadeIn" v-html="taxDescription"></p>
										</div>
										<div class="medium-4 cell module auto-height animated fadeIn" v-for="post in taxPosts">
											<a @click="getSinglePost(post.id)"><img :src="post._embedded['wp:featuredmedia'][0].source_url" :alt="post.title.rendered"></a>
											<div class="meta">
												<a @click="getSinglePost(post.id)"><h4 class="blue" v-html="post.title.rendered"></h4></a>
												<div class="content" v-html="$options.filters.limitWords(post.content.rendered,25)"></div>
												<a @click="getSinglePost(post.id)" class="read-more">View Product Details &nbsp;<i class="far fa-long-arrow-right"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="small-10 small-offset-1 medium-9 medium-offset-0 cell" id="single-post" v-if="singlePostActive">
									<div class="grid-x grid-margin-x grid-margin-y">
										<div class="medium-12 cell breadcrumbs">
											<h5 class="breadcrumb-title">{{ taxParentSlug | changeSlug }} > <span v-html="activeItem"></span> > <span v-html="singlePost.title.rendered"></span></h5>
										</div>
										<div class="medium-12 cell module auto-height animated fadeIn">
											<img :src="singlePost._embedded['wp:featuredmedia'][0].source_url" :alt="singlePost.title.rendered">
											<div class="meta">
												<div class="medium-12 cell">
													<div class="grid-x grid-margin-x grid-margin-y">
														<div class="medium-5 medium-offset-1 cell">
															<h4 class="blue" v-html="singlePost.title.rendered"></h4>
															<p class="content" v-html="singlePost.content.rendered"></p>
															<div class="grid-x grid-margin-y" v-if="pdfLink">
																<div class="medium-2 cell text-center">
																	<i class="fal fa-file-pdf"></i>
																</div>
																<div class="medium-10 cell">
																	<a :href="pdfLink" target="_blank">Product Specs Doc</a>
																	<p>Specification Sheet Description</p>
																</div>
															</div>
														</div>
														<div class="medium-4 medium-offset-1 cell">
															<h6>Product Benefits</h6>
															<ul class="product-benefits">
																<li v-for="benefit in benefits"><i class="fas fa-check"></i> &nbsp;{{ benefit.benefit1 }}</li>
															</ul>
														</div>
														<div class="small-12 cell">
															<a class="btn-lt-blue border" @click="scrollToProducts"><i class="fas fa-arrow-alt-left"></i> Back to {{ activeItem }}</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>`,
	created (){
		this.getTaxParentId();
	},
	methods:{
		getTaxParentId: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '-categories')
			  .then(function (response) {
			  	for (var i = 0; i < response.data.length; i++) {
			  		if (response.data[i].link.includes($this.taxParentSlug)) {
			  			$this.taxParentId = response.data[i].parent;
			  			break;
			  		}
			  	}
			    $this.getTaxonomies();
			  }
			)
		},
		getTaxonomies: function(){
			let $this = this;

			axios
			  .get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
			  .then(function (response) {
			    $this.taxonomies = response.data;

			    // Check if url has params before setting activeItem
			    let urlParams = new URLSearchParams(window.location.search);
			    if (urlParams.has('product')) {
			    	$this.activeItem = urlParams.get('product').replace(/®/g,'<sup>®</sup>');	
			    }else{
				    $this.activeItem = $this.taxonomies[0].name.replace(/®/g,'<sup>®</sup>');
			    }
			    console.log($this.activeItem)
				  $this.getTaxPosts($this.taxonomies[0].description);
			  }
			)
		},
		getTaxPosts: function(description){
			let $this = this;
			let taxonomyName = $this.activeItem.toLowerCase().split(' ').join('-');
			
			axios
			  .get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName)
			  .then(function (response) {
			    $this.taxPosts = response.data;
			    $this.taxDescription = description;
			    $this.singlePostActive = false;
			    setTimeout($this.replaceRegMark,300)
			  }
			)
		},
		getNewTaxPosts: function(event){
			let $this = this;
			let taxonomyName = event.target.innerHTML.toLowerCase().split(' ').join('-').replace(/<[^>]+>/g, '');
			
		  axios.all([
		      axios.get(apiRoot + $this.postType + '?_embed&filter['+ $this.postType +'_taxonomies]=' + taxonomyName),
		      axios.get(apiRoot + $this.postType + '-categories?parent=' + $this.taxParentId)
		    ])
		    .then(axios.spread((postRes, acfRes) => {
		      $this.taxPosts = postRes.data;
		      $this.activeItem = event.target.innerHTML;
		      acfRes.data.forEach(function(element) {
		      	if(element.name.replace(/®/g,'<sup>®</sup>') == $this.activeItem)
		        $this.taxDescription = element.description;
		      });
		      $this.singlePostActive = false;
		    }));
		},
		getSinglePost: function(postID){
			let $this = this;

		  axios.all([
		      axios.get(apiRoot + $this.postType + '/' + postID + '?_embed'),
		      axios.get(acfApiRoot + $this.postType + '/' + postID)
		    ])
		    .then(axios.spread((postRes, acfRes) => {
		      $this.singlePost       = postRes.data;
		      $this.benefits         = acfRes.data.acf.film_benefits;
		      $this.pdfLink          = acfRes.data.acf.pdf_link;
		      $this.singlePostActive = true;
		    }));
		},
		scrollToProducts: function(){
			let $this = this;
			
	    $('html, body').animate({
        scrollTop: $("#tax-posts").offset().top
      }, 500, function() {
        $this.singlePostActive = false;
      });
		},
		replaceRegMark: function(){
			let menuItems = document.getElementById('posts-container').querySelectorAll('li a,h4,span');
			for(let i = 0;i < menuItems.length;i++){
				let str = menuItems[i].innerHTML;
				menuItems[i].innerHTML = str.replace(/®/g,'<sup>®</sup>');
			}
		}
	}
};