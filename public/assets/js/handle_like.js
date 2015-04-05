// Handle the like function of the system on index and detail page
// Downvote
$('.vote-section .dislike').click(function(e){  
    e.preventDefault();
    var $temp = $(this);
    $.get($temp.attr('href'),function($data){
        $temp.next().find('.vote-count').text($data);
    }).fail(function(){ 
        alert('An error has been occurred, please try again later'); 
    }); 
}); 
//Upvote
$('.vote-section .like').click(function(e){  
    e.preventDefault();
    var $temp = $(this);
    $.get($temp.attr('href'),function($data){
        $temp.parent('.btn-group').find('.vote-count').text($data);
    }).fail(function(){ 
        alert('An error has been occurred, please try again later'); 
    }); 
}); 