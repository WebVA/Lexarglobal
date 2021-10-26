$(function () {

    if ($('#preloader').length) {
        $('#preloader').delay(1500).fadeOut('slow', function() {
            $(this).remove();
        });
    }

    utils();


    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function (event) {
        event.preventDefault();
        event.stopPropagation();

        $(this).siblings().toggleClass("show");


        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
            $('.dropdown-submenu .show').removeClass("show");
        });

    });


    $('i.delete').on('click', function () {
        $(this).parents('.item').fadeOut();
    });


    // ------------------------------------------------------- //
    // Open & Close Search Panel
    // ------------------------------------------------------ //
    $('.search').on('click', function () {
        $('.search-area').fadeIn();
    });

    $('.search-area .close-btn').on('click', function () {
        $('.search-area').fadeOut();
    });

    // ------------------------------------------------------- //
    // Autoplay videos only on desktops
    // ------------------------------------------------------ //
    var screenWidth = $(window).width();
    // if window width is smaller than 800 remove the autoplay attribute
    // from the video
    if (screenWidth > 800) {
        $('video.bg-video').attr('autoplay', true);
        $('video.bg-video').each(function () {
            this.play();
        });
    }


    // ------------------------------------------------------- //
    // Countdown on coming soon page
    // ------------------------------------------------------ //

    if ($('#countdown').length > 0) {

        $('#countdown').countdown('2020/10/10', function (event) {
            $(this).html(event.strftime(
                '<div class="col-6 col-sm-3"><div class="display-3 text-shadow">%D</div>days</div>' +
                '<div class="col-6 col-sm-3"><div class="display-3 text-shadow">%H</div>hours</div>' +
                '<div class="col-6 col-sm-3"><div class="display-3 text-shadow">%M</div>minutes</div>' +
                '<div class="col-6 col-sm-3"><div class="display-3 text-shadow">%S</div>seconds</div>'));
        });

    }


    // ------------------------------------------------------- //
    // Items Carousel
    // ------------------------------------------------------ //
    $('.items-slider').owlCarousel({
        loop: true,
        items: 1,
        thumbs: true,
        thumbsPrerendered: true,
        dots: false,
        responsiveClass: false
    });


    // ------------------------------------------------------- //
    // Increase/Reduce product amount
    // ------------------------------------------------------ //
    $('.dec-btn').click(function () {
        var siblings = $(this).siblings('input.quantity-no');
        if (parseInt(siblings.val(), 10) >= 1) {
            siblings.val(parseInt(siblings.val(), 10) - 1);
        }
    });

    $('.inc-btn').click(function () {
        var siblings = $(this).siblings('input.quantity-no');
        siblings.val(parseInt(siblings.val(), 10) + 1);
    });

    // ------------------------------------------------------- //
    // Scroll to top button
    // ------------------------------------------------------ //
    // Scroll to top button
    $(window).on('scroll', function () {
        if ($(window).scrollTop() >= 1500) {
            $('#scrollTop').fadeIn();
        } else {
            $('#scrollTop').fadeOut();
        }
    });


    $('#scrollTop').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });



    // ------------------------------------------------------- //
    // Bootstrap select
    // ------------------------------------------------------ //
    $('.bs-select').selectpicker({
        size: 4
    });


    // ------------------------------------------------------- //
    // Hero Slider
    // ------------------------------------------------------ //
    var owl = $('.hero-slider');
    owl.owlCarousel({
        loop: true,
        margin: 0,
        smartSpeed: 500,
        responsiveClass: true,
        autoplay: true,
        autoplayHoverPause: true,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        responsive: {
            0: {
                items: 1,
                nav: false,
                dots: true
            },
            600: {
                items: 1,
                nav: false,
                dots: true
            },
            1120: {
                items: 1,
                dots: false,
                nav: true
            }
        },
        onRefresh: function () {
            owl.find('.item').height('');
        },
        onRefreshed: function () {
            var maxHeight = 0;
            var items = owl.find('.item');
            items.each(function () {
                var itemHeight = $(this).height();
                if (itemHeight > maxHeight) {
                    maxHeight = itemHeight;
                }
            });
            items.height(maxHeight);
        }
    });

    // ------------------------------------------------------- //
    // Products Slider
    // ------------------------------------------------------ //
    $('.products-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: false,
        smartSpeed: 400,
        autoplay: true,
        responsiveClass: true,
        navText: ['<i class="fa fa-long-arrow-left"></i>', '<i class="fa fa-long-arrow-right"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // ------------------------------------------------------- //
    // Brands Slider
    // ------------------------------------------------------ //
    $('.brands-slider').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: false,
        smartSpeed: 400,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2
            },
            600: {
                items: 3
            },
            1000: {
                items: 9,
                loop: false
            }
        }
    });

    // ------------------------------------------------------- //
    //  Styled Leaflet Map
    // ------------------------------------------------------ //

    var mapId = 'map',
        mapCenter = [53.14, 8.22],
        mapMarker = true;

    if ($('#' + mapId).length > 0) {

        var icon = L.icon({
            iconUrl: 'img/marker.png',
            iconSize: [25, 37.5],
            popupAnchor: [0, -18],
            tooltipAnchor: [0, 19]
        });

        var dragging = false,
            tap = false;

        if ($(window).width() > 700) {
            dragging = true;
            tap = true;
        }

        var map = L.map(mapId, {
            center: mapCenter,
            zoom: 13,
            dragging: dragging,
            tap: tap,
            scrollWheelZoom: false
        });

        var Stamen_TonerLite = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-lite/{z}/{x}/{y}{r}.{ext}', {
            attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            subdomains: 'abcd',
            minZoom: 0,
            maxZoom: 20,
            ext: 'png'
        });

        Stamen_TonerLite.addTo(map);

        map.once('focus', function () {
            map.scrollWheelZoom.enable();
        });

        if (mapMarker) {
            var marker = L.marker(mapCenter, {
                icon: icon
            }).addTo(map);

            marker.bindPopup("<div class='p-4'><h5>Info Window Content</h5><p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p></div>", {
                minwidth: 200,
                maxWidth: 600,
                className: 'map-custom-popup'
            })

        }
    }



});

