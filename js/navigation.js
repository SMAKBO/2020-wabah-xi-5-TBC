/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
jQuery(document).ready(function(){

	jQuery('#site-navigation ul:first-child').clone().appendTo('.responsive-mainnav');

	jQuery('#main-nav-button').click(function(event){
		event.preventDefault();
		jQuery('.responsive-mainnav').slideToggle();
		jQuery('ul.sub-menu').show();
	});
	
});
jQuery(document).ready(function(){

	jQuery('#top-navigation ul:first-child').clone().appendTo('.responsive-topnav');

	jQuery('#top-nav-button').click(function(event){
		event.preventDefault();
		jQuery('.responsive-topnav').slideToggle();
		jQuery('ul.sub-menu').show();
	});
	
});




jQuery('.top-navigation ul.sub-menu').hide();
jQuery('.top-navigation li').hover( 
	function() {
		jQuery(this).children('ul.sub-menu').slideDown('fast');
	}, 
	function() {
		jQuery(this).children('ul.sub-menu').hide();
	}
);

jQuery('.main-navigation ul.sub-menu').hide();
jQuery('.main-navigation li').hover( 
	function() {
		jQuery(this).children('ul.sub-menu').slideDown('fast');
	}, 
	function() {
		jQuery(this).children('ul.sub-menu').hide();
	}
);