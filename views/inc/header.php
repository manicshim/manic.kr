<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>Manic Awards</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="/bs/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="/bs/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/bs/css/layout.css" rel="stylesheet" type="text/css">
    <script src="/bs/js/jquery-2.1.0.min.js"></script>
    <script src="/bs/js/bootstrap.js"></script>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="logo">
                <a class="navbar-brand" href="/"></a>
            </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/main/info/"><i class="fa fa-info-circle" aria-hidden="true"></i> 전시관 소개<span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-camera-retro" aria-hidden="true"></i> 사진전 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/photo/">매닉 어워드</a></li>
                        <li class="divider"></li>
                        <li><a href="/photo/">일상 | 사물</a></li>
                        <li><a href="/photo/">인물 | 소재 | 컨셉</a></li>
                        <li><a href="/photo/">풍경 | 야외</a></li>
                        <li><a href="/photo/">흑백 | 테마</a></li>
                        <li class="divider"></li>
                        <li><a href="/photo/">부가</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-film" aria-hidden="true"></i> 영상모음 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/media/">영상전시</a></li>
                        <li class="divider"></li>
                        <li><a href="/media/">INCISIVE</a></li>
                        <li><a href="/media/">TAKE5</a></li>
                        <li><a href="/media/">リーフ</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-commenting" aria-hidden="true"></i> 게시판 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/board/">전시관 알림 <i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                        <li><a href="/board/">한줄 방명록 <i class="fa fa-comments-o" aria-hidden="true"></i></a></li>
                        <li><a href="/board/">회원전용 <i class="fa fa-unlock-alt" aria-hidden="true"></i></a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="/link/"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 링크</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-gear" aria-hidden="true"></i> 설정 <span class="caret"></span></a>
                    <ul class="dropdown-menu login_ul" role="menu">
                        <li><a href="/site/"><i class="fa fa-sitemap" aria-hidden="true"></i> 전체보기</a></li>
						<?php if (@$this->session->userdata('is_login') == true) {?>
                        <!--li><a href="#"><i class="fa fa-gear fa-fw"></i> 설정하기</a></li-->
                        <li><a href="/member/view/"><i class="fa fa-user fa-fw"></i> 회원정보</a></li>
                        <li class="divider"></li>
                        <li><a href="/auth/logout/"><i class="fa fa-sign-out fa-fw"></i> 퇴장하기</a></li>
						<?php }else{?><li><a href="#" data-toggle="modal" data-target="#joinModal"><i class="fa fa-user-plus" aria-hidden="true"></i> 회원가입</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in fa-fw"></i> 입장하기</a></li>
		            <?php }?></ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</div>
<div class="container">
