$(window).load(function(){
    
    
    
    /* ---------- Functions ---------- */
    
    
    
    /* jQuery Animations */
    
    jQuery.easing['jswing'] = jQuery.easing['swing'];

    jQuery.extend( jQuery.easing,
    {
        easeInOutExpo: function (x, t, b, c, d) {
            if (t==0) return b;
            if (t==d) return b+c;
            if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
            return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
        }
    });
    
    
    
    /* Headline Animations */
    
    function headline_animate() {
    
        setTimeout( function(){
            $('#headline').animate({
                opacity: 1,
                marginTop: 0
            },2000,'easeInOutExpo');
        },3000);
    
    }
    
    //headline_animate();
    
    
    
    /* Set Menu Animations */
    
    function open_menu() {
        console.log("open_menu was triggered");
		// Change height of menu //
        $('#menu').css('height','100%');
    
        // Switch buttons //
        $('#menu #wrap .open').hide();
        setTimeout( function(){
            $('#menu #wrap .close').show(1000);
        },1000);
        
		// Show cover //
        $('#menu #cover').show();
        $('#menu #cover').animate({
            opacity: 1,
            width: '50%'
        }, 700, 'easeInOutExpo');
        
		// Extend wrap //
        setTimeout( function(){
            $('#menu').addClass('opened');
        },600);
        setTimeout( function(){
            $('#menu #wrap').addClass('opened');
        },400);
        
		// Slide menu out //
        $('#menu').animate({
            width: '100%'
        }, 1000, 'easeInOutExpo');
        
        // Show items
        setTimeout( function(){
            $('#items').slideDown(500, 'easeInOutExpo');
        },1000);
        
        // Hide overflow
        setTimeout( function(){
            $('body').addClass('no-overflow');
        },1000);
        
		// Change logo to white
        //setTimeout( function(){
            //$('svg#logo *').css('fill','#FFF');
        //},500);
        
		// Change button to white
        setTimeout( function(){
            $('#menu #wrap .close svg *').css('fill','#000');
        },500);
    
    }
    
    function close_menu() {
        
		// Switch buttons //
        $('#menu #wrap .close').fadeOut();
        setTimeout( function(){
            $('#menu #wrap .open').fadeIn();
        },1000);
        
		// Hide cover //
        $('#menu #cover').animate({
            opacity: 0,
            width: 0
        }, 700, 'easeInOutExpo');
        
		// Condense wrap //
        setTimeout( function(){
            $('#menu').removeClass('opened');
        },600);
        setTimeout( function(){
            $('#menu #wrap').removeClass('opened');
        },600);
        
        // Hide items
        $('#items').fadeOut();
        
		// Slide menu in //
        $('#menu').animate({
            width: '200px'
        }, 1000, 'easeInOutExpo');
        
        // Hide overflow
        setTimeout( function(){
            $('body').removeClass('no-overflow');
        },1000);
        
        // Change height of menu
        setTimeout( function(){
            $('#menu').css('height','auto');
        },1100);
        
		// Change logo to black //
        //setTimeout( function(){
            //$('svg#logo path').css('fill','#000');
            //$('svg#logo text').css('fill','#000');
        //},500);
        
    }
    
    function esc_key() {
        
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                close_menu();
            }
        });
        
    }
    
    
    
    /* Menu 'Open' Icon Animation */
    
    function menu_hover() {

        $('#menu #wrap .open').mouseover(function(){
            $('#menu #wrap .open svg g rect:nth-child(1)').attr('width','20');
            $('#menu #wrap .open svg g rect:nth-child(3)').attr('width','10');
        });

        $('#menu #wrap .open').mouseout(function(){
            $('#menu #wrap .open svg g rect:nth-child(1)').attr('width','26');
            $('#menu #wrap .open svg g rect:nth-child(3)').attr('width','26');
        });

    }
    
    
    
    /* Services Slider Functions */
    
    function switch_slides() {
    
        $('.slide:not(:first-of-type) .prev').click(function(event){
            
            event.preventDefault();
            
            var number = $(this).parents('.slide').prev().attr('number');
            var offset = number * 100;
            var sub_item = $('a[number="'+number+'"');
            
            $(this).parents('.slide').fadeOut();
            $(this).parents('.slide').removeClass('active');
            $(this).parents('.slide').prev().fadeIn();
            $(this).parents('.slide').prev().addClass('active');
            
            $('.current').removeClass('current');
            $(sub_item).addClass('current');
            
            $(this).parents('.slider').animate({
                left: '-'+offset+'%'
            }, 1000, 'easeInOutExpo');
            
        });
    
        $('.slide:not(:last-of-type) .next').click(function(event){
            
            event.preventDefault();
            
            var number = $(this).parents('.slide').next().attr('number');
            var offset = number * 100;
            var sub_item = $('a[number="'+number+'"');
            
            $(this).parents('.slide').fadeOut();
            $(this).parents('.slide').removeClass('active');
            $(this).parents('.slide').next().fadeIn();
            $(this).parents('.slide').next().addClass('active');
            
            $('.current').removeClass('current');
            $(sub_item).addClass('current');
            
            $(this).parents('.slider').animate({
                left: '-'+offset+'%'
            }, 1000, 'easeInOutExpo');
            
        });
    
    }
    
    function submenu_switch_slides() {
    
        $('.submenu a').click(function(event){
            
            event.preventDefault();
            
            var number = $(this).attr('number');
            var offset = number * 100;
            var current = $('.active').attr('number');
            var current_sub = $('.current');
            
            if(current > number) {
                var next = $('div[number="'+number+'"]');
                $('.active').fadeOut();
                $('.active').removeClass('active');
                $(next).fadeIn();
                $(next).addClass('active');
            }
            
            if(current < number) {
                var prev = $('div[number="'+number+'"]');
                $('.active').fadeOut();
                $('.active').removeClass('active');
                $(prev).fadeIn();
                $(prev).addClass('active');
            }
            
            $(current_sub).removeClass('current');
            $(this).addClass('current');
            
            $('.slider').animate({
                left: '-'+offset+'%'
            }, 1000, 'easeInOutExpo');
            
        });
    
    }
    
    function toggle_controls() {
    
        $('.slider').mouseenter(function(){
        
            $('#controls').fadeIn();
        
        });
    
        $('.slider').mouseleave(function(){
        
            $('#controls').fadeOut();
        
        });
    
    }
    
    
    
    /* Portfolio Hover Effect */
    
    function project_hover() {
    
        $('.project .container .info').mouseenter(function(){
            
            $(this).animate({
                opacity: 1
            }, 50, 'easeInOutExpo');
            
        });
    
        $('.project .container .info').mouseleave(function(){
            
            $(this).animate({
                opacity: 0
            }, 50, 'easeInOutExpo');
            
        });
    
    }
    
    
    
    /* Set Modal Animations */
    
    function empty_details() {
        
        $('.name').empty();
        $('.service').empty();
        $('.modal .wrap .video').empty();
        
    }
    
    function load_video(name,service,id,order,type) {
        
        $('.loading').fadeOut(2000,'easeInOutExpo');
        
        empty_details();
        
        $('.name').append(name);
        $('.service').append(service);
        $('.modal .wrap .controls.prev').attr('target',parseInt(order)-1);
        $('.modal .wrap .controls.next').attr('target',parseInt(order)+1);
        if(type == 'None') {
            $('.modal .wrap .video').append('<div></div>');
        }
        if(type == 'Vimeo') {
            $('.modal .wrap .video').append('<iframe src="http://player.vimeo.com/video/'+id+'?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;color=ffffff&amp;autoplay=1" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        }
        if(type == 'Youtube') {
            $('.modal .wrap .video').append('<iframe width="500" height="281" src="http://www.youtube.com/embed/'+id+'?&autoplay=1" frameborder="0" allowfullscreen></iframe>');
        }
        
    }
    
    function change_video(target) {
        
        $('.modal .wrap .video').empty();
        $('.modal .wrap .video').append('<div class="loading"></div>');
        $('.modal .wrap .video .loading').fadeIn(500,'easeInOutExpo');
        
        var name = $('[order="'+target+'"]').attr('name');
        var service = $('[order="'+target+'"]').attr('service');
        var id = $('[order="'+target+'"]').attr('id');
        var order = target;
        var type = $('[order="'+target+'"]').attr('type');
        
        $('.header').animate({
            opacity: 0
        });
        $('.grid').animate({
            opacity: 0
        });
        
        setTimeout( function(){
            $('.modal .wrap .video').slideToggle(500,'easeInOutExpo');
        },500);
        
        setTimeout( function(){
            load_video(name,service,id,order,type);
            $('.modal .wrap .video').slideToggle(500,'easeInOutExpo');
        },1000);
        
        setTimeout( function(){
            $('.header').animate({
                opacity: 1
            });
            $('.grid').animate({
                opacity: 1
            });
        },1500);
    }
    
    function open_modal(name,service,id,order,type) {
        
        // Prevent Scrolling
        $('body').addClass('no-overflow');
        
        // Append details
        load_video(name,service,id,order,type);
        
        // Fade modal in
        $('.modal').fadeIn();
        
        // Slide video in
        setTimeout( function(){
            $('.modal .wrap').slideDown(1000,'easeInOutExpo');
        },500);
        
        // Fade controls in
        setTimeout( function(){
            $('.modal .wrap .controls').fadeIn();
        },1500);
    
    }
    
    function close_modal() {
        
        // Restore scrolling
        $('body').removeClass('no-overflow');
        
        // Empty details
        empty_details();
        
        // Fade modal out //
        $('.modal').fadeOut();
        
        // Hide the rest
        $('.modal .wrap').css('display','none');
        $('.modal .wrap .controls').css('display','none');
        
    }
    
    function esc_key_modal() {
        
        $(document).keyup(function(e) {
            if (e.keyCode == 37) {
                
                var target = $('.modal .wrap .controls.prev').attr('target');

                var count = $('.row .project').length;

                if(target == 0) {
                    var target = count;
                }
        
                var check_type = $('[order="'+target+'"]').attr('type');
        
                while(check_type == 'None' || check_type == 'Link') {
                    var target = parseInt(target);
                    var target = target - 1;
                    if(target == 0) {
                        var target = count;
                    }
                    var check_type = $('[order="'+target+'"]').attr('type');
                }
                
                change_video(target);
            }
        });
        
        $(document).keyup(function(e) {
            if (e.keyCode == 39) {
                
                var target = $('.modal .wrap .controls.next').attr('target');

                var count = $('.row .project').length;

                if(target > count) {
                    var target = 1;
                }
        
                var check_type = $('[order="'+target+'"]').attr('type');
        
                while(check_type == 'None' || check_type == 'Link') {
                    var target = parseInt(target);
                    var target = target + 1;
                    if(target > count) {
                        var target = 1;
                    }
                    var check_type = $('[order="'+target+'"]').attr('type');
                }

                change_video(target);
                
            }
        });
        
        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                close_modal();
            }
        });
        
        $('.overlay').click(function() {
            close_modal();
        });
        
    }
    
    
    
    /* Scroll to top of page */
    
    function scroll_to_top() {
        
        $('html, body').animate({
            scrollTop: 0
        }, 'slow', 'easeInOutExpo');
        
        return false;
        
    }
    
    
    
    /* Popup */
    
    function popup(target) {
        
        var left  = ($(window).width()/2)-(600/2);
        var top   = ($(window).height()/2)-(370/2);
        
        window.open(target, 'popupWindow', 'location=no,width=600,height=370,scrollbars=no,top='+top+',left='+left);
        
    }
    
    
    
    /* Lazy Load */
    
    function lazyload() {
        
        $(window).scroll(function() {
            
            $('.lazy:below-the-fold').each(function(){

                $(this).css('opacity','1');
            
            });

        });
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* ---------- Events ---------- */
    
    
    
    /* Activate Menu Animations */
    
    $('#menu #wrap .open').click(function(event) {
        
        event.preventDefault();
        
		open_menu();
        
	});
    
    $('#menu #wrap .close').click(function(event) {
        
        event.preventDefault();
        
		close_menu();
        
	});
    
    esc_key();
    
    
    
    /* Menu 'Open' Icon Animation */
    
    menu_hover();
    
    
    
    /* Services Slider */
    
    switch_slides();
    submenu_switch_slides();
    toggle_controls();
    
    
    
    /* Project Hover */
    
    project_hover();
    
    
    
    /* Activate Modal Animations */
    
    $('.modal-open').click(function(event) {
        
        event.preventDefault();
        
        var name = $(this).attr('name');
        var service = $(this).attr('service');
        var id = $(this).attr('id');
        var order = $(this).attr('order');
        var type = $(this).attr('type');
        
		open_modal(name,service,id,order,type);
        
	});
    
    $('.modal-close').click(function(event) {
        
        event.preventDefault();
        
		close_modal();
        
	});
    
    $('.modal .wrap .controls.prev').click(function(event) {
        
        event.preventDefault();
        
        var target = $(this).attr('target');
        
        var count = $('.row .project').length;
        
        if(target == 0) {
            var target = count;
        }
        
        var check_type = $('[order="'+target+'"]').attr('type');
        
        while(check_type == 'None' || check_type == 'Link') {
            var target = parseInt(target);
            var target = target - 1;
            if(target == 0) {
                var target = count;
            }
            var check_type = $('[order="'+target+'"]').attr('type');
        }
        
        change_video(target);
        
    });
    
    $('.modal .wrap .controls.next').click(function(event) {
        
        event.preventDefault();
        
        var target = $(this).attr('target');
        
        var count = $('.row .project').length;
        
        if(target > count) {
            var target = 1;
        }
        
        var check_type = $('[order="'+target+'"]').attr('type');
        
        while(check_type == 'None' || check_type == 'Link') {
            var target = parseInt(target);
            var target = target + 1;
            if(target > count) {
                var target = 1;
            }
            var check_type = $('[order="'+target+'"]').attr('type');
        }
        
        change_video(target);
        
    });
    
    esc_key_modal();
    
    
    
    /* Scroll to top */
    
    $('.scroll-to-top').click(function(event) {
        
        event.preventDefault();
        
        scroll_to_top();
        
    });
    
    
    
    /* Popup */
    
    $('.popup').click(function(event) {
        
        event.preventDefault();
        
        var target = $(this).attr('href');
        
        popup(target);
        
    });
    
    
    
    /* Lazy Load */
    
    lazyload();
    
    
    
    /* Vimeo mute */
    
    /*var iframe = document.getElementsByClassName('vimeo_background')[0];
    iframe.contentWindow.postMessage('{"method":"setVolume", "value":0}','*');*/
	
    
    
});
    
    
    
/* Services fix */

$(window).resize(function() {
    
    if ($(window).width() < 980) {
        $('#services .slider .slide').each(function() {
            $(this).fadeIn();
            $(this).addClass('services-fix');
        });
    } else {
        $('#services .slider .slide').each(function() {
            $(this).removeClass('services-fix');
        });
    }
    
});

/* $(window).resize(function() {

    var description_height = $('#services .slider .slide .row .description .main-text').height();
    var description_height = parseInt(description_height);
    
    if (description_height > 480) {
    
        $('#services .slider .slide .row .description .main-text').removeClass('align');
        $('#services .slider .slide .row .description').addClass('description-fix');
    
    }

}); */