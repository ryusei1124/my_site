$(function(){

$('.humbarger').click(function(){
  $(this).toggleClass('active');
  $('.nav_wrap').stop().fadeToggle();
  $('body').toggleClass('active');
});

$('.nav_item').click(function(){
  $('.humbarger').removeClass('active');
  $('.nav_wrap').fadeOut();
  $('body').removeClass('active');
})

$('.mainvisual, .service_img2').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
  if (isInView) {
    $(this).stop().addClass('fadeIn');
  } else {
    $(this).stop().removeClass('fadeIn');
  }
});

$('.concept_slider_list').slick({
  slidesToShow: 3,
  slidesToScroll:1,
  autoplaySpeed: 3000,
  dots:true,
  responsive:[{
    breakpoint: 768,
    settings: {
      slidesToShow: 2,
    }
  },{
    breakpoint: 640,
    settings: {
      slidesToShow: 1,
    }
  }]
});

//アコーディオンをクリックした時の動作
$('.question').on('click', function() {
	var findElm = $(this).next(".answer");
	$(findElm).slideToggle();
	if($(this).hasClass('open')){
		$(this).removeClass('open');
	}else{
		$(this).addClass('open');
	}
});

function GethashID (hashIDName){
	if(hashIDName){
		$('.place_tab_item').find('a').each(function() {
			var idName = $(this).attr('href');
			if(idName == hashIDName){ //リンク元の指定されたURLのハッシュタグが同じか
				var parentElm = $(this).parent(); //タブ内のaタグの親要素を取得
				$('.place_tab_item').removeClass("tab_active");
				$(parentElm).addClass("tab_active");
				$(".place_content").removeClass("content_active");
				$(hashIDName).addClass("content_active");	
			}
		});
	}
}
//タブをクリックしたら
$('.place_tab_item a').on('click', function() {
	var idName = $(this).attr('href'); 
	GethashID (idName);//設定したタブの読み込み
	return false;
});
$(window).on('load', function () {
  $('.place_tab_item:first-of-type').addClass("tab_active"); 
  $('.place_content:first-of-type').addClass("content_active");
});

// 画像遅延読み込み
$("img.lazyload").lazyload();

});