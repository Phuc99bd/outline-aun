
function createElo(){
    $(".btn-elo-create").on('click',function(){
        let elo = $(".input-elo").val();
        let status = $(".input-elo-status").val();
        let item = {
            title: elo,
            status
        }
        $.ajax({
            url: "/api/v1/elo/create",
            type: "POST",
            data: JSON.stringify(item),
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
                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm btn-elo-detail" data-id="${data.id}">Edit</button>
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-elo-delete" data-id="${data.id}"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                </td>
            </tr>`;
               $(".elo-body").prepend(newData);
               Swal.fire(
                `Create elo successfully`,
                'You clicked the button!',
                'success'
              )
              $(".btn-out-modal").click();
              editElo();
              deleteElo();
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

function editElo(){
    $(".btn-elo-detail").on("click",function(){
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/elo/detail`,
            type: "GET",
            data: { id },
            success: ({data})=>{
                $(".input-edit-elo").val(data.title || "");        
                $(".btn-elo-update").attr("data-id",data.id);
            }
        })
    })
    $(".btn-elo-update").on("click",function(){
        let id = $(this).attr("data-id");
        let title = $(".input-edit-elo").val();
        let status = +$(".input-elo-edit-status").val();

        $.ajax({
            url: "/api/v1/elo/update",
            type: "PUT",
            data:  title ? { id , status , title } : { id , status },
            success: (data)=>{

                $(`.elo-body tr[data-id=${data.id}]`).find("td:nth-child(2)").html(data.title);
                $(".btn-out-modal").click();

                Swal.fire(
                    `Update elo successfully`,
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

function deleteElo(){
    $(".btn-elo-delete").on("click",function(){
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
                    url: `/api/v1/elo/delete`,
                    type: 'DELETE',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $(".elo-body").find(`tr[data-id=${id}]`).remove();
                        }
                    }
                })
            }
        })
    })
}

$(document).ready(function () {
    createElo();
    editElo();
    deleteElo();
})