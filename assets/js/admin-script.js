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
            $('.' + target).trigger('change');
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
        
        function eptFormSubmit(){
            $('body.post-type-easy_price_table input#publish[name=save],body.post-type-easy_price_table input#publish[name=publish]').trigger('click'); //publish
        }
        $( ".ept-main-form.easy-product-table .ept-column-wrapper,.ept-item-items" ).sortable({
            handle: '.handle,.ept-handle',//'.ultratable-handle'//this //.ultratable-handle this is handle class selector , if need '.ultratable-handle',
        });
        
        $('body').on('click', '.ept-add-new-item-button',function(){
            var colElement = $(this).parents('.ept-each-column');
            var val = colElement.find('.ept_elements').val();
            var name_prefix = $(this).attr('data-name_prefix');
            var itemElement = colElement.find('.ept-item-items');
            var itemElementEach = colElement.find('.each-item-wr');
            var length = itemElementEach.length;
            length++;
            if( val === '' ){
                alert( 'Please select an Element.' );
                return;
            }else{
                var itm_html = '<input type="hidden" name="' + name_prefix + '[items][' + length + '][name]" value="' + val + '">';
                var sample_text = '';
                if(val === 'name'){
                    sample_text = 'Sample Text';
                }
                if(val === 'spacer'){
                    sample_text = '20';
                }
                if(val === 'divider'){
                    sample_text = '_________';
                }
                console.log(val);
                if( sample_text !== '' ){
                    itm_html += '<input type="hidden" name="' + name_prefix + '[items][' + length + '][content]" value="' + sample_text + '">';
                }
                //itm_html += '<input type="hidden" name="' + name_prefix + '[items][' + length + '][content]" value="Sample Text">';
                if(itemElement.append(itm_html)){
                    eptFormSubmit();
                }

            }

        });
        $('body').on('click', '.ept-add-column-button',function(){
            var conf = confirm('Are you sure?.\nA Column will be add.');
            if(conf){
                var count = $('.ept-each-column').length;
                count+=Math.round(Math.random() * 100 + 1);
                if($('.ept-column-wrapper').append('<input type="hidden" name="data[columns][' + count + '][status]" value="on">')){
                    eptFormSubmit();
                }
            }

        });
        
        /**
         * Status/Recmmend wise Class Hanndle
         */
        $('body').on('change','.ept-switch',function(){
            var type = $(this).attr('data-type');
            var val = $(this).val();
            var ECOL = $(this).parents( '.ept-each-column' );
            ECOL.toggleClass(type + '_off');
            ECOL.attr('data-' + type, val);
        });
        
        $('body').on('click','.each-item-wr .control-icons-edit',function(){
            $(this).closest('.each-item-wr').find('.item-content-main').toggleClass('visible');
        });
        
        $('.item-content .item-template').each(function(){
            var text = $(this).text();
            var ItemWrEl = $(this).parents('.each-item-wr');
            var item_name = ItemWrEl.data('item_name');
            text = text.replace(/\s/g, "");
            if( text.length === 0 && item_name !== 'banner-image'){
                ItemWrEl.addClass('visible');
            }
        });
        
    });
});
