/*
Template Name: Qovex - Responsive Bootstrap 4 Admin Dashboard
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Task creat 
*/

$(document).ready(function () {
    'use strict';

    $('.summernote').summernote({
        height: 200,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });

    window.outerRepeater = $('.outer-repeater').repeater({
        defaultValues: { 'text-input': 'outer-default' },
        show: function () {
            console.log('outer show');
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            console.log('outer delete');
            $(this).slideUp(deleteElement);
        },
        repeaters: [{
            selector: '.inner-repeater',
            defaultValues: { 'inner-text-input': 'inner-default' },
            show: function () {
                console.log('inner show');
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                console.log('inner delete');
                $(this).slideUp(deleteElement);
            }
        }]
    });
});