/* =================================
------------------------------------
	WebUni - Education Template
	Version: 1.0
 ------------------------------------ 
 ====================================*/


'use strict';


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut(); 
	$("#preloder").delay(400).fadeOut("slow");


	/*------------------
		Gallery item
	--------------------*/
	if($('.course-items-area').length > 0 ) {
		var containerEl = document.querySelector('.course-items-area');
		var mixer = mixitup(containerEl);
	}

});

(function($) {

	/*------------------
		Navigation
	--------------------*/
	$('.nav-switch').on('click', function(event) {
		$('.main-menu').slideToggle(400);
		event.preventDefault();
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});


	/*------------------
		Realated courses
	--------------------*/
    $('.rc-slider').owlCarousel({
		autoplay:true,
		loop: true,
		nav:true,
		dots: false,
		margin: 30,
		navText: ['', '<i class="fa fa-angle-right"></i>'],
		responsive:{
			0:{
				items:1
			},
			576:{
				items:2
			},
			990:{
				items:3
			},
			1200:{
				items:4
			}
		}
	});


    /*------------------
		Accordions
	--------------------*/
	$('.panel-link').on('click', function (e) {
		$('.panel-link').removeClass('active');
		var $this = $(this);
		if (!$this.hasClass('active')) {
			$this.addClass('active');
		}
		e.preventDefault();
	});



	/*------------------
		Circle progress
	--------------------*/
	$('.circle-progress').each(function() {
		var cpvalue = $(this).data("cpvalue");
		var cpcolor = $(this).data("cpcolor");
		var cptitle = $(this).data("cptitle");
		var cpid 	= $(this).data("cpid");

		$(this).append('<div class="'+ cpid +'"></div><div class="progress-info"><h2>'+ cpvalue +'%</h2><p>'+ cptitle +'</p></div>');

		if (cpvalue < 100) {

			$('.' + cpid).circleProgress({
				value: '0.' + cpvalue,
				size: 176,
				thickness: 9,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		} else {
			$('.' + cpid).circleProgress({
				value: 1,
				size: 176,
				thickness: 9,
				fill: cpcolor,
				emptyFill: "rgba(0, 0, 0, 0)"
			});
		}

	});


	$('form .site-btn').click(function(event){

		var err = false;
		var form = $('.intro-newslatter');
		var fd = $('.intro-newslatter').serializeArray();

        jQuery.each(fd, function(i, val) {

        	let inp = form.find('input[name='+val.name+']');
		  	let pattern = new RegExp(inp.attr('pattern'), inp.attr('flags'));
		  	let inpValue = val.value.toString().trim();
		  	let result = inpValue.match(pattern);

		  	if (!result) {

		  		$('.modal .modal-title').text('Ошибка');
		  		$('#err-message').text(inp.attr('mes'));
		  		$('.modal').modal('show');

		  		err = true;
		  		return false;
		  	}
			
		});


        if (!err) {
        	
        	//console.log(form.serialize());

	        $.ajax({
	            url: form.attr('action'),
	            data: form.serialize(),
	            //dataType: "json",
	            type: "POST",
	            success: function(json){
	            	console.log(json);

	            	if (json.result == true) {
	            		$('.modal .modal-title').text('Поздравляем');
	            		$('#err-message').text('Вы зарегестрированы');
		  				$('.modal').modal('show');
	            	}

	            }
	        });

        }

        event.preventDefault();

	});



})(jQuery);

