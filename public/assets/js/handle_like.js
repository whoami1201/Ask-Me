// Handle the like function of the system on index and detail page
$('.vote-section .like, .vote-section .dislike').click(function(e){  
    e.preventDefault();
    var $temp = $(this);
    $.get($temp.attr('href'),function($data){ 
        $temp.parent('.btn-group').find('.vote-count').text($data);
    }).fail(function(){ 
        alert('An error has been occurred, please try again later'); 
    }); 
}); 