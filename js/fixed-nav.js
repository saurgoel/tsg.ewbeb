jQuery(document).ready(function ($) {
		var aboveHeight = $('#header').outerHeight();
		$(window).scroll(function()
		{
			if ($(window).scrollTop() > aboveHeight)
			{
				$('#header-menu').addClass('fixed').css('top','0').next()
				.css('padding-top','60px');
				
			} else 
			{
				$('#header-menu').removeClass('fixed').next()
				.css('padding-top','0');
				
			}
		});
});
