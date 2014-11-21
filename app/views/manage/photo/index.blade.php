@section('content')
<!-- 普通方式，数据量小的情况 -->
<div class="table-responsive">
  <table class="table table-bordered table-hover" id="table2">
      <thead>
         <tr>
            <th>id</th>
            <th>宝宝</th>
            <th>名称</th>
            <th>描述</th>
            <th>照片</th>
            <th>拍照时间</th>
            @if (is_admin())
            <th>&nbsp;</th>
            @endif
         </tr>
      </thead>
      <tbody>
            <?php foreach ((array)$photos as $photo) { ?>
            <tr>
            	<td>{{$photo['id']}}</td>
            	<td>{{$babys[$photo['bid']]}}</td>
            	<td>{{$photo['title']}}</td>
            	<td>{{$photo['desc']}}</td>
            	<td><img alt="{{$photo['title']}}" src="{{QiniuImageViewUrl($photo['path'], array(1, 'w', 100))}}"></td>
            	<td>{{$photo['take_at']}}</td>
            	@if (is_admin())
            	<td>
                @if (is_super_admin())
                <a href="{{url('manage/photo/' . $photo['id'], 'edit')}}" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></a>
                <a href="#deleteModal" rel="{{$photo['id']}}" title="{{$photo['title']}}" data-toggle="modal" data-target="#deleteModal" class="delete-row"><i class="fa fa-trash-o"></i></a>
                @endif
              </td>
              @endif
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

{{ HTML::style('/assets/package/dropzone/css/basic.css') }}
{{ HTML::style('/assets/package/dropzone/css/dropzone.css') }}
{{ HTML::script('/assets/package/dropzone/dropzone.js') }}

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

      	    var deleteurl = "{{url($resourceUrl)}}" + "/" + $this.attr('rel');
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
