$(function() {  

    $('.add_item').click(function() {
        var item_id = $(this).attr('id');
        enableEditBox($(this).parent().parent(), item_id);
    });
    
    $('#signup-email').click(function(){
        $('#login_dialog').modal();
    });
    
    $('#submit_login_form').click(function(event) {
        event.preventDefault();
        formData = $('#login_form').serialize();
        var data=data
        $.ajax({
            type: "POST",
            url: 'http://localhost/bbY/user/register_ajax',
            cache : false,
            data: formData,
            success : function(html) {
                alert(html);
                $('#long_form_alert').text("Sorry it was an error");
                $('#long_form_alert').show();
                // var response = JSON.parse(html);
                // alert(response);
            },
            error : function(html) {
                alert('It failed');
            }

        });
        return false;
    });

    $('#login_dialog').on('show', function() {
        
        
    });
}); 

function enableEditBox(item, item_id) {
     item.replaceWith(
           '<tr><td><p><input id="' + item_id + '" type="text" placeholder="Shopping Item" class="negative-margin"></p></td></tr>'
     );
     $('#' + item_id).focus();
     $('#' + item_id).on("keydown", function(e) {
        if (e.which == 13) 
        {
            var el = $(this).val();
            if (! el) return;
            submitItem(el, item_id);

            return false;
        }

    });
}

function submitItem(value, item_id) {
    $.ajax({
        type: "GET",
        url: "http://localhost/bbY/user/ajax_test",
        data: "elect_item=" + value,
        success: function(html) {
            var response = JSON.parse(html);
            if (response.status == 1) {
                // Get the parent TD element. 
                var td_el = $('#' + item_id).parent().parent().parent();
                td_el.replaceWith(
                    '<tr><td>' + value + '</td></tr>' + 
                    '<tr><td> <a href="#" id="' + item_id + '" class="add_item"><i class="icon-plus-sign"> </i><em> add.. </em> </a></td></tr>'
                );

                $('.add_item').off('click');

                $('.add_item').on('click', function() {
                    var item_id = $(this).attr('id');
                    enableEditBox($(this).parent().parent(), item_id);
                });
            	
                $('#message').css('visibility', 'hidden');
        	} else {
        		$('#message').css('visibility', 'visible');
        	}

        },
        error: function() {
        	$('#message').css('visibility', 'visible');
        }
    });
}