<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="modal-title" id="myModalLabel">角色[{{$role['name']}}]权限</h4>
</div>
<div class="modal-body">
	<form id="editform" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-4 control-label">角色名称:</label>
			<div class="col-sm-6">
			    <input type="text" name="name" disabled value="{{$role['name']}}" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">菜单:</label>
			<div class="col-sm-6">
            	<div class="zTreeDemoBackground left">
            		<ul id="treeDemo" name="mid" class="ztree"></ul>
            		<input type="hidden" id="mid" name="mid" value="">
            	</div>
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
            var url = "{{url('manage/roles', $role['id'])}}";
            $.ajax({
                url : url,
                data : $('#editform').serialize(),
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

{{ HTML::style('/assets/package/ztree_v3/css/zTreeStyle.css?' . date("Ymd", time()) . '.css') }}
{{ HTML::script('/assets/package/ztree_v3/js/jquery.ztree.core-3.5.min.js?' . date("Ymd", time()) . '.js') }}
{{ HTML::script('/assets/package/ztree_v3/js/jquery.ztree.excheck-3.5.js?' . date("Ymd", time()) . '.js') }}

<SCRIPT type="text/javascript">
	function zTreeOnCheck(event, treeId, treeNode) {
	    var ids = [];
    	var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
		var nodes = treeObj.getCheckedNodes(true);

		if (nodes.length){
            for(var i=0; i<nodes.length; i++){
                ids[i] = nodes[i].id;
            }
    		
            $("#mid").val(ids);
		}
	};
	
	var setting = {
		check: {
			enable: true,
			chkDisabledInherit: true
		},
		data: {
			simpleData: {
				enable: true
			}
		},
		callback: {
			onCheck: zTreeOnCheck
		}
	};

// 	var zNodes = [
// 		{ id:1, pId:0, name:"随意勾选 1", open:true},
// 		{ id:11, pId:1, name:"随意勾选 1-1", open:true},
// 		{ id:111, pId:11, name:"disabled 1-1-1", chkDisabled:true},
// 		{ id:112, pId:11, name:"随意勾选 1-1-2"},
// 		{ id:12, pId:1, name:"disabled 1-2", chkDisabled:true, checked:true, open:true},
// 		{ id:121, pId:12, name:"disabled 1-2-1", checked:true},
// 		{ id:122, pId:12, name:"disabled 1-2-2"},
// 		{ id:2, pId:0, name:"随意勾选 2", checked:true, open:true},
// 		{ id:21, pId:2, name:"随意勾选 2-1"},
// 		{ id:22, pId:2, name:"随意勾选 2-2", open:true},
// 		{ id:221, pId:22, name:"随意勾选 2-2-1", checked:true},
// 		{ id:222, pId:22, name:"随意勾选 2-2-2"},
// 		{ id:23, pId:2, name:"随意勾选 2-3"}
// 	];

	var zNodes = {{json_encode($menus)}};

	function disabledNode(e) {
		var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
		disabled = e.data.disabled,
		nodes = zTree.getSelectedNodes(),
		inheritParent = false, inheritChildren = false;
		if (nodes.length == 0) {
			alert("请先选择一个节点");
		}
		if (disabled) {
			inheritParent = $("#py").attr("checked");
			inheritChildren = $("#sy").attr("checked");
		} else {
			inheritParent = $("#pn").attr("checked");
			inheritChildren = $("#sn").attr("checked");
		}

		for (var i=0, l=nodes.length; i<l; i++) {
			zTree.setChkDisabled(nodes[i], disabled, inheritParent, inheritChildren);
		}
	}

	$(document).ready(function(){
		$.fn.zTree.init($("#treeDemo"), setting, zNodes);
		$("#disabledTrue").bind("click", {disabled: true}, disabledNode);
		$("#disabledFalse").bind("click", {disabled: false}, disabledNode);

		//初始化赋值
	    var ids = [];
		var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
		var nodes = treeObj.getCheckedNodes(true);

		if (nodes.length){
            for(var i=0; i<nodes.length; i++){
                ids[i] = nodes[i].id;
            }
    		
            $("#mid").val(ids);
		}
	});
</SCRIPT>
