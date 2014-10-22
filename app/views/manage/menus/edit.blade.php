<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">编辑菜单</h4>
</div>
<div class="modal-body">
	<form id="editform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">父级ID:</label>
			<div class="col-sm-6">
			    <?php echo call_user_func_array(array('\Service\Common\Html', 'select'), array(
			        'pid', 'pid', $menus, $menu['pid'], '顶级', 'form-control'
			    ));?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">菜单名:</label>
			<div class="col-sm-6">
				<input type="text" name="name" value="{{$menu['name']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">路径:</label>
			<div class="col-sm-6">
				<input type="text" name="url" value="{{$menu['url']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">图标<a href="//v3.bootcss.com/components/#glyphicons" data-original-title="图标选择" target="_blank">go</a>:</label>
			<div class="col-sm-6">
				<input type="text" name="icons" value="{{$menu['icons']}}" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label">排序:</label>
			<div class="col-sm-6">
			    <?php echo Service\Common\Html::select('sorts', 'sorts', range(0, 100), $menu['sorts'], false, 'form-control');?>
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
            var url = "{{url('manage/menus/' . $menu['id'])}}";
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