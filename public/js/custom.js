
// Custom Select
$(".cus-select").each(function () {
    var classes = $(this).attr("class"),
        id = $(this).attr("id"),
        name = $(this).attr("name");
    var preset = $(this).find(":selected").text();
    var template = '<div class="' + classes + '">';
    if(preset) {
        template += '<span class="cus-select-trigger">' + preset + "</span>";
    } else {
        template += '<span class="cus-select-trigger">' + $(this).attr("placeholder") + "</span>";
    }
    template += '<div class="custom-options">';
    $(this)
        .find("option")
        .each(function () {
            template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + "</span>";
        });
    template += "</div></div>";

    $(this).wrap('<div class="cus-select-wrapper"></div>');
    $(this).hide();
    $(this).after(template);
});

// Custom Option Hover
$(".custom-option:first-of-type").hover(
    function () {
        $(this).parents(".custom-options").addClass("option-hover");
    },
    function () {
        $(this).parents(".custom-options").removeClass("option-hover");
    }
);

// Custom Select Trigger
$(".cus-select-trigger").on("click", function () {
    $("html").one("click", function () {
        $(".cus-select").removeClass("opened");
    });
    $(this).parents(".cus-select").toggleClass("opened");
    event.stopPropagation();
});

// Custom Option
$(".custom-option").on("click", function () {
    $(this).parents(".cus-select-wrapper").find("select").val($(this).data("value"));
    $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
    $(this).addClass("selection");
    $(this).parents(".cus-select").removeClass("opened");
    $(this).parents(".cus-select").find(".cus-select-trigger").text($(this).text());
});

window.addEventListener('scroll', this.handleScroll, true);

$(".custom-select-1").each(function () {
    var classes = $(this).attr("class"),
        id = $(this).attr("id"),
        name = $(this).attr("name");
    var preset = $(this).find(":selected").text();
    var template = '<div class="' + classes + '">';
    if(preset) {
        template += '<span class="custom-select-1-trigger">' + preset + "</span>";
    } else {
        template += '<span class="custom-select-1-trigger">' + $(this).attr("placeholder") + "</span>";
    }
    
    template += '<div class="custom-option-1s">';
    $(this)
        .find("option")
        .each(function () {
            template += '<span class="custom-option-1 ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + "</span>";
        });
    template += "</div></div>";

    $(this).wrap('<div class="custom-select-1-wrapper"></div>');
    $(this).hide();
    $(this).after(template);
});

// Custom Option Hover
$(".custom-option-1:first-of-type").hover(
    function () {
        $(this).parents(".custom-option-1s").addClass("option-hover");
    },
    function () {
        $(this).parents(".custom-option-1s").removeClass("option-hover");
    }
);

// Custom Select Trigger
$(".custom-select-1-trigger").on("click", function () {
    $("html").one("click", function () {
        $(".custom-select-1").removeClass("opened");
    });
    $(this).parents(".custom-select-1").toggleClass("opened");
    event.stopPropagation();
});

// Custom Option
$(".custom-option-1").on("click", function () {
    $(this).parents(".custom-select-1-wrapper").find("select").val($(this).data("value"));
    $(this).parents(".custom-option-1s").find(".custom-option-1").removeClass("selection");
    $(this).addClass("selection");
    $(this).parents(".custom-select-1").removeClass("opened");
    $(this).parents(".custom-select-1").find(".custom-select-1-trigger").text($(this).text());
});
// fog effect
$(".3dots").on("click", function() {
    $(".fog").fadeIn();
    $(".header").addClass("blur");
    $(".page-content").addClass("blur");
    $("#sidenav-main").addClass("blur");
    $(".navbar-top").addClass("blur");
    $(".side-menu").addClass("show")
});
$(".fog").on("click", function() {
    $(this).fadeOut();
    $(".side-menu").removeClass("show");
    $(".page-content").removeClass("blur");
    $("#sidenav-main").removeClass("blur");
    $(".navbar-top").removeClass("blur");
    $(".header").removeClass("blur");
});
$(".btn-14").on("click", function() {
    $(".fog").fadeOut();
    $(".side-menu").removeClass("show");
    $(".page-content").removeClass("blur");
    $("#sidenav-main").removeClass("blur");
    $(".navbar-top").removeClass("blur");
    $(".header").removeClass("blur");
})