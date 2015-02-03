jQuery(document).ready(function($) {
	var PreSet = st_preset;
	// Color Paletes
	if (PreSet == 'style1') {
		$('.of-color').wpColorPicker({
			palettes: ['#00699e', '#008fd6', '#ea4e06', '#111111', '#008bd1', '#ea4e06']
		});
	} else if (PreSet == 'style2') {
		$('.of-color').wpColorPicker({
			palettes: ['maroon', '#2e2e2e', '#1a1a1a', '#111111', '#b30000', '#1a1a1a']
		});
	} else if (PreSet == 'style3') {
		$('.of-color').wpColorPicker({
			palettes: ['#488d25', '#303030', '#ea4e06', '#111111', '#5db530', '#ea4e06']
		});
	} else if (PreSet == 'style4') {
		$('.of-color').wpColorPicker({
			palettes: ['#00699e', '#292929', '#ea4e06', '#111111', '#008bd1', '#000000']
		});
	} else if (PreSet == 'style5') {
		$('.of-color').wpColorPicker({
			palettes: ['#3f0f57', '#5e1782', '#f05000', '#111111', '#3f0f57', '#f05000']
		});
	} else if (PreSet == 'style6') {
		$('.of-color').wpColorPicker({
			palettes: ['#259d93', '#1d7c74', '#ea4e06', '#111111', '#259d93', 'black']
		});
	} else if (PreSet == 'style7') {
		$('.of-color').wpColorPicker({
			palettes: ['#00699e', '#292929', '#ea4e06', '#111111', '#008bd1', '#000000']
		});
	} else if (PreSet == 'style8') {
		$('.of-color').wpColorPicker({
			palettes: ['#0f1b24', '#2f5775', '#ea4e06', '#111111', '#0f1b24', 'black']
		});
	} else {
		$('.of-color').wpColorPicker({
			palettes: ['#00699e', '#008fd6', '#ea4e06', '#111111', '#008bd1', '#ea4e06']
		});
	}
});