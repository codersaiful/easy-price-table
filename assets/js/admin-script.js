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
            handle: '.handle,.ept-handle',//'.ultratable-handle'//this //.ultratable-handle this is handle class selector , if need '.ultratable-handle',
        });
        
        $('body').on('click', '.ept-add-new-item-button',function(){
            var colElement = $(this).parents('.ept-each-column');
            var val = colElement.find('.ept_elements').val();
            var name_prefix = $(this).attr('data-name_prefix');
            console.log(name_prefix);
            var itemElement = colElement.find('.ept-item-items');
            var itemElementEach = colElement.find('.each-item-wr');
            var length = itemElementEach.length;
            length++;
            if( val === '' ){
                alert( 'Please select an Element.' );
                return;
            }else{
                var itm_html = '<input type="hidden" name="' + name_prefix + '[items][' + length + '][name]" value="' + val + '">';
                //itm_html = '<input type="text" name="' + name_prefix + '[items][' + length + '][' + val + ']" value="' + val + '">';
                if(itemElement.append(itm_html)){
                    $('body.post-type-easy_price_table input#publish[name=save],body.post-type-easy_price_table input#publish[name=publish]').trigger('click'); //publish
                }

            }

        });
        $('body').on('click', '.ept-add-column-button',function(){
            var conf = confirm('Are you sure?.\nA Column will be add.');
            if(conf){
                var count = $('.ept-each-column').length;
                count++;
                if($('.ept-column-wrapper').append('<input type="hidden" name="data[columns][' + count + '][status]" value="on">')){
                    $('body.post-type-easy_price_table input#publish[name=save],body.post-type-easy_price_table input#publish[name=publish]').trigger('click'); //publish
                }
            }
            

        });
        
    });
});
