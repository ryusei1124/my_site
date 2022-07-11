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


// Vegas Background SlideShow
var responsiveImage = [
  {src: './img/main-1.jpg'},
  {src: './img/main-2.jpg'},
  {src: './img/main-3.jpg'},
  {src: './img/main-4.jpg'},
  {src: './img/main-5.jpg'},
];
$('.visual_list').vegas({
  transition: 'blur',
  transitionDuration: 2000,
  delay: 10000,
  animationDuration: 20000,
  animation: 'kenburns',
  slides: responsiveImage,
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

//ProgressBar.js
var bar = new ProgressBar.Line(splash_text, {
	easing: 'easeInOut',
	duration: 1000,
	strokeWidth: 0.2,
	color: '#14a4e7',
	trailWidth: 0.2,
	trailColor: '#bbb',
	text: {
		style: {
			position: 'absolute',
			left: '50%',
			top: '50%',
			padding: '0',
			margin: '-30px 0 0 0',
			transform:'translate(-50%,-50%)',
			'font-size':'1rem',
			color: '#fff',
		},
		autoStyleContainer: false 
	},
	step: function(state, bar) {
		bar.setText(Math.round(bar.value() * 100) + ' %'); 
	}
});
bar.animate(1.0, function () {
	$("#splash_text").fadeOut(10);
	$(".loader_cover-up").addClass("coveranime");
	$(".loader_cover-down").addClass("coveranime");
	$("#splash").fadeOut();
});


});