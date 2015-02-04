jQuery(document).ready(function($) {

// if ($('#show_post_thumbnails:checked').val() !== undefined) {
// 	$('#section-thumbnail_action').show();
// }

// $("#customexcerpt,#customurlname").hide();
//
// $("st_slide_type").change(function() {
// var selected = $("#st_slide_type").find("input[@checked]").val();
// if(selected == "st_0") $("#customexcerpt").show();
// if(selected == "st_1") $("#customurlname").show();
// });

$('#customexcerpt').hide();
$('#slide_thumb_size').hide();
$('#customurlname').hide();
$('#slide_caption').hide();
$('#show_title').hide();

// Load Events

var selected = $('input:radio[name=_st_slide_type]:checked').val(); // get the value from a set of radio buttons

  $('input:radio[name=_st_slide_type]:checked').closest('div').addClass('active');


if (selected == "_st_0" || (selected == "_st_1") || (selected == "_st_3")) {
  $('#customexcerpt,#customurlname,#show_title').show();
} else {
  $('#customexcerpt,#customurlname,#show_title').hide();
}

if (selected == "_st_2") {
  $('#slide_caption').show();
} else {
  $('#slide_caption').hide();
}

if (selected == "_st_0" || selected == "_st_1") {
  $("#slide_thumb_size").fadeIn('400');
}



//
// Change Events
//
$(":radio[name='_st_slide_type']").change(function(){
  var newVal = $(":radio[name='_st_slide_type']:checked").val();

  $('input:radio[name='+$(this).attr('name')+']').closest('div').removeClass('active');
  $(this).closest('div').addClass('active');

  if (newVal == "_st_0" || (newVal == "_st_1") || (newVal == "_st_3")) {
    $('#customexcerpt,#customurlname,#show_title').fadeIn('400');
  } else {
    $('#customexcerpt,#customurlname,#show_title').hide('400');
  }

  if (newVal == "_st_0" || (newVal == "_st_1")) {
    $("#slide_thumb_size").fadeIn('400');
  } else {
    $("#slide_thumb_size").hide();
  }

  if (newVal == "_st_2") {
    $("#slide_caption").fadeIn('400');
  } else {
    $("#slide_caption").hide();
  }


});



});

