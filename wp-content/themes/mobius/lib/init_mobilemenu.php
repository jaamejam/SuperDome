<script type="text/javascript">
	jQuery(document).ready(function($) {
	// Create the dropdown base
	jQuery("<select />").appendTo("#nav");

	// Create default option "Go to..."
	jQuery("<option />", {
	   "selected": "selected",
	   "value"   : "",
	   "text"    : "<?php echo of_get_option('menu_text');?>"
	}).appendTo("#nav select");

	// Populate dropdown with menu items
	jQuery("#nav a").each(function() {
	 var el = $(this);
	 var padding = "";
	 for (var i = 0; i < el.parentsUntil('div > ul').length - 1; i++)
	 	padding += "-";
	 jQuery("<option />", {
	    "value"   : el.attr("href"),
      	"text"    : padding + el.text()
	 })
	.appendTo("#nav select");
 	});

	jQuery("#nav select").change(function() {
	  window.location = $(this).find("option:selected").val();
	});
	});
</script>