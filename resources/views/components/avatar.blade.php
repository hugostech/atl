{!! Form::open(['route'=>['car_avatar_update', 'id'=>$car->id], 'method'=>'post', 'files'=>true, 'onsubmit'=>"return confirm('Are you sure?')"]) !!}
<label class="imagecheck mb-4">
    {!! Form::file('avatar', ['class'=>'custom-file-input', 'onchange'=>'PreviewImage(this)']); !!}
    <figure class="imagecheck-figure">
        <img src="{{$car->image}}" alt="avatar" id="img_avatar" class="imagecheck-image">
    </figure>

</label>
<div class="form-group">
    {!! Form::submit('Update Avatar', ['class'=>'btn btn-bitbucket btn-block']) !!}
</div>
{!! Form::close() !!}
<script>
    function PreviewImage(imgFile) {
        var pattern = /(\.*.jpg$)|(\.*.png$)|(\.*.jpeg$)|(\.*.gif$)|(\.*.bmp$)/;
        if (!pattern.test(imgFile.value)) {
            alert("系统仅支持jpg/jpeg/png/gif/bmp格式的照片！");
            imgFile.focus()
        } else {
            var path;
            if (document.all) {
                imgFile.select();
                // path = document.selection.createRange().text;
                // document.getElementById("imgPreview").innerHTML = "";
                // document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")"
            } else {
                path = URL.createObjectURL(imgFile.files[0]);
                $('#img_avatar').attr('src',path);
            }
        }
    }
</script>
