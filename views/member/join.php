        <div class="page-header">
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-6">
                    <a href="#" id="joinBtn" data-toggle="modal" data-target="#joinModal">join</a>
                </div>
            </div>
        </div>
        <script>
	        $(document).ready(function() {
		        $('#joinBtn').click();
	        })
        </script>

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
                                    <label for="inputEmail" class="col-lg-2 control-label">E-mail</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="mid" name="mid" placeholder="E-mail">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="mpw" name="mpw" placeholder="Password">
                                        <input type="password" class="form-control" id="mpw_chk" name="mpw_chk" placeholder="Password Confirm">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 자동로그인
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-lg-2 control-label">Phone</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
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
        <script>
            $(document).ready(function() {
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
            });

        </script>