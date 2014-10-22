<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">编辑用户</h4>
</div>
<div class="modal-body">
	<form id="editform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">用户名:</label>
			<div class="col-sm-6">
				<input type="text" name="username" disabled value="{{$user['username']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">Email:</label>
			<div class="col-sm-6">
				<input type="email" name="email" value="{{$user['email']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">昵称:</label>
			<div class="col-sm-6">
				<input type="text" name="nickname" value="{{$user['nickname']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">真实姓名:</label>
			<div class="col-sm-6">
				<input type="text" name="truename" value="{{$user['truename']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">角色:</label>
			<div class="col-sm-6">
			    <?php echo call_user_func_array(array('\Service\Common\Html', 'select'), array(
			        'roleid', 'roleid', \Service\Common\Html::$roles, $user['roleid'], false, 'form-control'
			    ));?>
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary userupdate" data-dismiss="modal">确定</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
</div>

<script>

    $(document).ready(function(){
        $(".userupdate").click(function(){
            var url = "{{url('manage/user/' . $user['id'])}}";
            $.ajax({
                url : url,
                data : $('#editform').serialize(),
                dataType : 'json',
                type : 'PUT'
            }).done(function(data){
                if (data.code == 0) {
                  notify('提示', data.message, 'success', false, 3);
                } else {
                  notify('提示', data.message, 'danger');
                }
            }).fail(function(){ alert("出错啦！"); });
        });
    });
</script>