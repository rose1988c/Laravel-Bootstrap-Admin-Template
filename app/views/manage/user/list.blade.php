@section('content')
<!-- ajax 方式 -->
<div class="table-responsive">
  <table class="table table-bordered table-hover" id="table2">
      <thead>
         <tr>
            <th>id</th>
            <th>username</th>
            <th>角色</th>
            <th>Email</th>
            <th>ip</th>
            <th>最后登录时间</th>
            <?php if (is_super_admin()){?>
            <th>&nbsp;</th>
            <?php }?>
         </tr>
      </thead>
      <tbody>
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

@stop

@section('css')
    {{ HTML::style('/assets/package/datatables/css/jquery.dataTable_themebracket.css?' . date("Ymd", time()) . '.css') }}
@stop

@section('footer')
<script src="{{asset('/assets/package/datatables/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/bracket/js/chosen.jquery.min.js')}}"></script>

<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#table2').dataTable({
      "processing": true,
      "serverSide": true,
      "sAjaxSource": "{{url('/manage/user/list/ajax')}}",
      "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
          oSettings.jqXHR = $.ajax( {
            "dataType": 'json',
            "type": "GET",
            "url": sSource,
            "data": aoData,
            "success": fnCallback
          } );
      },
      "fnDrawCallback" : function(){
      	    // Chosen Select
      	    jQuery("select").chosen({
      	      'min-width': '100px',
      	      'white-space': 'nowrap',
      	      disable_search_threshold: 10
      	    });

      	    // Show aciton upon row hover
      	    jQuery('.table-hidaction tbody tr').hover(function(){
      	      jQuery(this).find('.table-action-hide a').animate({opacity: 1});
      	    },function(){
      	      jQuery(this).find('.table-action-hide a').animate({opacity: 0});
      	    });

      	    jQuery('.delete-row').click(function(){
          	    $this = $(this);
          	    $("#deleteModal .modal-body").html("确定要删除用户["+ $this.attr('title') +"]吗?");

          	    $("#deleteModal .modal-footer .btn-primary").off('click').on('click', function(){

          	    var deleteurl = "{{url('manage/user')}}" + "/" + $this.attr('rel');
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
      "sPaginationType": "full_numbers",
      "oLanguage": {
          "sUrl" : "{{asset('/assets/package/datatables/jquery.datatables.surl.cn-zn.txt')}}"
      }
    });

    $("#editModal").on("hidden.bs.modal", function() {
        $(this).removeData("bs.modal");
    });
  
  });
</script>
@stop
