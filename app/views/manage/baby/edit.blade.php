<form class="form-horizontal">
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">编辑</h4>
</div>
<div class="modal-body">
		<div class="form-group">
    			<label class="col-sm-4 control-label">姓名:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="name" value="{{$baby['name']}}" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">乳名:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="nickname" value="{{$baby['nickname']}}" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
            <label class="col-sm-4 control-label">性别</label>
            <div class="col-sm-6">
              <div class="rdio rdio-primary">
                <input type="radio" 
                @if ($baby['sex'] == 'm')
                    checked="checked"
                @endif
                  id="male" value="m" name="sex">
                <label for="male">男</label>
              </div>
              <div class="rdio rdio-primary">
                <input type="radio" 
                @if ($baby['sex'] == 'f')
                    checked="checked"
                @endif
                value="f" id="female" name="sex">
                <label for="female">女</label>
              </div>
            </div>
          </div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">生日:</label>
    			<div class="col-sm-6">
    			    <input type="datetime-local" name="birthday" value="{{ str_replace(' ', 'T', $baby['birthday']) }}" class="form-control" required />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">父亲:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="father" value="{{$baby['father']}}" class="form-control" />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">母亲:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="mother" value="{{$baby['mother']}}" class="form-control" />
    			</div>
    		</div>
    		<div class="form-group">
    			<label class="col-sm-4 control-label">出生地:</label>
    			<div class="col-sm-6">
    			    <input type="text" name="birth_address" value="{{$baby['birth_address']}}" class="form-control" />
    			</div>
    		</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-primary modelEdit" data-dismiss="modal">确定</button>
	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
</div>
</form>

<script>
    $(document).ready(function(){
        $(".modelEdit").click(function(){
            var url = "{{url('manage/baby', $baby['id'])}}";
            var thiz = $(this);
            $.ajax({
                url : url,
                data : $(thiz).closest('form').serialize(),
                dataType : 'json',
                type : 'PUT'
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