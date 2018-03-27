
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.List = require('list.js');

$('.delete-btn').click(function(){
    $('.delete-id').val($(this).data('id'));
    $('.delete-name').html($(this).data('name'));
})

$(window).on('load', function(){
    var options = {
      valueNames: ['name']
    };

    var sortList = new List('items', options);

    console.log(sortList);
})