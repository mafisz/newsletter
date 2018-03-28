
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.List = require('list.js');
window.tinymce = require('tinymce');

$('.delete-btn').click(function(){
    $('.delete-id').val($(this).data('id'));
    $('.delete-name').html($(this).data('name'));
})

$('.status-btn').click(function(){
    $('.status-id').val($(this).data('id'));
    $('.status-name').html($(this).data('name'));
})

$('.delete-btn-2').click(function(){
    $('.delete-id').val($(this).data('id'));
    $('.delete-id-2').val($(this).data('id2'));
    $('.delete-name').html($(this).data('name'));
})

$(window).on('load', function(){
    var options = {
      valueNames: ['name']
    };

    var sortList = new List('items', options);

    var editor_config = {
      path_absolute : "/",
      selector: "textarea.tinymce",
      language: 'pl',
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | preview code",
      relative_urls: false,
      remove_script_host: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
}) 