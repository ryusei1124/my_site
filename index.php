<?php
session_start();
//クリックジャッキングへの対策
header('X-Frame-Options: DENY');
// 入力画面
$mode = 'input'; 
$errmessage = array();
$success = array();
if(isset($_POST['back']) && $_POST['back']){
  // 何もしない(入力画面)
}else if(isset($_POST['confirm']) && $_POST['confirm']){
  if(!$_POST['name']){
    $errmessage[] = "名前を入力してください";
  }else if(mb_strlen($_POST['name']) > 100){
    $errmessage[] = "名前は100文字以内にしてください";
  }
  $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);

  if(!$_POST['email']){
    $errmessage[] = "メールアドレスを入力してください";
  }else if(mb_strlen($_POST['email']) > 200){
    $errmessage[] = "メールアドレスは200文字以内にしてください";
  // メールアドレス形式のチェック
  }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $errmessage[] = "メールアドレスが不正です";
  }
  $_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);

  if(!$_POST['message']){
    $errmessage[] = "内容を入力してください";
  }else if(mb_strlen($_POST['message']) > 500){
    $errmessage[] = "内容は500文字以内にしてください";
  }
  $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

  if($errmessage){
    // 入力画面
    $mode = 'input';
  }else{
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;
    // 確認画面
    $mode = 'confirm';
  }
}else if(isset($_POST['send']) && $_POST['send']){
  if(!$_POST['token'] || !$_SESSION['email']){
    $_SESSION['name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['message'] = "";
    $mode = "input";
  }else if($_POST['token'] != $_SESSION['token']){
    $_SESSION['name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['message'] = "";
    $mode = "input";
  }else{
    $message = "問い合わせを受け付けました。\r\n"
      . "名前：" . $_SESSION['name'] . "\r\n"
      . "メールアドレス：" . $_SESSION['email'] . "\r\n"
      . "お問い合わせ内容：\r\n" 
      . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
    mail($_SESSION['email'], "お問い合わせありがとうございます", $message);
    mail("ryusei_1124_122@yahoo.co.jp", "お問い合わせありがとうございます", $message);
    // 入力画面
    $mode = 'input';
    $success[] = "送信しました";
    // 初期化
    $_SESSION['name'] = "";
    $_SESSION['email'] = "";
    $_SESSION['message'] = "";
  }
}else{
  // 初期化
  $_SESSION['name'] = "";
  $_SESSION['email'] = "";
  $_SESSION['message'] = "";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
  <meta property="og:url" content="http://ryusei-site.com/" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Otaka Ryusei" />
  <meta property="og:description" content="ポートフォリオを作成いたしました。よければご覧ください。" />
  <meta property="og:site_name" content="ryusei_site" />
  <meta property="og:image" content="https://i.gyazo.com/417b9202556fc293ee1c2e7d88b2b908.jpg" /> 
  <meta name="twitter:card" content="summary" />
  <meta name="twitter:site" content="@ryusei_studying" />
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- works/スライダー -->
  <link rel="stylesheet" href="//unpkg.com/swiper/swiper-bundle.min.css">
  <!-- google font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro&display=swap" rel="stylesheet"> 
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <title>RYUSEI | Portfolio</title>
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
</head>
<body>
  <header>
    <div class="header_wrap">
      <div class="header_inner container">
        <button class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <h1 class="title">OTAKA RYUSEI</h1>

        <ul class="nav_list">
          <li class="nav_item"><a href="#" class="nav_btn">トップ</a></li>
          <li class="nav_item pc_nav_item">
            <p class="nav_site_btn">サイトについて</p>
            <ul class="portfolio_list_pc">
              <li class="nav_item"><a href="#about_me" class="nav_btn">自己紹介</a></li>
              <li class="nav_item"><a href="#works" class="nav_btn">制作物</a></li>
              <li class="nav_item"><a href="#achievement" class="nav_btn">実績</a></li>
              <li class="nav_item"><a href="#skills" class="nav_btn">スキル</a></li>
              <li class="nav_item"><a href="#profile" class="nav_btn">プロフィール</a></li>
            </ul>
          </li>
          <li class="nav_item sp_nav_item">
            <p class="nav_site_btn">サイトについて</p>
            <ul class="portfolio_list_sp">
              <li class="nav_item"><a href="#about_me" class="nav_btn">自己紹介</a></li>
              <li class="nav_item"><a href="#works" class="nav_btn">制作物</a></li>
              <li class="nav_item"><a href="#achievement" class="nav_btn">実績</a></li>
              <li class="nav_item"><a href="#skills" class="nav_btn">スキル</a></li>
              <li class="nav_item"><a href="#profile" class="nav_btn">プロフィール</a></li>
            </ul>
          </li>
          <li class="nav_item"><a href="#contact" class="nav_btn">問い合わせ</a></li>
        </ul> <!-- nav_list-->
      </div> <!-- header_inner-->
      <div class="outer_frame"></div>
    </div> <!-- header_wrap-->
  </header>

  <section class="section about_me" id="about_me">
    <div class="sec_inner">
      <h2 class="section_title">自己紹介</h2>
      <div class="about_me_content">
        <figure class="about_me_img">
          <img data-src="img/me.JPG" class="lazyload" alt="me_img">
        </figure>
        <div class="content_text_wrap">
          <p class="self_int">
            大高龍世<br>1999年11月24日生まれ<br>高校卒業後、建築会社に就職。<br>知人の紹介で動画編集の仕事に転職。<br>旅行系のエンタメ動画や情報発信動画を編集。<br>現在は動画編集の仕事をしながらコーダーとしてweb制作の案件を受けています。<br>お客様への貢献を目標に活動しております！
          </p>
        </div> <!-- content_text_wrap-->
      </div> <!-- about_me_content-->
    </div> <!-- sec_inner-->
  </section> <!-- about_me-->

  <section class="section works" id="works">
    <div class="sec_inner">
      <h2 class="section_title">制作物</h2>
      <ul class="works_list">
        <li class="work_item">
          <div class="modal_open" data-modal-link="modal-1">
            <img data-src="img/work1-1.png" class="lazyload work_item_img" alt="">
          </div>
          <div class="modal modal-1">
            <div class="modal_bg"></div>
            <div class="modal_cont">
              <button class="modal_close"></button>
              <div class="modal_info">
                <p class="modal_text">
                  架空の温泉宿のホームページを作成しました。
                </p>
                <ul class="point_list">
                  <li class="point_item">・スクロールによって表示切り替え</li>
                  <li class="point_item">・背景はanimationを使い画像を動かしている</li>
                  <li class="point_item">・画面遷移時にフェードインで表示</li>
                  <li class="point_item">・共通部分のコードの使い回し</li>
                </ul>
                <a href="work1/index.html" class="demo_link">サイトを見る</a>
                <a href="https://github.com/ryusei1124/my_site/tree/main/work1" class="code_link" target="_blank">コードを見る</a>
                <p class="development_title">【 開発環境 】</p>
                <ul class="development_list">
                  <li class="development_item">・言語<br><span>HTML、CSS、jQuery</span></li>
                  <li class="development_item">・環境<br><span>VScode</span></li>
                  <li class="development_item">・作成期間<br><span>約１ヶ月</span></li>
                </ul>
              </div> <!-- modal_info-->
              <div class="modal_contnet_img">
                <!-- スライダー-->
                <div class="swiper-container slider slider_1">
                  <div class="swiper-wrapper slider_thumb">
                    <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work1-1.png" alt="work1画像"></div>
                    <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work1-2.png" alt="work1画像"></div>
                    <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work1-3.png" alt="work1画像"></div>
                    <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work1-4.png" alt="work1画像"></div>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <!-- サムネイル -->
                <div class="swiper-container slider-thumbnail slider_thumbnail_1">
                  <div class="swiper-wrapper thumb">
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work1-1.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work1-2.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work1-3.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work1-4.png" alt="work1画像"></div>
                  </div>
                </div>
              </div>
            </div> <!-- modal_cont-->
          </div> <!-- modal-->
        </li>
        <li class="work_item">
          <div class="modal_open" data-modal-link="modal-2">
            <img data-src="img/work2-1.png" class="lazyload work_item_img" alt="">
          </div>
          <div class="modal modal-2">
            <div class="modal_bg"></div>
            <div class="modal_cont">
              <button class="modal_close"></button>
              <div class="modal_info">
                <p class="modal_text">
                老犬介護サービスのサンプルLPを作成しました。
                </p>
                <ul class="point_list">
                  <li class="point_item">・画面表示時にイラストのフェードイン｜inview.js</li>
                  <li class="point_item">・イラストなどの固定表示</li>
                  <li class="point_item">・スライドショー｜slick</li>
                </ul>
                <a href="work2/work2.html" class="demo_link">サイトを見る</a>
                <a href="https://github.com/ryusei1124/my_site/tree/main/work2" class="code_link" target="_blank">コードを見る</a>
                <p class="development_title">【 開発環境 】</p>
                <ul class="development_list">
                  <li class="development_item">・言語<br><span>HTML、CSS、jQuery</span></li>
                  <li class="development_item">・環境<br><span>VScode</span></li>
                  <li class="development_item">・作成期間<br><span>１週間</span></li>
                </ul>
              </div> <!-- modal_info-->
              <div class="modal_contnet_img">
                <!-- スライダー-->
                <div class="swiper-container slider slider_2">
                  <div class="swiper-wrapper slider_thumb">
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work2-1.png" alt="work1画像"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work2-2.png" alt="work1画像"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work2-3.png" alt="work1画像"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work2-4.png" alt="work1画像"></div>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <!-- サムネイル -->
                <div class="swiper-container slider-thumbnail slider_thumbnail_2">
                  <div class="swiper-wrapper thumb">
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work2-1.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work2-2.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work2-3.png" alt="work1画像"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work2-4.png" alt="work1画像"></div>
                  </div>
                </div>
              </div>
            </div> <!-- modal_cont-->
          </div> <!-- modal-->
        </li>
        <li class="work_item">
          <div class="modal_open" data-modal-link="modal-3">
            <img data-src="img/work3-1.png" class="lazyload work_item_img" alt="">
          </div>
          <div class="modal modal-3">
            <div class="modal_bg"></div>
            <div class="modal_cont">
              <button class="modal_close"></button>
              <div class="modal_info">
                <p class="modal_text">
                架空の建設会社のコーポレートサイトを作成いたしました。
                </p>
                <ul class="point_list">
                  <li class="point_item">・ズームアウトするスライドショー｜Vegas Background SlideShow</li>
                  <li class="point_item">・ローデイング｜ProgressBar.js</li>
                  <li class="point_item">・スクロール時、上からスライドするヘッダー</li>
                  <li class="point_item">・背景画像の固定表示</li>
                </ul>
                <a href="work3/work3.html" class="demo_link">サイトを見る</a>
                <a href="https://github.com/ryusei1124/my_site/tree/main/work3" class="code_link" target="_blank">コードを見る</a>
                <p class="development_title">【 開発環境 】</p>
                <ul class="development_list">
                  <li class="development_item">・言語<br><span>HTML、CSS、jQuery</span></li>
                  <li class="development_item">・環境<br><span>VScode</span></li>
                  <li class="development_item">・作成期間<br><span>１週間</span></li>
                </ul>
              </div> <!-- modal_info-->
              <div class="modal_contnet_img">
                <!-- スライダー-->
                <div class="swiper-container slider slider_3">
                  <div class="swiper-wrapper slider_thumb">
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work3-1.png" alt="制作物"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work3-2.png" alt="制作物"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work3-3.png" alt="制作物"></div>
                      <div class="swiper-slide slider_item"><img class="lazyload" data-src="img/work3-4.png" alt="制作物"></div>
                  </div>
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
                </div>
                <!-- サムネイル -->
                <div class="swiper-container slider-thumbnail slider_thumbnail_3">
                  <div class="swiper-wrapper thumb">
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work3-1.png" alt="制作物"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work3-2.png" alt="制作物"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work3-3.png" alt="制作物"></div>
                    <div class="swiper-slide thumb_item"><img class="lazyload" data-src="img/work3-4.png" alt="制作物"></div>
                  </div>
                </div>
              </div>
            </div> <!-- modal_cont-->
          </div> <!-- modal-->
        </li>
      </ul> <!-- works_list-->
    </div> <!-- sec_inner-->
  </section> <!-- works-->

  <section class="section achievement" id="achievement">
    <div class="sec_inner">
      <div class="container">
        <h2 class="section_title">実績</h2>
        <div class="achievement-list__wrap">
          <table class="achievement-list">
            <thead>
              <tr>
                <th>受注月</th>
                <th>案件内容</th>
                <th>制作期間</th>
                <th>備考</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>5月</td>
                <td>LP制作</td>
                <td>3日間</td>
                <td></td>
              </tr>
              <tr>
                <td>7月</td>
                <td>LP制作</td>
                <td>3日間</td>
                <td></td>
              </tr>
              <tr>
                <td>7月</td>
                <td>LP制作</td>
                <td>7日間</td>
                <td></td>
              </tr>
              <tr>
                <td>7月</td>
                <td>LP制作/WordPress(Elementor)</td>
                <td>中断</td>
                <td>クライアント側から中断と連絡があった為</td>
              </tr>
              <tr>
                <td>8月</td>
                <td>LP作成/WordPress</td>
                <td>7日間</td>
                <td></td>
              </tr>
              <tr>
                <td>8月</td>
                <td>コーポレートサイト修正/WordPress</td>
                <td>8日間</td>
                <td></td>
              </tr>
              <tr>
                <td>9月</td>
                <td>コーポレートサイト修正</td>
                <td>1週間</td>
                <td></td>
              </tr>
              <tr>
                <td>10,11月</td>
                <td>サービスサイト制作</td>
                <td>6週間</td>
                <td>githubを用いたチーム開発</td>
              </tr>
              <tr>
                <td>10月</td>
                <td>ホームページ制作</td>
                <td>1週間</td>
                <td></td>
              </tr>
              <tr>
                <td>11月</td>
                <td>ホームページ修正</td>
                <td>6日間</td>
                <td></td>
              </tr>
              <tr>
                <td>11月</td>
                <td>コーポレートサイト修正</td>
                <td>5日間</td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <section class="section skills" id="skills">
    <div class="sec_inner">
      <div class="container">
        <h2 class="section_title">スキル</h2>
        <p class="skill_text">
          実務、学習経験のあるスキルをまとめました。<br>今後は実務を積んでいきスキルアップをしていきたいと考えております。
        </p>
        <ul class="skill_list">
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/html-5.svg" alt="" class="lazyload small">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle html" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️5</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/css-3.svg" alt="" class="lazyload small">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle css" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️5</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/sass.svg" alt="" class="lazyload middle">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle sass" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️5</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/jquery.svg" alt="" class="lazyload big">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle jquery" cx="50%" cy="50%" r="15.9154"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️3</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/bootstrap.svg" alt="" class="lazyload small">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle bootstrap" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️1</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/ruby.png" alt="" class="lazyload small">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle ruby" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験なし、<br>学習で投稿機能など作成</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/php.svg" alt="" class="lazyload big">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle php" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり✖️2</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/wordpress-icon.svg" alt="" class="lazyload middle">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle wordpress" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり×2<br></p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/mysql.svg" alt="" class="lazyload middle">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle mysql" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験なし、<br>学習で簡単なテーブル作成</p>
          </li>
          <li class="skill_item">
            <div class="skill_inner">
              <div class="outer">
                <div class="inner">
                  <img data-src="img/git.svg" alt="" class="lazyload big">
                </div>
              </div>
              <svg class="circle_wrap" viewBox = "0 0 37 37">
                <circle class="circle git" cx="50%" cy="50%" r="15.9154" stroke-linecap="round"></circle>
              </svg>
            </div>
            <p class="skill_item_txt">実務経験あり、<br>チーム開発でgithubを使用</p>
          </li>
        </ul> <!-- skill_list-->
      </div> <!-- container-->
    </div> <!-- sec_inner-->
  </section> <!-- skills-->

  <section class="section profile" id="profile">
    <div class="sec_inner">
      <div class="container">
        <h2 class="section_title">プロフィール</h2>
        <ul class="profile_list">
          <li class="profile_item">
            <h3 class="year">1999</h3>
            <img data-src="img/profile-1.jpg" alt="年表画像" class="lazyload profile_img">
            <p class="profile_text">
              11月24日に生誕。名前：「龍世」<br>由来：世界(世)にはばたく(龍)
            </p>
          </li>
          <li class="profile_item">
            <h3 class="year">2006<span class="period">〜</span>2018</h3>
            <img data-src="img/profile-2.jpg" alt="年表画像" class="lazyload profile_img">
            <p class="profile_text">
              小学6年生〜高校3年生まで野球を続け、主にピッチャーを担当<br>中学では大会で準優勝を経験しました。
            </p>
          </li>
          <li class="profile_item">
            <h3 class="year">2018</h3>
            <img data-src="img/profile-3.jpg" alt="年表画像" class="lazyload profile_img">
            <p class="profile_text">
              高校卒業後、建築会社に就職。<br>高速道路の柱の鉄骨を組み立てていました。
            </p>
          </li>
          <li class="profile_item">
            <h3 class="year">2020<span class="period">〜</span><span class="now">現在</span></h3>
            <img data-src="img/profile-4.jpg" alt="年表画像" class="lazyload profile_img">
            <p class="profile_text">
              今後いつ仕事を失うか分からない時代に稼ぐ力をつけるために、需要が高いプログラミングの学習を開始！
            </p>
          </li>
          <li class="profile_item">
            <h3 class="year">2021<span class="period">〜</span><span class="now">現在</span></h3>
            <img data-src="img/profile-5.jpg" alt="年表画像" class="lazyload profile_img">
            <p class="profile_text">
              知人から動画編集の仕事を紹介され、動画編集も需要が高いため転職を決意！<br>旅行系のエンタメ動画や情報発信動画を編集しています
            </p>
          </li>
        </ul> <!-- profile_list-->
        <p class="goal">売上に貢献できる人材を目指して頑張っています！</p>
      </div> <!-- container-->
    </div> <!-- sec_inner-->
  </section> 
  <!-- profile-->

  <section class="section contact" id="contact">
    <div class="sec_inner">
      <div class="container">
        <h2 class="section_title">Contact</h2>
        <div class="contact_cont">
          <p class="contact_text">
            最後までご覧いただきありがとうございました。<br>このサイトを通して、私のことを少しでも知っていただけたら嬉しいです！<br>もしこのサイトや私について何かコメントがありましたら、下記フォームをご利用ください。
          </p>
          <p class="contact_text">
            SNSなどもやっていますので、よければ見に来てください！
          </p>
          <ul class="sns_list">
            <li class="sns_item">
              <a href="https://twitter.com/ryusei_studying" target="_blank">
                <i class="fa-brands fa-twitter"></i>
              </a>
            </li>
            <li class="sns_item">
              <a href="https://www.instagram.com/ryusei_studying/" target="_blank">
                <i class="fa-brands fa-instagram"></i>
              </a>
            </li>
            <li class="sns_item">
              <a href="https://github.com/ryusei1124/my_site" target="_blank">
                <i class="fa-brands fa-github"></i>
              </a>
            </li>
          </ul> <!-- sns_list -->
          <?php if($mode == 'input'){ ?>
            <!-- エラーメッセージor送信メッセージ -->
            <?php
              if($errmessage){
                echo '<div class="errmessage">';
                echo implode('<br>', $errmessage);
                echo '</div>';
              }
              if($success){
                echo '<div class="success">';
                echo implode('<br>', $success);
                echo '</div>';
              }
            ?>
            <!-- 入力画面 -->
            <form action="index.php#contact" method="post" class="contact_form">
              <div class="form_field short">
                <label for="name" class="form_label">Name<span class="mandatory">・</span></label>
                <input type="text" class="form_input" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="form_field short">
                <label for="email" class="form_label">E-mail<span class="mandatory">・</span></label>
                <input type="email" class="form_input" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?>">
              </div>
              <div class="form_field long">
                <label for="message" class="form_label">Message<span class="mandatory">・</span></label>
                <textarea name="message" id="message" class="form_input textarea_resize"><?php echo htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8') ?></textarea>
              </div>
              <div class="form_field long">
                <input class="form_btn" type="submit" name="confirm" value="確認">
              </div>
            </form>
          <?php }else if($mode == 'confirm'){ ?>
            <!-- 確認画面 -->
            <div class="confirm_wrap">
              <div class="confirm_inner">
                <form action="index.php#contact" method="post" class="contact_form confirm_form">
                  <h3 class="content_title">CONTENT</h3>
                  <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                  <div class="form_field">
                    <label for="name" class="form_label">Name<span class="mandatory">・</span></label>
                    <p class="confirm_text"><?php echo htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') ?></p>
                  </div>
                  <div class="form_field">
                    <label for="email" class="form_label">E-mail<span class="mandatory">・</span></label>
                    <p class="confirm_text"><?php echo htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') ?></p>
                  </div>
                  <div class="form_field">
                    <label for="message" class="form_label">Message<span class="mandatory">・</span></label>
                    <p class="confirm_text"><?php echo nl2br(htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8')) ?></p>
                  </div>
                  <div class="form_field">
                    <input class="form_btn" type="submit" name="back" value="戻る">
                    <input class="form_btn submit_btn" type="submit" name="send" value="送信">
                  </div>
                </form> 
              </div> 
            </div>  
          <?php } ?>
        </div> 
      </div> 
    </div> 
  </section>


  <div class="thanks" id="thanks">
    <p class="thanks_message">Thanks for watching!!</p>
  </div>

  <footer class="footer">
    <div class="container">
      <a href="#" class="top_scroll_btn"></a>
      <p class="author">@2022 Otaka Ryusei</p>
    </div>
  </footer>

  
  <!-- jquery読み込み -->
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <script src="js/main.js"></script>
  <!-- jquery.inview.js読み込み -->
  <script src="js/jquery.inview.min.js"></script>
  <!-- works/スライダー -->
  <script src="//unpkg.com/swiper/swiper-bundle.min.js"></script>
  <!-- Lazy Load -->
  <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.min.js"></script>
</body>
</html>
