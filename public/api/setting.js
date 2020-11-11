
function editSetting(){
    let thisSetting;
    $(".btn-setting-detail").on("click",function(){
        let id = $(this).attr("data-id");
        thisSetting = this;
        $.ajax({
            url: `/api/v1/setting/detail`,
            type: "GET",
            data: { id },
            success: ({data})=>{
                console.log(data);
                $(".input-edit-setting").val(data.title || "");        
                $(".input-value-setting").val(data.value || "");        
                $(".input-description-setting").val(data.description || "");        
                $(".btn-setting-update").attr("data-id",data.id);
            }
        })
    })
    $(".btn-setting-update").on("click",function(){
        let id = $(this).attr("data-id");
        let title = $(".input-edit-setting").val();
        let value = $(".input-value-setting").val();
        let description = $(".input-description-setting").val();
        $.ajax({
            url: "/api/v1/setting/update",
            type: "PUT",
            data:  { id , title , description , value},
            success: (data)=>{
               $(thisSetting).html(data.title);

                Swal.fire(
                    `Update setting successfully`,
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
    editSetting();
})