$(document).ready(function(){


    $(".comment-container").delegate(".reply","click",function(){

        var well = $(this).parent().parent();
        var cid = $(this).attr("cid");
        var owner = $(this).attr("owner");
        var name = $(this).attr('name_a');
        var token = $(this).attr('token');
        var form = '<form method="post" action="/reply/'+ cid +'">' +
            '<input type="hidden" name="_token" value="'+token+'">' +
            '<input type="hidden" name="comment_id" value="'+ cid +'">' +
            '<input type="hidden" name="name" value="'+name+'">' +
            '<div class="form-group">' +
            '<textarea class="form-control" name="reply"  >'+owner+","+' </textarea> </div> <div class="form-group"> ' +
            '<input class="reply-btn"  type="submit"> ' +
            '</div>' +
            '</form>';

        well.find(".reply-form").append(form);



    });


    $(".comment-container").delegate(".reply-to-reply","click",function(){
        var well = $(this).parent().parent();
        var cid = $(this).attr("rid");
        var rname = $(this).attr("rname");
        var token = $(this).attr("token");
        var form = '<form method="post" action="/reply/'+ cid +'">' +
            '<input type="hidden" name="_token" value="'+token+'">' +
            '<input type="hidden" name="comment_id" value="'+ cid +'">' +
            '<input type="hidden" name="name" value="'+rname+'">' +
            '<div class="form-group">' +
            '<textarea class="form-control" name="reply" style="margin-top: 5px;"  >' +
            '</textarea> ' +
            '</div> <' +
            'div class="form-group"> ' +
            '<input class="reply-btn" style="font-size: 10px; border-color: #FFF;" type="submit"> ' +
            '</div>' +
            '</form>';

        well.find(".reply-to-reply-form").append(form);

    });

    $(".comment-container").delegate(".delete-reply", "click", function(){

        var well = $(this).parent().parent();

        if (confirm("Вы уверены что хотите удалить это сообщение?")) {
            var did = $(this).attr("did");
            var token = $(this).attr("token");
            $.ajax({
                url : "/reply/" + did + "/delete",
                method : "POST",
                data : {_method : "delete", _token: token},
                success:function(response){
                    if (response == 1) {
                        well.hide();
                        //alert("Your reply is deleted");
                    }else if(response == 2){
                        alert('Упс! Вы не можете удалить комментарий других');
                    }else{
                        alert('Что-то пошло не так, пожалуйста повторите попытку!');
                    }
                }
            })
        }



    });

});
