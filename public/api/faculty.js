
function createFaculty(){
    $(".btn-faculty-create").on('click',function(){
        let faculty = $(".input-faculty").val();
     
        $.ajax({
            url: "/api/v1/faculty/create",
            type: "POST",
            data: JSON.stringify({ title: faculty }),
            contentType: "application/json",
            success: function ({ data }) {
                $(".input-elo").val("");
                let status = data.status == 0 ? "INACTIVE" : data.status == 2 ? "PENDING" : "ACTIVE";
                let newData = `<tr data-id="${data.id}">
                <td class="text-center text-muted">#${data.id}</td>
                <td>
                ${data.title}
                </td>
                <td class="text-center">
                     <button type="button" data-toggle="modal" data-target="#bd-faculty-update" class="btn btn-primary btn-sm btn-faculty-detail" data-id=${data.id}>Edit</button>
                     <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-faculty-delete" data-id=${data.id}><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                </td>
            </tr>`;
               $(".faculty-body").prepend(newData);
               $(".btn-out-modal").click();
               Swal.fire(
                `Create faculty successfully`,
                'You clicked the button!',
                'success'
              )
              editFaculty()
              deleteFaculty()
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

function editFaculty(){
    $(".btn-faculty-detail").unbind('click').on("click",function(){
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/faculty/detail`,
            type: "GET",
            data: { id },
            success: ({data})=>{
                $(".input-edit-faculty").val(data.title || "");        
                $(".btn-faculty-update").attr("data-id",data.id);
            }
        })
    })
    $(".btn-faculty-update").on("click",function(){
        let id = $(this).attr("data-id");
        let title = $(".input-edit-faculty").val();

        $.ajax({
            url: "/api/v1/faculty/update",
            type: "PUT",
            data:  title ? { id ,title } : { id },
            success: (data)=>{

                $(`.faculty-body tr[data-id=${data.id}]`).find("td:nth-child(2)").html(data.title);
                $(".btn-out-modal").click();

                Swal.fire(
                    `Update faculty successfully`,
                    'You clicked the button!',
                    'success'
                )
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

function deleteFaculty(){
    $(".btn-faculty-delete").unbind('click').on("click",function(){
        let id = $(this).data("id");
        Swal.fire({
            title: `Bạn có chắc chắn xóa không?`,
            text: `You won't be able to revert!`,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/api/v1/faculty/delete`,
                    type: 'DELETE',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $(".faculty-body").find(`tr[data-id=${id}]`).remove();
                        }
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
            }
        })
    })
}

$(document).ready(function () {
    createFaculty();
    editFaculty();
    deleteFaculty();
})