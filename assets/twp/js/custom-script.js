!function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.stickyMenu = function () {
        e(window).scrollTop() > 350 ? e("#masthead").addClass("nav-affix") : e("#masthead").removeClass("nav-affix")
    },
        n.mobileMenu = {
            init: function () {
                this.toggleMenu(), this.addClassParent(), this.addRemoveClasses()
            },
            toggleMenu: function () {
                var n = this,
                    t = e("#masthead");
                e("#nav-toggle").click(function (a) {
                    a.preventDefault(), t.hasClass("open") ? (t.removeClass("open"), e(".menu").find("li").removeClass("show")) : (t.addClass("open"), n.showSubmenu())
                })
            },
            addClassParent: function () {
                e(".menu").find("li > ul").each(function () {
                    e(this).parent().addClass("parent")
                })
            },
            addRemoveClasses: function () {
                var n = e(".menu");
                e(window).width() < 992 ? n.addClass("mobile") : (e("body").removeClass("open"), n.removeClass("mobile").find("li").removeClass("show"))
            },
            showSubmenu: function () {
                e(".menu").find("a").each(function () {
                    var n = e(this);
                    n.next("ul").length && n.one("click", function (n) {
                        n.preventDefault(), e(this).parent().addClass("show")
                    })
                })
            }
        },

        n.TwpSearch = function () {
            e(".search-button").click(function(){
                e(".search-box").slideToggle("500");
            });

            e('.search-button').click(function(){
                e(this).toggleClass('active');
            });

        },

        n.DataBackground = function () {
            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        /* Slick Slider */
        n.SlickCarousel = function () {
            e(".mainbanner-jumbotron").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: true,
                nextArrow: '<i class="twp-icon slide-icon slide-next ion-ios-arrow-right"></i>',
                prevArrow: '<i class="twp-icon slide-icon slide-prev ion-ios-arrow-left"></i>',
                responsive: [{
                    breakpoint: 768, settings: {
                        arrows: false
                    }
                }
                ]
            });

            e('.news-ticker').slick({
                infinite: true,
                speed: 1000,
                autoplay: true,
                autoplaySpeed: 1200,
                slidesToShow: 1,
                adaptiveHeight: true,
                nextArrow: '<i class="twp-icon slide-icon slide-next ion-ios-arrow-right"></i>',
                prevArrow: '<i class="twp-icon slide-icon slide-prev ion-ios-arrow-left"></i>',
                vertical:true,
                verticalSwiping: true
            });
        },

        n.InnerBanner = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        // SCROLL UP //
        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });

        },

        e(document).ready(function () {
            n.mobileMenu.init(), n.TwpSearch(), n.DataBackground(), n.InnerBanner(), n.SlickCarousel(), n.scroll_up();
        }), e(window).scroll(function () {
        n.stickyMenu(), n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.addRemoveClasses()
    })
}(jQuery);

