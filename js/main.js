$(function(){
  // ナビゲーションをクリック時、スクロールして移動する
  $('a[href^="#"]').click(function(){
    let href = $(this).attr("href");
    let target = $(href == "#" || href == "" ? "html" : href);
    let position = target.offset().top;
    $("html, body").animate({scrollTop:position}, "swing");
    return false;
  });

  // header - スマホ表示の際のナビゲーションの表示・非表示
  $('.hamburger').click(function(){
    $(this).toggleClass('active');
    $('body').toggleClass('active');
    $('.nav_list').toggleClass('active');
    $('.outer_frame').toggleClass('active');
    $('.portfolio_list_sp').slideUp().removeClass('active');
  });
  $('.outer_frame').click(function(){
    $(this).removeClass('active');
    $('body').removeClass('active');
    $('.nav_list').removeClass('active');
    $('.hamburger').removeClass('active');
    $('.portfolio_list_sp').slideUp().removeClass('active');
  });

  // header - スマホ表示の際の「サイトについて」ドロップダウンの表示・非表示
  $('.sp_nav_item .nav_site_btn').click(function(){
    $(this).toggleClass('active');
    $('.portfolio_list_sp').slideToggle().toggleClass('active');
  });

  // pc表示でホバー時、「サイトについて」フェードイン
  $('.pc_nav_item').hover(function(){
    $('.portfolio_list_pc').toggleClass('hover');
  });

  // header - スマホ表示の際のナビゲーションの非表示
  $('.nav_btn').click(function(){
    $('.portfolio_list_sp').slideUp().removeClass('active');
    $('.hamburger').removeClass('active');
    $('.nav_list').removeClass('active');
    $('.outer_frame').removeClass('active');
    $('.nav_site_btn').removeClass('active');
    $('body').removeClass('active');
  });

  $('.modal_open').on('click', function() {
    //  ボタンをクリックしたら、クリックしたい要素のdata属性を取得
    let target = $(this).data('modal-link');
    //  上記で取得した要素と同じclass名を持つ要素を取得
    let modal = document.querySelector('.' + target);
    //  その要素にclassを付け替える
    $(modal).toggleClass('is-show');
    $('body').css('overflow','hidden');
  });
  
  $('.modal_close, .modal_bg').on('click', function() {
    $(this).parents('.modal').toggleClass('is-show');
    $('body').css('overflow','scroll');
  });


  // work 1つ目
  var slider_thumbnail_1 = new Swiper('.slider_thumbnail_1', {
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
  });
  var slider_1 = new Swiper('.slider_1', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    thumbs: {
      swiper: slider_thumbnail_1
    }
  });
  // work 2つ目
  var slider_thumbnail_2 = new Swiper('.slider_thumbnail_2', {
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
  });
  var slider_2 = new Swiper('.slider_2', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    thumbs: {
      swiper: slider_thumbnail_2
    }
  });
  // work 3つ目
  var slider_thumbnail_3 = new Swiper('.slider_thumbnail_3', {
    slidesPerView: 4,
    freeMode: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
  });
  var slider_3 = new Swiper('.slider_3', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    thumbs: {
      swiper: slider_thumbnail_3
    }
  });
  

  $('.section_title, .about_me_content, .skill_text, .contact_text, .contact_form, .sns_list, .skill_list, .errmessage, .success, .profile_item').on('inview', function(event, isInView){
    if (isInView) {
      $(this).addClass('start');
    }else{
      $(this).removeClass('start');
    }
  });

  $('.textarea_resize').on('change keyup keydown paste cut', function(){
    if ($(this).outerHeight() > this.scrollHeight){
      $(this).height(1)
      $('.confirm_inner').height(1)
    }
    while ($(this).outerHeight() < this.scrollHeight){
      $(this).height($(this).height() + 1)
      $('.confirm_inner').height($('.confirm_inner').height() + 1)
    }
  }).trigger('change'); 

  const className = $(".confirm_wrap").attr("class");
  if(className == 'confirm_wrap'){
    $('body').css('overflow','hidden');
  }else{
    $('body').css('overflow','scroll');
  }

  $('.back_btn').click(function(){
    $('.confirm_wrap').fadeToggle();
  });

  // エンターキーでの送信禁止
  $("input[type=text], input[type=email]").keypress(function(ev) {
    if ((ev.which && ev.which === 13) ||
        (ev.keyCode && ev.keyCode === 13)) {
      return false;
    } else {
      return true;
    }
  });


  // 画像遅延読み込み
  $("img.lazyload").lazyload();
});
