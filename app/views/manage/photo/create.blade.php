    <div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal">
    		<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
    	</button>
    	<h4 class="modal-title" id="myModalLabel">添加</h4>
    </div>
    <div class="modal-body">
        <div style="min-height: 300px; height: auto; border:1px solid slategray;" id="dropzone">
        {{ Form::open(array('url' => 'manage/photo/upload/' . $bid, 'class'=>'dropzone', 'id'=>'my-dropzone')) }}
        <!-- Single file upload
        <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
        -->
        <!-- Multiple file upload-->
        <div class="fallback">
            <input name="file" type="file" multiple/>
        </div>
        <br>
        <br>
        {{ Form::close() }}
        </div>
    </div>
    <div class="modal-footer">
    	<button type="submit" class="btn btn-primary modelAdd " data-dismiss="modal">确定</button>
    	<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
    </div>

<script>
    $(document).ready(function(){
    	// myDropzone is the configuration for the element that has an id attribute
        // with the value my-dropzone (or myDropzone)
        Dropzone.options.myDropzone = {
            init: function () {
                this.on("addedfile", function (file) {

                    var removeButton = Dropzone.createElement('<a class="dz-remove">删除</a>');
                    var _this = this;

                    removeButton.addEventListener("click", function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        var fileInfo = new Array();
                        fileInfo['name'] = file.name;

                        $.ajax({
                            type: "POST",
                            url: "{{ url('manage/photo/delete-image') }}",
                            data: {file: "<?php echo date('Ymd_'); ?>" + file.name},
                            success: function (response) {

                                if (response == 'success') {

                                    //alert('deleted');
                                }
                            },
                            error: function () {
                                alert("error");
                            }
                        });

                        _this.removeFile(file);

                        // If you want to the delete the file on the server as well,
                        // you can do the AJAX request here.
                    });

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(removeButton);
                });
            }
        };

        var myDropzone = new Dropzone("#dropzone .dropzone");
        Dropzone.options.myDropzone = false;

//         // Create the mock file:
//         var mockFile = { name: " ", size: " " };

//         // Call the default addedfile event handler
//         myDropzone.emit("addedfile", mockFile);

//         // And optionally show the thumbnail of the file:
//         myDropzone.emit("thumbnail", mockFile, " ");

        
    });
</script>