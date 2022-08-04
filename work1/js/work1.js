$(function () {

  $('html,body').animate({ scrollTop: 0 }, '1');

  $('body').fadeIn(1000); 

  /* ハンバーガーメニュー */
  $('.header_btn').click(function () {
    $(this).toggleClass('active');
    $('.header_nav').toggleClass('active');
    $('body').toggleClass('active');
  });

  // 館内 - アコーディオン
  $('.menu_accordion').click(function () {
    $('.menu_accordion_btn').toggleClass('active');
    $(this).next().slideToggle();
  });

  // 画像遅延読み込み
  $("img.lazyload").lazyload();


  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 0) {
      $('.environment_wrap').addClass('scroll');
      $('.main_title').addClass('scroll');
    } else if ($(this).scrollTop() > 900) {
      $('.mainvisual').css('background-attachment', 'scroll');
    } else {
      $('.environment_wrap').removeClass('scroll');
      $('.main_title').removeClass('scroll');
    }
  });

});