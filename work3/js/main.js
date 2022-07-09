$(function(){
// 画像遅延読み込み
$("img.lazyload").lazyload();


//スクロール途中からヘッダーの高さを変化させるための設定を関数でまとめる
var headerH = $('#mainvisual').outerHeight(true);
function FixedAnime(){
  var scroll = $(window).scrollTop();
  if(scroll >= headerH){
    $('#header').addClass('scroll');
  }else{
    $('#header').removeClass('scroll');
  }
}
// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function(){
  FixedAnime();
});
// ページが読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function(){
  FixedAnime();
});

// slick
$('.visual_list').slick({
  autoplay: true,
  autoplaySpeed: 5000,
  fade: true,
  speed: 1000,
});

$('.hamburger').on('click', function(){
  $(this).toggleClass('active');
  $('.nav_list').toggleClass('active');
  $('body').toggleClass('active');
});
$('.nav_item a').on('click', function(){
  $('.hamburger').removeClass('active');
  $('.nav_list').removeClass('active');
  $('body').removeClass('active');
});

var pagetop = $('.top_btn');   
pagetop.hide();
$(window).scroll(function () {
  if ($(this).scrollTop() > 200) { 
    $('.top_btn').fadeIn();
  } else {
    $('.top_btn').fadeOut();
  }
});
if (window.matchMedia('(max-width: 599px)').matches){
  pagetop.click(function () {
    $('body,html').animate({
      scrollTop: 0
    }, 500);
    return false;
  });
}else{
  $('a[href^="#"]').click(function(){
    let speed = 600;
    let href = $(this).attr("href");
    let target = $(href == "#" || href == "" ? "html" : href);
    let position = target.offset().top - 80;
    $("html, body").animate({scrollTop:position}, speed, "swing");
    return false;
  });
}


});