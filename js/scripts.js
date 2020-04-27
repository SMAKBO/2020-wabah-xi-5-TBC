jQuery(function() {
	jQuery('.nav-tabs a:first').tab('show');
});
/* SEARCH BOX */

jQuery(document).ready(function(){
  jQuery(".awaken-search-button-icon").click(function(){
    jQuery(".awaken-search-box-container").toggle('fast');
  }
  );
});