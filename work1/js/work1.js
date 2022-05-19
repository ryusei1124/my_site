$(function(){
/* ハンバーガーメニュー */
$('.header_btn').click(function () {
  $(this).toggleClass('active');
  $('.header_nav').toggleClass('active');
  $('body').toggleClass('active');
});

// 館内 - アコーディオン
$('.menu_accordion').click(function(){
  $('.menu_accordion_btn').toggleClass('active');
  $(this).next().slideToggle();
});

});