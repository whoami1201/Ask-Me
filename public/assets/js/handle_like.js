// Handle the like function of the system on index and detail page
$('.like, .dislike').click(function(e){
    e.preventDefault();
    var $temp = $(this);
    $.get($temp.attr('href'),function($data){
        $temp.closest('.vote-section').find('.vote-count').text($data);
    }).fail(function(){
        alert('An error has been occurred, please try again later');
    });
});