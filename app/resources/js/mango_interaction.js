function loginValidation(){
    if(document.getElementById('username') == null){
        Swal.fire(
            'Sem login sem like...',
            'Você precisa estar logado para interagir com os posts!',
            'warning'
        );
        return false;
    }
    return true;
}
$('.btn-like').click(function (e) { 
    e.preventDefault();
    if(!loginValidation()){
        return false;
    }

    var btn_like = document.getElementById(e.currentTarget.id);
    var btn_unlike = document.getElementById(btn_like.parentElement.children[2].id);
    var post_ID = btn_like.parentElement.children[0].value;
    var countLikes = document.getElementsByClassName(btn_like.children[1].className);
    var countUnlikes = document.getElementsByClassName(btn_unlike.children[1].className);
    
    if(btn_like.attributes['like_unlike'].value == 'false' && btn_unlike.attributes['like_unlike'].value == 'true'){
        //saindo do unlike e indo pro like
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'true');
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'true');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-dark');
        $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-light');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'like'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
        return true;
    }else if(btn_like.attributes['like_unlike'].value == 'false' && btn_unlike.attributes['like_unlike'].value == 'false'){
        //dando like pela primeira vez
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'true');
        $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-dark');
        $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-light');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'like'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
        return true;
    }
    // else if(btn_like.attributes['like_unlike'].value == 'true' && btn_unlike.attributes['like_unlike'].value == 'true'){
    //     //tirando o like quando os dois estavam pressionados
    //     btn_like.attributes['like_unlike'].value = 'false';
    //     $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
    //     $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
    //     return false;
    // }
    else {//if(btn_like.attributes['like_unlike'].value == 'true' && btn_unlike.attributes['like_unlike'].value == 'false'){
        //tirando a interação com o post
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'nothing'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
    }
});
$('.btn-unlike').click(function (e) { 
    e.preventDefault();
    if(!loginValidation()){
        return false;
    }
    var btn_unlike = document.getElementById(e.currentTarget.id);
    var btn_like = document.getElementById(btn_unlike.parentElement.children[1].id);
    var countLikes = document.getElementsByClassName(btn_like.children[1].className);
    var countUnlikes = document.getElementsByClassName(btn_unlike.children[1].className);    
    
    var post_ID = btn_unlike.parentElement.children[0].value;

    if(btn_unlike.attributes['like_unlike'].value == 'false' && btn_like.attributes['like_unlike'].value == 'true'){
        //saindo do unlike e indo pro like
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'true');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-dark');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-light');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'unlike'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
        return true;
    }else if(btn_unlike.attributes['like_unlike'].value == 'false' && btn_like.attributes['like_unlike'].value == 'false'){
        //dando like pela primeira vez
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'true');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-dark');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-light');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'unlike'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
        return true;
    }
    // else if(btn_unlike.attributes['like_unlike'].value == 'true' && btn_like.attributes['like_unlike'].value == 'true'){
    //     //tirando o like quando os dois estavam pressionados
    //     btn_unlike.attributes['like_unlike'].value = 'false';
    //     $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
    //     $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
    //     return false;
    // }
    else {//if(btn_unlike.attributes['like_unlike'].value == 'true' && btn_like.attributes['like_unlike'].value == 'false'){
        //tirando a interação com o post
        $(countLikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $(countUnlikes).parent().parent('.btn-unlike').prevObject.attr('like_unlike', 'false');
        $(countLikes).parent().parent('.btn-unlike').prevObject.removeClass('text-light');
        $(countLikes).parent().parent('.btn-unlike').prevObject.addClass('text-dark');
        $.ajax({
            url: "post_interaction.php",
            method: "post",
            data: {
                post_ID: post_ID,
                like_unlike: 'nothing'
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                
                $(countLikes).text(data['data']['like']);
                $(countUnlikes).text(data['data']['unlike']);

            },
            error: function(data) {
                console.log(data);
            }
        });
        return true;
    }
});