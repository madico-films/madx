import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';
import autoPosts from '../components/autoPosts.js';
import safetyFilmTypes from '../components/safetyFilmTypes.js';
import taxTermPosts from '../components/taxTermPosts.js';
import findDealerForm from '../components/findDealerForm.js';



// GLOBAL FILTERS

// Limit words displayed
Vue.filter('limitWords',function (textToLimit,wordLimit){
	var textArray  = textToLimit.split(' ');
	var totalWords = textArray.length;
	var LimitedTextArray = [];

	if (totalWords < wordLimit) {
		return textToLimit
	}else{
		for(var i = 0;i < wordLimit;i++){
			LimitedTextArray.push(textArray[i]);
		}
		return LimitedTextArray.join(' ') + '...';
	}
});

// Limit words displayed
Vue.filter('changeSlug',function (text){
	if (text == 'safety-security') {
		var textSplit = text.split('-').join(" & ");
	}else{
		var textSplit = text.split('-').join(" ");
	}
	return textSplit;
});

// CUSTOM DIRECTIVES

// Add foundation dropdown menu functionality to an element
Vue.directive('dropdown', {
  bind: function (el) {
    new Foundation.DropdownMenu($(el));
  }
});

// Add foundation orbit functionality to an element
Vue.directive('f-orbit', {
    bind: function (el) {
      new Foundation.Orbit($(el))
    },
    unbind: function (el) {
        $(el).foundation.destroy()
    }
})

var newVue = new Vue({
  el: '#app',
  components:{
  	'auto-posts': autoPosts,
  	'safety-film-types': safetyFilmTypes,
  	'tax-term-posts': taxTermPosts,
  	'find-dealer-form': findDealerForm,
  },
  created(){
  	$(document).foundation();
  },
  mounted(){
  	
  },
  methods: {

  }
});
