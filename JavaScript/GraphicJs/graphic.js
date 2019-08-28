$( document ).ready(function() {
    
    var columns = $('#graphic > .column');
    var max = 0;
    var values = [];
    for (var i = 0; i < columns.length; i++) {	
    	values.push($(columns[i]).data('value'));
    }

    max = Math.max(...values);

    for (var i = 0; i < columns.length; i++) {
    	var calculate = ((values[i] * 100) / max);
    	$(columns[i]).animate({
		    height: calculate + '%'
		  }, 1000);

        $(columns[i]).css({
            "width": $('#graphic').data('widthcolumn'), 
            "background-color": $('#graphic').data('colorcolumn')
        });

    	$(columns[i]).append('<p class="value">' + values[i] + '</p>');
    }
});