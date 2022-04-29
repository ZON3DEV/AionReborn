/*
* Tooltips v1.1
*/
function tooltips() {
	$('body').append('<div id="tooltip-title"></div>');
	var title;
	function onMouseEnter(e) {
		var el = $(this);
		var pos = el.offset();
		title = el.attr('title');
		if (title == '') return false;
		$("#tooltip-title").show().html(title);
		$("#tooltip-title").css({
			left: pos.left + (el.width() / 2) - ($("#tooltip-title").width() / 2) - 8,
			top: pos.top - ($("#tooltip-title").height() + 16)
		});
		$(this).removeAttr('title');
	}
	function onMouseMove(e) {
		// $("#tooltip-title").css({left:e.pageX+15, top:e.pageY+15});
	}
	function onMouseLeave() {
		$(this).attr('title', title);
		$('#tooltip-title').hide();
	}
	$('[title]').on({
		mouseenter: onMouseEnter,
		mouseleave: onMouseLeave,
		mousemove: onMouseMove
	});
}


/*
* AJAX Button v1.3
*/
function ajaxButton() {
	$(".ajaxbutton").click(function() {
		var el = $(this);
		var url = el.attr('url');
		var conf = el.attr('confirm');
		if (!!conf && !confirm(conf)) return false;
		$.ajax({
			url: url,
			//data: {param: param},
			dataType: "json",
			cache: false,
			async: true,
			beforeSend: function() {
				el.html('');
				el.removeClass();
				el.addClass('ajax-loading');
			},
			success: function(data) {
				el.removeClass();
				if (data.css) el.addClass('ajaxbutton, '+data.css);
				else el.addClass('ajaxbutton, ajax-ok');
				if (data.attrName) el.attr(data.attrName, data.attrValue);
			},
			error: function(data) {
				el.removeClass();
				el.addClass('ajax-error');
			}
		});
	});
}


/*
* Modal dialogs v1.0
*/
function modal() {
	$(".modal-show").filter(function() {
		var el = $(this);
		var id = el.attr('modal');
		el.on('click', function() {
//			$("#"+id).removeClass('none');
			$("#"+id).show();
		});
	});
	$(".modal-close").filter(function() {
		var el = $(this);
		var id = el.attr('modal');
		el.on('click', function() {
//			$("#"+id).addClass('none');
			$("#"+id).hide();
		});
	});
}


/*
* Init
*/
jQuery('document').ready(function() {
	tooltips();
	ajaxButton();
	modal();
});