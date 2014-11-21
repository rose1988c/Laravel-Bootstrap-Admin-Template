<form class="form-horizontal">
    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">
    		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
    	</button>
    	<h4 class="modal-title" id="myModalLabel">添加</h4>
    </div>
    <div class="modal-body">
    		<div class="form-group">
    			<label class="col-sm-4 control-label">姓名:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="name" value="" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">乳名:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="nickname" value="" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
            <label class="col-sm-4 control-label">性别</label>
            <div class="col-sm-6">
              <div class="rdio rdio-primary">
                <input type="radio" checked="checked" id="male" value="m" name="sex">
                <label for="male">男</label>
              </div>
              <div class="rdio rdio-primary">
                <input type="radio" value="f" id="female" name="sex">
                <label for="female">女</label>
              </div>
            </div>
          </div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">生日:</label>
    			<div class="col-sm-6">
    			    <input type="datetime-local" name="birthday" value="" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">父亲:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="father" value="" class="form-control" />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">母亲:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="mother" value="" class="form-control" />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">出生地:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="birth_address" value="" class="form-control" />
    			</div>
    		</div>
    </div>
    <div class="modal-footer">
    	<button type="button" class="btn btn-primary modelAdd" data-dismiss="modal">确定</button>
    	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $(".modelAdd").click(function(){
            var thiz = $(this);
            var url = "{{url('manage/baby')}}";
            $.ajax({
                url : url,
                data : thiz.closest('form').serialize(),
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