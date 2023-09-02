$(function(){

    //convert password field to text field om hover
    var passfield =$('.password')
    $('.show-pass').hover(function (){
        passfield.attr('type','text')
    },function(){
        passfield.attr('type','password')

    });
    //confrmation massege on button
    $('.confirm').click(function(){
        return confirm('Are you sure?');
    })
    //categoty view option
    $('.cat h3').click(function(){
        $(this).next('.full-view').fadeToggle(200);
    });
    $('.option span').click(function(){
        $(this).addClass('active').siblings('span').removeClass('active');
        if ($(this).data('view')==='full'){
            $('.full-view').fadeIn(200);
        }
        else{
            $(' .full-view').fadeOut(200);
            
        }
    });
});




//for search of all data in table use jquery
$('#search').on('input',function(){
    var search = $(this).val().toLowerCase()
    $('#recordsTbl tbody tr').each(function(){
        if(($(this).text().toLowerCase()).includes(search) === true){
            $(this).toggle(true)
        }else{
            $(this).toggle(false)
        }
    })
    if($('#recordsTbl tbody tr:visible').length > 0){
        $('#no_search').hide()
    }else{
        $('#no_search').show()
    }
})
function no_record(){
    alert("Sorry, no record found!")
}