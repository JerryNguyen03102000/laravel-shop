
$(function(){
    $("#main_form").on("submit",function(e){
        e.preventDefault();
        let url = $('#main_form').data('url');
        let _token = $("input[name='_token']").val();
        let career_name = $("input[name='career_name']").val();
        let describe = $("input[name='describe']").val();
        let parent_id = $("select[name='parent_id']").val();
        console.log(parent_id);
        $.ajax({
            url: url,
            type:'POST',
            data: {
                _token:_token,
                career_name:career_name,
                describe:describe,
                parent_id:parent_id
            },
            success: function(data) {
                if(typeof data.error != 'undefined' && data.error){

                    printErrorMsg(data.error);
                }else{

                    location.reload();
                }
            },
            error: function (error) {

                console.log(error);
            }
        });
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }
});
$(function(){
    $("#edit_form").on("submit",function(e){
        e.preventDefault();
        let url = $('#edit_form').data('url');
        let _token = $("input[name='_token']").val();
        let career_name = $("input[name='career_name_edit']").val();
        let describe = $("input[name='describe_edit']").val();
        let parent_id = $("select[name='parent_id_edit']").val();
        console.log(career_name);
        $.ajax({
            url: url,
            type:'POST',
            data: {
                _token:_token,
                career_name:career_name,
                describe:describe,
                parent_id:parent_id
            },
            success: function(data) {
                if(typeof data.error != 'undefined' && data.error){
                    printErrorMsg(data.error);
                }else{
                    location.reload();
                }
            },
            error: function (error) {
                console.log(error);
            }
        });
    });

    function printErrorMsg (msg) {
        $(".print-error-msg-edit").find("ul").html('');
        $(".print-error-msg-edit").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg-edit").find("ul").append('<li>'+value+'</li>');
        });
    }

});

