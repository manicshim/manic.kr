<?php $this->load->view('inc/head');?>
<form id="frm" enctype="multipart/form-data">
    <input type="hidden" name="" value="award">
	<input type="file" name="pic" /><br>
	<input type="button" id="uploadbutton"  value="파일업로드" />
</form>
<?php $this->load->view('inc/foot');?>
<script>
	$(function(){
		$("#uploadbutton").click(function(){
			var form = $('form')[0];
			var formData = new FormData(form);
			console.log(formData);
			$.ajax({
				url: '/ajax/upload/json',
				processData: false,
				contentType: false,
				data: formData,
                type: 'POST',
                dataType: 'html',
				success: function(result){
					console.log(result);
					var json = $.parseJSON(result);
                    alert(json.msg);
				}
			});
		});
	})
</script>