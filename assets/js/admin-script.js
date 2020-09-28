jQuery(document).ready(function($){
    'use strict';
    $(document).ready(function () {
        $('body').on('change','.ept-placeholder-onoff',function(){
            var target = $(this).attr('data-target');
            if($(this).is(":checked")){
                $('.' + target).val('on');
            }else if($(this).is(":not(:checked)")){
                $('.' + target).val('off');
            }
        });
        
        
        
        
        $('body').on('click','.easy-product-table .column-control-icons>i.control-icons.control-icons-delete',function(e){
            var conf = confirm('Item will be remove. Unable to redo.\nAre you sure?');
            if(conf){
                $(this).closest('.ept-each-column').remove();
            }
        });
        
        
        
        
        $('body').on('click','.easy-product-table .each-item-wr .item-controllers>i.control-icons.control-icons-delete',function(e){
            var conf = confirm('Item will be remove. Unable to redo.\nAre you sure?');
            if(conf){
                $(this).closest('.each-item-wr').remove();
            }
        });
        
        
        $( ".ept-main-form.easy-product-table .ept-column-wrapper,.ept-item-items" ).sortable({
            handle: '.handle',//'.ultratable-handle'//this //.ultratable-handle this is handle class selector , if need '.ultratable-handle',
        });
        
        
        
    });
});
