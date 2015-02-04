function insertSlideshowShortcode() {
	
	var shortcodeText;
	var typeId = document.getElementById('slideshow_type').value;
	var categoryId = document.getElementById('slideshow_category').value;
	var slideWidth = document.getElementById('slideshow_width').value;
	var slideHeight = document.getElementById('slideshow_height').value;
	var slideSpeed = document.getElementById('slideshow_speed').value;
	var slideAutoPlay = document.getElementById('slideshow_autoplay').value;
	var slidePagination = document.getElementById('slideshow_pagination').value;
	var slidePrevNext = document.getElementById('slideshow_prevnext').value;

	shortcodeText = '[slideshow effect="' + typeId + '" category="' + categoryId + '" width="' + slideWidth +'" height="' + slideHeight +'" autoplay="' + slideAutoPlay +'" speed="' + slideSpeed +'" pagination="' + slidePagination +'" prevnext="' + slidePrevNext +'"]';
		
	if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, shortcodeText);
		//Peforms a clean up of the current editor HTML. 
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
