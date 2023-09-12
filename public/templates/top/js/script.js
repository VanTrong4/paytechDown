

$(document).ready(function ($) {
  AOS.init({ once: true });
  const headerWrap = $("#site-header");
  var appendHeight = $("<div></div>");
  appendHeight.css({ height: headerWrap.height() })
  headerWrap.after(appendHeight);
  appendHeight.hide();


  hasScroll = false;
  function loadLazy() {
    const elms = $(".lazy-href");
    $.each(elms, (index, elm) => {
      const href = $(elm).data('href');
      $(elm).attr('href', href);
    })
    const srcs = $(".lazy-src");
    $.each(srcs, (index, elm) => {
      const url = $(elm).data('src');
      $(elm).attr('src', url);
    })
  }


  $(window).scroll(function () {
    if (hasScroll == false) {
      hasScroll = true;
      loadLazy();
    }
    if ($(window).scrollTop() > 0) {
      $("#site-header").addClass('fixed');
      appendHeight.show();
    } else {
      $("#site-header").removeClass('fixed')
      appendHeight.hide();
    }
    if ($(window).scrollTop() > 500) {
      $(".hd-contact").addClass('fixed')
      $("#back-to-top ").fadeIn();
    } else {
      $(".hd-contact").removeClass('fixed')
      $("#back-to-top").fadeOut();
    }
  });
  $("#btn-menu").click(function (e) {
    e.preventDefault();
    $("body").toggleClass('open-menu')
  });

  $("#back-to-top").click(function (e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, 600);
  });
  $(".anchor-link").click(function (e) {
    e.preventDefault()
    var tab = $(this).data("anchor");
    var scrollTo = $(tab).offset().top - 90;
    $("html, body").animate({
      scrollTop: scrollTo
    }, 400);
    var w_width = $(window).width();
    if (w_width < 786) {
      $("#nav-menu .menu-content").hide();
    }
  });
  $(".question").click(function () {
    $(this).toggleClass('active').next('.answer').slideToggle();
  });
});


$(function () {
	$('a[href*="#"]:not([href="#"])').click(function () {
		if (
			location.pathname.replace(/^\//, "") ==
			this.pathname.replace(/^\//, "") &&
			location.hostname == this.hostname
		) {
			var target = $(this.hash);
			console.log(target);
			target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
			console.log(target);
			$('#js-gMenuBtn').removeClass('isShow');
			$('#js-pageNav').removeClass('isShow');
			$('#navArea').removeClass('open');
			$('.question').addClass('isShow');
			if (target.length) {
				$("html, body").animate(
					{
						scrollTop: target.offset().top - 100,
					},
					1000
				);
				return false;
			}
		}
	});
  $(window).on("load", function() {
    $('body').fadeIn(100); 
});
});