
function outlineDetail(){
    $(".btn-detail-outlineDetail").on("click",function(){
        let id = $(this).attr("data-id");
        $.ajax({
            url: "/api/v1/outline-detail/detail",
            method: "GET",
            data: { id: id },
            success: ({data})=>{
                $("div#froala-editor").find("div.fr-view").html(data.content);
                $(".btn-outline-detail-update").attr("data-id",id);
            },
            error: ({ responseJSON })=>{
                let msg = "";
                for(let i in responseJSON.error){
                    responseJSON.error[i].map(e=>{
                        msg += `${e} \n`;
                    })
                }
                Swal.fire(
                    msg,
                    'You clicked the button!',
                    'error'
                  )
            }
        })
    })
    $(".btn-outline-detail-update").on("click",function(){
        let id = $(this).attr("data-id");
        const content = $("div#froala-editor").find("div.fr-view").html().replace(/"/g, `'`);
        $.ajax({
            url: "/api/v1/outline-detail/update",
            method: "PUT",
            data: { id , content },
            success: ({data})=>{
                Swal.fire(
                    `Update outline dtail successfully`,
                    'You clicked the button!',
                    'success'
                  )
                $(".btn-out-modal").click();
            },
            error: ({ responseJSON })=>{
                let msg = "";
                for(let i in responseJSON.error){
                    responseJSON.error[i].map(e=>{
                        msg += `${e} \n`;
                    })
                }
                Swal.fire(
                    msg,
                    'You clicked the button!',
                    'error'
                  )
            }
        })
    })
}

$(document).ready(function(){
    outlineDetail();
})