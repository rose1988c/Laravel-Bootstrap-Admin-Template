<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">添加角色</h4>
</div>
<div class="modal-body">
	<form id="editform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">角色名称:</label>
			<div class="col-sm-6">
			    <input type="text" name="name" value="" class="form-control">
			</div>
		</div>
	</form>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary useradd" data-dismiss="modal">确定</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
</div>

<script>
    $(document).ready(function(){
        $(".useradd").click(function(){
            var url = "{{url('manage/roles')}}";
            $.ajax({
                url : url,
                data : $('#editform').serialize(),
                dataType : 'json',
                type : 'POST'
            }).done(function(data){
                if (data.code == 0) {
                  notify('提示', data.message, 'success', false, 3);
                  window.location.reload();
                } else {
                  notify('提示', data.message, 'danger');
                }
            }).fail(function(){ alert("出错啦！"); });
        });
    });
</script>