layui.config({
	base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
	    var form = layui.form(),
		layer = parent.layer === undefined ? layui.layer : parent.layer,
		laypage = layui.laypage,
		layedit = layui.layedit,
		laydate = layui.laydate,
		$ = layui.jquery;
        var jianjie = UE.getEditor('jianjie');
        var jihua = UE.getEditor('jihua');
        var liangdian = UE.getEditor('liangdian');
        var price = UE.getEditor('price');
        var process = UE.getEditor('process');
        var callback = UE.getEditor('callback');
        var content = UE.getEditor('content');
        $('#sub').click(function(){
            $.ajax({
                type: 'post',
                url: '/Admin/content/modify',
                data: $("#form").serialize(),
                dataType: "json",
                success: function(data) {
                    if(data.status == '200'){
                        layer.msg("操作成功");
                        location.reload();
                    }
                }
            })
        })

	
})
