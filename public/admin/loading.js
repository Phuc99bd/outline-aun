$(document).ready(()=>{
    $(".sidebar-cus").each((i, e)=>{
        $(e).removeClass('mm-active');
        if($(e).attr('href') === location.pathname){
            $(e).addClass('mm-active');
        }
        
    })
    if(['/elo' ,'/subject' , '/setting'].includes(location.pathname)){
        // $(".sidebar-parent").addClass('mm-active');
        $(".sidebar-parent").attr('aria-expanded', true)
        $(".sidebar-show").addClass('mm-show')
        $(".sidebar-show").height('auto')
    }
})