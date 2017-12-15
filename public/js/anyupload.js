/*
 * 上传插件
 * author 叶宇
 * **/
;(function($){
    var UploadHtml = ''
        + '<div id="--where--" style="display: none;">'
        + '<iframe id="--iframename--" frameborder="1" src="about:blank" marginwidth="0" name="--iframename--" style="display:none"></iframe>'
        + '<form action="--action--" --attr-- method="POST" enctype="multipart/form-data" target="--iframename--"  >'
        + '--addInput--'
        + '<input type="file" name="Filedata" onchange="this.form.submit()"/>'
        + '</form>'
        + '</div>';
    $.fn.extend({

        Upload:function(options){
            options = options || {};
            var params = options.formData || {}
            var type = params.type || 'all';
            var before = options.before || function(en,data){}
            var completed = options.completed || function(en,data){}
            var success = options.completed || function(en,data){}
            var url = options.url;
            var addInput = '';
            for(var i in params){
                addInput += '<input type="hidden" name="'+i+'" value="'+(params[i])+'">';
            }

            $(this).each(function(i){
                  iframename = 'iframe'+$(this).attr('clickname');
                  ms = $(this).attr('clickname');
                  if(!$('#type'+ms).length){
                      var _tpl    = UploadHtml.replace(/\-\-action\-\-/g, url).replace(/\-\-where\-\-/g, 'type'+ms).replace(/\-\-iframename\-\-/g, iframename).replace(/\-\-addInput\-\-/g, addInput);
                      $('body').append(_tpl);
                  }
                  $(this).click(function(){
                      before();
                      ms = $(this).attr('clickname');
                      $('#type'+ms).find('input[name="Filedata"]').click();
                      en = $(this);
                  })
                  $('iframe[name="'+iframename+'"]').on('load',function(){
                      var responseText = $(this).get(0).contentDocument.body.textContent;
                      var responseData = JSON.parse(responseText) || {};
                      completed(en,responseData)
                  })
            })

        }
    });
})(jQuery);