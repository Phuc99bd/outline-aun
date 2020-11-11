function createOutline(){
    $(".btn-outline-create").on('click',function(){
        let title = $(".input-outline").val();
        let subject_id = +$(".input-outline-list").val();
        let user_id = +$(this).attr("data-id");
        const is_practice = +$(".practice-outline").val();
        let item = {
            title,
            subject_id,
            user_id,
            is_practice
        }
        $.ajax({
            url: "/api/v1/outline/create",
            type: "POST",
            data: JSON.stringify(item),
            contentType: "application/json",
            success: function ({ data }) {
               const html = `<tr data-id="${data.id}">
               <td class="text-center text-muted">#${data.id}</td>
               <td>
                    ${data.title}
               </td>
               <td>
                   ${data.version}
               </td>
               <td>
                   ${data.subject.title}
               </td>
               <td>
                   ${data.is_practice == 0 ? "Lý thuyết" : "Thực hành"}
               </td>
               <td class="text-center">
                   <button type="button" data-toggle="modal" data-target="#bd-outline-update"
                       class="btn btn-primary btn-sm btn-outline-detail"
                       data-id="${data.id}">detail</button>
                   <button
                       class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-outline-delete"
                       data-id="${data.id}"><i class="pe-7s-trash btn-icon-wrapper">
                       </i></button>
               </td>
               <td class="text-center">
                   <button type="button" data-toggle="modal" data-target="#bd-outline-update"
                       class="btn btn-primary btn-sm btn-outline-export"
                       data-id="${data.id}">Export Word</button>
                   <a
                       class="btn btn-primary btn-sm btn-outline-export"
                      href="/preview?id=${data.id}">Preview</a>

               </td>
               <td class="text-center">
                   <button type="button" data-toggle="modal" data-target="#bd-outline-update"
                       class="btn btn-primary btn-sm btn-outline-version"
                       data-id=${data.id}>Clone up version</button>

               </td>
           </tr>`
            $(".outline-body").prepend(html);
            $(".btn-out-modal").click();
            deleteOutline();
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
    $(".btn-outline-show-create").on("click",function(){
        $.ajax({
            url: "/api/v1/subject/list",
            type: "get",
            contentType: "application/json",
            success: function ({data}) {
                console.log(data);
                $(".input-outline-list").html("");
                data.map(e=>{
                    $(".input-outline-list").append(`<option value=${e.id}> ${e.title} </option>`);
                })
            }
      })
    })
}

function deleteOutline(){
    $(".btn-outline-delete").on("click",function(){
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
                    url: `/api/v1/outline/delete`,
                    type: 'DELETE',
                    data: { id },
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            $(".outline-body").find(`tr[data-id=${id}]`).remove();
                        }
                    }
                })
            }
        })
    })
}

$(document).ready(function () {
    createOutline();
    deleteOutline();
})