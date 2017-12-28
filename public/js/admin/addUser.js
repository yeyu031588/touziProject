layui.config({
    base : "js/"
}).use(['form','layer','jquery','layedit','laydate'],function(){
    var form = layui.form(),
        layer = parent.layer === undefined ? layui.layer : parent.layer,
        laypage = layui.laypage,
        layedit = layui.layedit,
        laydate = layui.laydate,
        $ = layui.jquery;

    $('#sub').click(function(){
        $.ajax({
            type: 'post',
            url: '/Admin/user/modify',
            data: $("#form").serialize(),
            dataType: "json",
            success: function(data) {
                if(data.status == '200'){
                    layer.msg("编辑成功");
                    location.reload();
                }else{
                    layer.msg(data.msg);

                }
            }
        })
    })


})
