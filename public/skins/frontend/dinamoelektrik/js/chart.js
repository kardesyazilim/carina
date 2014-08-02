function Chart( options ) {
	var $canvas = $('#chart'),
		$inner = $('.chart-inner', $canvas),
		$signs = $('.chart-signs', $canvas),
		maxWidth = 500,
		height = 230;
		items = [
			[130, 160, 'ŞUBAT'],
			[90, 120, 'MART'],
			[110, 140, 'NİSAN'],
			[70, 100, 'MAYIS'],
			[110, 140, 'HAZİRAN'],
			[120, 150, 'TEMMUZ']
		]
	this.init = function() {
		$canvas.css({'width': '100%', 'max-width': maxWidth + 'px', 'height': height + 'px', position: 'relative'});
		$inner.css({position: 'absolute', 'bottom': '40px'});
		this.addItemsToChart();
	}
	this.addItemsToChart = function() {
		var length = items.length,
			el1, el2;
		for ( var i = 0; i < length; i++ ) {
			el1 = $('<div class="chart-item1"></div>').height(items[i][0] + 'px');
			el2 = $('<div class="chart-item2"></div>').height(items[i][1] + 'px');
			el3 = $('<div class="sign-item">' + items[i][2] +'</div>');
			$inner.append( el1 ).append( el2 );
			$signs.append( el3 );
		}
	}
}

$(function() {
	var chart = new Chart();
	chart.init();
})