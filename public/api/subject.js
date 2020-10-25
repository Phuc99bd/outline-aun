
function createSubject(){
    $(".btn-subject-create").on('click',function(){
        let subject = $(".input-subject").val();
        let status = $(".input-subject-status").val();
        let item = {
            title: subject,
            status
        }
        $.ajax({
            url: "/api/v1/subject/create",
            type: "POST",
            data: JSON.stringify(item),
            contentType: "application/json",
            success: function ({ data }) {
                $(".input-subject").val("");
                let status = data.status == 0 ? "INACTIVE" : data.status == 2 ? "PENDING" : "ACTIVE";
                let newData = `<tr data-id="${data.id}">
                <td class="text-center text-muted">#${data.id}</td>
                <td>
                    ${data.title}
                </td>
                <td class="text-center">
                    <div class="badge badge-warning">
                    ${status}
                    </div>
                </td>
                <td class="text-center">
                        <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm btn-subject-detail" data-id="${data.id}">Edit</button>
                        <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-subject-delete" data-id="${data.id}"><i class="pe-7s-trash btn-icon-wrapper"> </i></button>
                </td>
            </tr>`;
               $(".subject-body").prepend(newData);
               Swal.fire(
                `Create subject successfully`,
                'You clicked the button!',
                'success'
              )
              $(".btn-out-modal").click();
              editSubject();
              deleteSubject();
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

function editSubject(){
    let titleCurrent;
    $(".btn-subject-detail").on("click",function(){
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/subject/detail`,
            type: "GET",
            data: { id },
            success: ({data})=>{
                $(".input-edit-subject").val(data.title || "");
                let obj = {
                    0: "Đình chỉ",
                    1: "Hoạt động",
                    2: "Chờ duyệt"
                }
                titleCurrent = data.title;
                $(".input-subject-edit-status").html("");
                for(let i in obj){
                    let checked = i == data.status ? "selected" : "";
                    $(".input-subject-edit-status").append(`<option value=${i} ${checked}> ${obj[i]} </option>`);
                }
                $(".btn-subject-update").attr("data-id",data.id);
            }
        })
    })
    $(".btn-subject-update").on("click",function(){
        let id = $(this).attr("data-id");
        let title = $(".input-edit-subject").val();
        let status = +$(".input-subject-edit-status").val();

        $.ajax({
            url: "/api/v1/subject/update",
            type: "PUT",
            data:  title ? { id , status , title } : { id , status },
            success: (data)=>{
                let statusNew = data.status == 1 ? "ACTIVE" : data.status == 2 ? "PENDING" : "INACTIVE";

                $(`.subject-body tr[data-id=${data.id}]`).find("td:nth-child(2)").html(data.title);
                $(`tr[data-id=${data.id}]`).find("td:nth-child(3)").html(` <div class="badge badge-warning">${statusNew} </div>`);
                $(".btn-out-modal").click();

                Swal.fire(
                    `Update subject successfully`,
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

function deleteSubject(){
    $(".btn-subject-delete").on("click",function(){
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
                    url: `/api/v1/subject/delete`,
                    type: 'DELETE',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $(".subject-body").find(`tr[data-id=${id}]`).remove();
                        }
                    }
                })
            }
        })
    })
}

$(document).ready(function () {
    createSubject();
    editSubject();
    deleteSubject();
})