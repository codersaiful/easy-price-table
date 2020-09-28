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
        
        $('body').on('click', '.ept-add-new-item-button',function(){
            var colElement = $(this).parents('.ept-each-column');
            var val = colElement.find('.ept_elements').val();
            var name_prefix = $(this).attr('data-name_prefix');
            console.log(name_prefix);
            var itemElement = colElement.find('.each-item-wr');
            var length = itemElement.length;
            length++;
            if( val === '' ){
                alert( 'Please select an Element.' );
                return;
            }else{
                /**
                <div class="item-head handle ui-sortable-handle">
                        name                        <div class="item-controllers">
                            <i class="control-icons control-icons-delete">X</i>
                        </div>
                    </div>
                 * @type String
                 */
                var itm_html = '<input type="text" name="' + name_prefix + '[items][' + length + '][name]" value="' + val + '">';
                //itm_html = '<input type="text" name="' + name_prefix + '[items][' + length + '][' + val + ']" value="' + val + '">';
                itemElement.append(itm_html);
                //itm_html += '<div class="item-controllers"><i class="control-icons control-icons-delete">X</i></div>';
                //itm_html += '</div>';
            }

        });
        
    });
});
