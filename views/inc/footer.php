</div>
<div class="container">
    <footer>
        <div class="row">
            <div class="col-lg-12 text-center">
                Copyright <i class="fa fa-copyright" aria-hidden="true"></i> <?php echo mailto('manic@mainc.kr', 'manic.kr');?> 2017 All Right Reserved.
            </div>
        </div>
    </footer>
</div>

<!--// 입장하기 모달창 //-->
<div id="loginModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">입장하기</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="login" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">E-mail</label>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="E-mail" id="mid" name="mid" type="text" valid_email value="" autofocus>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input class="form-control" placeholder="Password" id="mpw" name="mpw" type="password" required minlength="4" maxlength="8" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <!-- Change this to a button or input when using this as a form -->
                                <input id="loginBtn" type="button" class="btn btn-lg btn-primary btn-block" value="로그인">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <a href="/member/find/">E-mail & PW 찾기</a> | <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#joinModal">회원가입</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!--// 회원가입 모달창 //-->
<div id="joinModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">회원가입</h4>
            </div>
            <div class="modal-body">
                <form id="joinForm" class="form-horizontal">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">이메일</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="mid" name="mid" placeholder="E-mail 주소">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">비밀번호</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control" id="mpw" name="mpw" placeholder="비밀번호">
                                <input type="password" class="form-control" id="mpw_chk" name="mpw_chk" placeholder="비밀번호 확인">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> 자동로그인
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword" class="col-lg-2 control-label">휴대폰</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="하이픈(-) 표시없이 번호만 입력">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary joinSubmit">전송</button>
            </div>
        </div>
    </div>
</div>

<!--// DOM 이후 실행 //-->
<script src="/bs/js/manic.kr.js"></script>
</body>
</html>

<script>
    $(document).ready(function() {
	    // 회원가입 영역
	    $('.joinSubmit').click(function(){
		    if ( $('#mid').val() == "" ) {
			    alert("E-mail 를 입력하세요.");
			    $('#mid').focus();
			    return false;
		    }
		    if ( $('#mpw').val() == "" ) {
			    alert("Password 를 입력하세요.");
			    $('#mpw').focus();
			    return false;
		    }
		    if ( $('#mpw_chk').val() == "" ) {
			    alert("Password 확인을 입력하세요.");
			    $('#mpw_chk').focus();
			    return false;
		    }
		    if ( $('#mpw').val() != $('#mpw_chk').val() ) {
			    alert("Password 가 일치하지 않습니다.");
			    $('#mpw_chk').val('').focus();
			    return false;
		    }
		    if ( $('#phone').val() == "" ) {
			    alert("Phone 번호를 입력하세요.");
			    $('#phone').focus();
			    return false;
		    }
		    if ( $('#mid').val() && $('#mpw').val() ) {
			    $.ajax({
				    url: "/ajax/join/json",
				    type: "POST",
				    data: $("#joinForm").serialize(),
				    success: function(res) {
					    if (res['result'] == "Success") {
						    alert(res['result_msg']);
						    $(location).attr('href',"/auth/login");
					    } else {
						    alert(res['result_msg']);
					    }
				    },
				    error: function(e){
					    alert(e.responseText);
				    }
			    });
		    }
	    });

// 로그인 버튼 눌렀을 경우
	    $("#loginBtn").click(function(){
		    if ( $('input[name="mid"]').val() == "" ){
			    alert("E-main 주소를 입력하세요.");
			    $('input[name="mid"]').focus();
			    return false;
		    }

		    if ( $('input[name="mpw"]').val() == "" ){
			    alert("비밀번호를 입력하세요.");
			    $('input[name="mpw"]').focus();
			    return false;
		    }
		    $.ajax({
			    url: "/ajax/login/json",
			    type: "POST",
			    data: $("#login").serialize(),
			    success: function(res) {
                    // console.log(res);
                    // 모달창 닫기
				    $('.close').click();
				    if (res['code']==1) {
					    // nav 갱신
					    $('.login_ul').children('li').remove();
					    var html = '';
					    html += '<li><a href="#"><i class="fa fa-sitemap" aria-hidden="true"></i> 전체보기</a></li>';
					    html += '<li><a href="#"><i class="fa fa-user fa-fw"></i> 회원정보</a></li>';
					    html += '<li class="divider"></li>';
					    html += '<li><a href="/auth/logout/"><i class="fa fa-sign-out fa-fw"></i> 퇴장하기</a></li>';
					    $('.login_ul').html(html);
					    // 드롭다운 선택, 열기
					    $('.login_ul').parent().addClass('active open');
				    }else{
				    	alert(res['msg']);
                    }
			    }
		    });

	    });
	    function modalClose() {
	    	$('div.modal').close();
        }

// mid 유효성 검사
	    $("#mid").click(function() {
		    $(this).parent().parent('div').removeClass('has-warning');
		    $(".help-block").html("");
		    $(this).parent().parent('div').addClass('has-warning');
	    }).focusout(function() {
		    if ( $(this).val() ) {
			    $.ajax({
				    url: "/ajax/mid_chk/json",
				    data: "mid=" + $("#mid").val(),
				    type: "POST",
				    success: function(res) {
					    if (res['res']=="fail") {
						    $("#mid").parent().parent('div').removeClass('has-warning').addClass('has-error');
						    $(".help-block").html("&nbsp;&nbsp;" + res['msg']);
					    } else {
						    $("#mid").parent().parent('div').removeClass('has-warning', 'has-error').addClass('has-success');
					    }
				    }
			    });
		    } else {
			    if ( $(this).parent().parent('div').hasClass('has-warning') == true ) {
				    $(this).parent().parent('div').removeClass('has-warning');
			    }
		    }
	    });

// 메인 바로가기
	    $('.main-page').click(function() {
		    window.location.href="/";
	    });

    })
</script>
