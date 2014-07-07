@section('content')

<p>
    <a class="btn btn-primary" href="{{url('manage/roles/create')}}" data-toggle="modal" data-target="#addModal">添加角色</a>
</p>

<!-- 普通方式，数据量小的情况 -->
<div class="table-responsive">
  <table class="table table-bordered table-hover" id="table2">
      <thead>
         <tr>
            <th>id</th>
            <th>名称</th>
            <?php if (is_admin()){?>
            <th>&nbsp;</th>
            <?php }?>
         </tr>
      </thead>
      <tbody>
            <?php foreach ((array)$roles as $role) { ?>
            <tr>
            	<td>{{$role['id']}}</td>
            	<td>{{$role['name']}}</td>
            	<?php if (is_admin()){?>
            	<td>
            	    <?php if ($role['id'] !== USER_ROLE_SUPER_ADMIN) {?>
                    <a href="{{url('manage/roles', $role['id'])}}" data-toggle="modal" data-target="#authModal"><i class="glyphicon glyphicon-check"></i></a>
                    <?php }?>
                    <?php if (is_super_admin()){?>
                    <a href="{{url('manage/roles/' . $role['id'], 'edit')}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></a>
                    <a href="#deleteModal" rel="{{$role['id']}}" title="{{$role['name']}}" data-toggle="modal" data-target="#deleteModal" class="delete-row"><i class="fa fa-trash-o"></i></a>
                    <?php }?>
                </td>
                <?php }?>
            </tr>
            <?php }?>
      </tbody>
   </table>
</div><!-- table-responsive -->
          
<!-- deleteModal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">删除</h4>
      </div>
      <div class="modal-body">
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">确定</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
    </div>
  </div>
</div>

<!-- editModal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- addModal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

<!-- authModal -->
<div class="modal fade" id="authModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
</div>

@stop

@section('css')
    {{ HTML::style('/assets/package/datatables/css/jquery.dataTable_themebracket.css?' . date("Ymd", time()) . '.css') }}
@stop

@section('footer')
<script src="{{asset('/assets/package/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/bracket/js/chosen.jquery.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#table2').dataTable({
      "processing": true,
      "sPaginationType": "full_numbers",
      "fnDrawCallback" : function(){
        // Chosen Select
        $("select").chosen({
          'min-width': '100px',
          'white-space': 'nowrap',
          disable_search_threshold: 10
        });

  	    jQuery('.delete-row').click(function(){
      	    $this = $(this);
      	    $("#deleteModal .modal-body").html("确定要删除["+ $this.attr('title') +"]吗?");

      	    $("#deleteModal .modal-footer .btn-primary").off('click').on('click', function(){

      	    var deleteurl = "{{url('manage/roles')}}" + "/" + $this.attr('rel');
      	        $.ajax({
      	    	    url: deleteurl,
        	    	dataType: 'json',
    	    	    type: 'DELETE'
    	    	}).done(function(data){
                    if (data.code == 0) {
                      $this.closest('tr').fadeOut(function(){
                          $this.remove();
                      });
                      notify('提示', data.message, 'success');
                    } else {
                      notify('提示', data.message, 'danger');
                    }
        	    })
                .fail(function(){ alert("出错啦！"); });
          	});
  	    });
        
      },
      "oLanguage": {
          "sUrl" : "{{asset('/assets/package/datatables/jquery.datatables.surl.cn-zn.txt')}}"
      }
    });

    $("#editModal, #authModal").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
    });
  });
</script>
@stop