// ------------------------------------------------------ //
// For demo purposes, can be deleted
// ------------------------------------------------------ //

var stylesheet = $('link#theme-stylesheet');
$("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
var alternateColour = $('link#new-stylesheet');

if ($.cookie("theme_csspath")) {
    alternateColour.attr("href", $.cookie("theme_csspath"));
}

$("#colour").change(function () {

    if ($(this).val() !== '') {

        var theme_csspath = 'css/style.' + $(this).val() + '.css';

        alternateColour.attr("href", theme_csspath);

        $.cookie("theme_csspath", theme_csspath, {
            expires: 365,
            path: document.URL.substr(0, document.URL.lastIndexOf('file:///'))
        });

    }

    return false;
});

function utils() {

    /* click on the box activates the link in it */

    $('.box.clickable').on('click', function (e) {

        window.location = $(this).find('a').attr('href');
    });
    /* external links in new window*/

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });
    /* animated scrolling */

    $('.scroll-to, .scroll-to-top').click(function (event) {

        var full_url = this.href;
        var parts = full_url.split("#");
        if (parts.length > 1) {

            scrollTo(full_url);
            event.preventDefault();
        }
    });

    function scrollTo(full_url) {
        var parts = full_url.split("#");
        var trgt = parts[1];
        var target_offset = $("#" + trgt).offset();
        var target_top = target_offset.top - 100;
        if (target_top < 0) {
            target_top = 0;
        }

        $('html, body').animate({
            scrollTop: target_top
        }, 1000);
    }
}

$(".testimonials-carousel").owlCarousel({
    autoplay: true,
    dots: true,
    loop: true,
    items: 1
});

$('.list-view').on('click', function() {
    $('.grid-view').removeClass('selected')
    $(this).addClass('selected')
    $('.products-grid .item').removeClass('col-xl-3')
    $('.products-grid .item').removeClass('col-md-6')
    $('.products-grid .item').addClass('col-sm-12')
    $('.products-grid .item .product').addClass('list-view-item')
    $('.description').show()
})
$('.grid-view').on('click', function(){
    $('.list-view').removeClass('selected')
    $(this).addClass('selected')
    $('.products-grid .item').addClass('col-xl-3')
    $('.products-grid .item').addClass('col-md-6')
    $('.products-grid .item').removeClass('col-sm-12')
    $('.products-grid .item .product').removeClass('list-view-item')
    $('.description').hide()
})

$(".nav-item").hover(function () {
	$(this).find(".nav-link").toggleClass("active");
	$(this).find(".dropdown-menu").toggleClass("show");
});

$(".description-item").on('click', function(){
	$(this).each(function(){
        $(this).find("a").removeClass("active");
    });

    $(".description-pane").each(function(){
        $(this).hide();
    });

    if($(this).find("a").html()=="Description"){
        $("#description").show();
    }else if($(this).find("a").html()=="Specification"){
        $("#specification").show();
    }else if($(this).find("a").html()=="Product Info"){
        $("#product-info").show();
    }else if($(this).find("a").html()=="Case Studies"){
        $("#case-studies").show();
    }else{
        $("#office-note").show();
    }
});