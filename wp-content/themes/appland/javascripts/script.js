(function($) {
    var animationSpeed = 400;


    $(document).ready(function() {

        // Only enable hover functions, equal height sections and parallax on non iOs
        if( !iosAgent() ) {
            equalizeHeight();
            stellarInit();
            hoverInit();
        }

        // Hide address bar on iOS
        if ( iosAgent() ) {
            iosHideBar();
        }

        smoothScroll();
        carouselInit();
        tooltipInit();
        lightboxInit();
        setupContactForm();
        setupMailchimpForm();
        flexInit();
        iconHovers();

    });

    // Function to hide the bar on IOS
    function iosHideBar() {
        window.addEventListener("load",function() {
          // Set a timeout...
          setTimeout(function(){
            // Hide the address bar!
            window.scrollTo(0, 1);
          }, 0);
        });
    }


    // Function for checking iOS agent
    function iosAgent() {
        var deviceAgent = navigator.userAgent.toLowerCase();
        var newClass = '';
        var isIOS = false;
        if( deviceAgent.match(/iphone/i) ) {
            newClass = 'agent-iphone';
            isIOS = true;
        }
        else if( deviceAgent.match(/ipod/i) ) {
            newClass = 'agent-ipod';
            isIOS = true;
        }
        else if( deviceAgent.match(/ipad/i) ) {
            newClass = 'agent-ipad';
            isIOS = true;
        }

        $('body').addClass( newClass );

        return isIOS;
    }



    // Function for carousel init
    function carouselInit() {
        $('.carousel').carousel({
            interval: 5000
        });

        if( !$('body').hasClass( 'agent-iphone' ) ) {
            $('.thumbs').carousel({
                interval: 5000
            });
        } else {
            $('.thumbs').removeClass('carousel slide');
        }

    }

    // Function for smooth scrolling between the sections
    function smoothScroll() {
        $('.navbar').on('click','a', function(e) {
            var target = this.hash;
            var isHome = $('body').hasClass('home');
            if(target && isHome){
                e.preventDefault();
                $.scrollTo( target, 3 * animationSpeed, {
                    axis: 'y',
                    onAfter: function() {
                        window.location.hash = target;
                    }
                } );
            }
       });
    }

    // Make the sections have the height of the window
    function equalizeHeight() {
        var section = $('html').not('.ie8').find('.section'); // getting the sections in all but ie8
        section.css({'min-height': (($(window).height()))+'px'});
        $(window).resize(function(){
            section.css({'min-height': (($(window).height()))+'px'});
        });
    }

    // Function to change Social icon colors on hover
    function iconHovers(){
        $('[data-iconcolor]').each(function(){
            var element         = $(this);

            element.css('background-color' , element.attr('data-iconcolor'));

        });
    }

    // initialize stellar
    function stellarInit() {
        $(window).stellar({
            horizontalScrolling: false
        });
    }

    // initialize tooltips
    function tooltipInit() {
        $('.well-author a, #style-switcher a').tooltip();
    }

    function hoverInit() {
        $('.popup-link').on('mouseenter', function(){
            $(this).find('i').animate({
                top: '50%'
                }, 300
            );
        });
        $('.popup-link').on('mouseleave', function(){
            $(this).find('i').animate({
                top: '120%'
                }, 300, function() {
                    $(this).css('top', '-100px');
                }
            );
        });
    }

    function lightboxInit() {
        $('.popup-image').magnificPopup({type:'image'});
        $('.popup-youtube, .popup-vimeo, .popup-gmaps, .popup-video').magnificPopup({
          disableOn: 700,
          type: 'iframe',
          mainClass: 'mfp-fade',
          removalDelay: 160,
          preloader: false,
          fixedContentPos: false
        });
        $('.popup-gallery').each(function(index , value){
            var gallery = $(this);
            var galleryImages = gallery.find('img').data("links").split(",");
            var items = [];
            for(var i=0;i<galleryImages.length; i++){
                items.push({
                    src:galleryImages[i],
                    title:""
                });
            }
            gallery.magnificPopup({
                items:items,
                gallery:{
                    enabled:true
                },
                type: 'image'
            });
        });

    }

    function setupContactForm(){
        $('.wpcf7').on('invalid.wpcf7 spam.wpcf7 mailsent.wpcf7 mailfailed.wpcf7',function(){
            setTimeout(function() {
                $('.wpcf7').find('div.wpcf7-response-output').empty().removeClass('wpcf7-mail-sent-ok wpcf7-mail-sent-ng wpcf7-validation-errors wpcf7-spam-blocked').slideUp('fast');     
            }, 3000);

        });
    }

    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    function message( content, type, duration , container) {
        var messageHTML = '<div class="alert alert-' + type + '">'
                        + content
                        + '</div>';

        var messagePopup = $(messageHTML).hide();

        container.append(messagePopup);

        messagePopup.fadeIn();

        // Increase compatibility with unnamed functions
        setTimeout(function() {
            messagePopup.fadeOut();
        }, duration);  // will work with every browser
    }

    function setupMailchimpForm(){
        $('.submitEmail').click( function() {
            var $form = $(this).closest('.sign-me-up');
            var email = $form.find('.email-signup');
            var button = $form.find('.signup-button');
            var msgContainer = $form.next('.messages');
            if( validateEmail( email.val() ) ) {
                button.attr( 'disabled', true );
                $.post( localData.ajaxurl,
                    {
                        action: 'sign_up',
                        nonce: localData.nonce,
                        email: email.val()
                    },
                    function( data ) {
                        var mainDiv = $('.signup');
                        switch( data.status ) {
                            case 'ok':
                                $form[0].reset();
                                message( "<strong>Thanks for your interest!</strong> we will be in touch soon....", "success", 5000 , msgContainer);
                            break;
                            case 'error':
                                message( "<strong>Failed to Register</strong> please try again later", "error", 5000 , msgContainer);
                                setTimeout( function() {
                                    button.removeAttr( 'disabled');
                                }, 3000 );
                            break;
                        }
                    },
                    'json'
                );
            }
            else {
                message( "<strong>Invalid Email</strong> please type in a correct email address", "error", 5000, msgContainer );
            }
            return false;
        });

       //  fix placeholders for ie8, ie9
         $('.ie8, .ie9').find('input, textarea').placeholder();
    }

    function flexInit() {

        $('.flexslider').each(function(){
            var slider = $(this),
            autostart = slider.attr('data-flex-autostart') == "false" ? false : true,
            sliderAnimation = !slider.attr('data-flex-animation') ? "slide" : slider.attr('data-flex-animation'),
            sliderSpeed = !slider.attr('data-flex-speed') ? 7000 : slider.attr('data-flex-speed'),
            sliderDirections = slider.attr('data-flex-directions') == "hide" ? false : true;

            slider.flexslider({
                slideshow: autostart,
                animation: sliderAnimation,
                slideshowSpeed: sliderSpeed,
                directionNav: sliderDirections,
                prevText: '<i class="icon-chevron-left"></i>',
                nextText: '<i class="icon-chevron-right"></i>',
                smoothHeight: true,
                controlNav: false,
                useCSS : false
            });
        });
    }

})(jQuery);