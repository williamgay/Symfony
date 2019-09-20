$(document).ready(function(){
    $('.like-article').on('click', function(e){
        e.preventDefault();
        var link = $(e.currentTarget);
        link.toggleClass("far fa-thumbs-up").toggleClass("fas fa-thumbs-up");
        $.ajax({
            method:'POST',
            url: link.attr('href')
        }).done(function(data){
            $('.likeArticleCount').html(data.likes);
        });

    });
});