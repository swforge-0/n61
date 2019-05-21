function AjaxSelect(url,type,mode,data)
	{
	var html;
	var jqxhr = $.ajax({ 
		url: url,
		type: type,
		data: {mode:mode,data:data},
		cache: false,
		async: false
	})
	.always(function(msg) {
		html = msg
	});
	
	return html;
	}