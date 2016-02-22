$(document).foundation();

$('.jsSubmit').click(function(e) {
	e.preventDefault();

	var data = $('form').serialize();

	$.ajax({
		type: 'POST',
		data: data,
		url: '/search',
		beforeSend: function() {
			$('.jsResults').empty();
			$('.jsComments').empty();
			$('.jsAjaxLoader').show();
		},
		success: function(data) {
			$('.jsResults').html(data);
		},
		complete: function() {
			$('.jsAjaxLoader').hide();
		},
		error: function(e) {
			$('.jsAjaxLoader').hide();
		}
	})
});

//Search/sorting function for returned comments
var handleComments = function()
{
	for(prop in commentsJson) {
		if (!commentsJson.hasOwnProperty(prop)) {
			continue;
		}

		var html = '<div class="comment ' + commentsJson[prop]['overalRating'] + ' ">';
			html += '<p>' + commentsJson[prop]['comment'] + '</p>';
			html += '</div>';

		$('.jsComments').append(html);
	}

	$('.jsHideComment').change(function() {
		var rating = $(this).data('rating');
		if(this.checked) {
			$('.' + rating).slideUp('slow');	
		}
		else {
			$('.' + rating).slideDown('slow');
		}
	})
}