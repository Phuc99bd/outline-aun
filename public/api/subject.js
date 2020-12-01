function createSubject() {
    $(".btn-subject-create").on("click", function () {
        let subject = $(".input-subject").val();
        let title_en = $(".input-subject-en").val();
        let status = $(".input-subject-status").val();
        let code = $(".input-code-subject").val();
        let faculty_id = $(".input-subject-faculty").val();
        let item = {
            title: subject,
            title_en,
            status,
            subject_code: code,
            faculty_id: faculty_id,
        };
        console.log(item);
        $.ajax({
            url: "/api/v1/subject/create",
            type: "POST",
            data: JSON.stringify(item),
            contentType: "application/json",
            success: function ({ data }) {
                console.log(data);
                $(".input-subject").val("");
                $(".input-subject-en").val("");
                $(".input-code-subject").val("");
                let status =
                    data.status == 0
                        ? "INACTIVE"
                        : data.status == 2
                        ? "PENDING"
                        : "ACTIVE";
                let newData = `<tr data-id="${data.id}">
                <td class="text-center text-muted">#${data.id}</td>
                <td>
                    ${data.title}
                </td>
                <td>
                    ${data.subject_code}
                </td>
                <td>
                    ${data.title_en}
                </td>
                <td>
                    ${data.faculty.title}
                </td>
                <td>
                                                    <button type="button" data-toggle="modal" data-target="#bd-subject-assign" class="btn btn-primary btn-sm btn-subject-assign" data-id=${data.id}>
                                                    <i class="fas fa-plus"></i> &nbsp; Assign
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-green btn-sm btn-subject-views" data-id=${data.id}>
                                                    <i class="fas fa-allergies"></i> &nbsp; Views
                                                    </button>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-green" data-id=${data.id}>
                                                    <i class="fas fa-abacus"></i> &nbsp; 0/0 (100%)
                                                    </button>
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
                    "You clicked the button!",
                    "success"
                );
                $(".btn-out-modal").click();
                editSubject();
                deleteSubject();
                assign();
                unAssign();
            },
            error: ({ responseJSON }) => {
                let msg = "";
                for (let i in responseJSON.error) {
                    responseJSON.error[i].map((e) => {
                        msg += `${e} \n`;
                    });
                }
                Swal.fire(msg, "You clicked the button!", "error");
            },
        });
    });
}

function editSubject() {
    let titleCurrent;
    $(".btn-subject-detail").on("click", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/subject/detail`,
            type: "GET",
            data: { id },
            success: ({ data, faculties }) => {
                $(".input-edit-subject").val(data.title || "");
                let obj = {
                    0: "Đình chỉ",
                    1: "Hoạt động",
                    2: "Chờ duyệt",
                };
                titleCurrent = data.title;
                $(".input-subject-edit-status").html("");
                $(".input-subject-edit-faculty").html("");
                $(".input-edit-code-subject").val(data.subject_code || "");
                $(".input-edit-subject-en").val(data.title_en || "");
                faculties.map((e) => {
                    const checked = e.id == data.faculty_id ? "selected" : "";
                    $(".input-subject-edit-faculty").append(
                        `<option value="${e.id}" ${checked}> ${e.title} </option>`
                    );
                });
                for (let i in obj) {
                    let checked = i == data.status ? "selected" : "";
                    $(".input-subject-edit-status").append(
                        `<option value=${i} ${checked}> ${obj[i]} </option>`
                    );
                }
                $(".btn-subject-update").attr("data-id", data.id);
            },
        });
    });
    $(".btn-subject-update").on("click", function () {
        let id = $(this).attr("data-id");
        let title = $(".input-edit-subject").val();
        let title_en = $(".input-edit-subject-en").val();
        let status = +$(".input-subject-edit-status").val();
        let code = $(".input-edit-code-subject").val();
        let faculty_id = +$(".input-subject-edit-faculty").val();
        $.ajax({
            url: "/api/v1/subject/update",
            type: "PUT",
            data: {
                id,
                status,
                title,
                subject_code: code,
                title_en,
                faculty_id,
            },
            success: (data) => {
                let statusNew =
                    data.status == 1
                        ? "ACTIVE"
                        : data.status == 2
                        ? "PENDING"
                        : "INACTIVE";

                $(`.subject-body tr[data-id=${data.id}]`)
                    .find("td:nth-child(2)")
                    .html(data.title);
                $(`.subject-body tr[data-id=${data.id}]`)
                    .find("td:nth-child(3)")
                    .html(data.title_en);
                $(`.subject-body tr[data-id=${data.id}]`)
                    .find("td:nth-child(4)")
                    .html(data.subject_code);
                $(`.subject-body tr[data-id=${data.id}]`)
                    .find("td:nth-child(5)")
                    .html(data.faculty.title);
                $(`tr[data-id=${data.id}]`)
                    .find("td:nth-child(9)")
                    .html(
                        ` <div class="badge badge-warning">${statusNew} </div>`
                    );
                $(".btn-out-modal").click();

                Swal.fire(
                    `Update subject successfully`,
                    "You clicked the button!",
                    "success"
                );
            },
            error: ({ responseJSON }) => {
                let msg = "";
                for (let i in responseJSON.error) {
                    responseJSON.error[i].map((e) => {
                        msg += `${e} \n`;
                    });
                }
                Swal.fire(msg, "You clicked the button!", "error");
            },
        });
    });
}

function deleteSubject() {
    $(".btn-subject-delete").on("click", function () {
        let id = $(this).data("id");
        Swal.fire({
            title: `Bạn có chắc chắn xóa không?`,
            text: `You won't be able to revert!`,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: `/api/v1/subject/delete`,
                    type: "DELETE",
                    data: { id },
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $(".subject-body")
                                .find(`tr[data-id=${id}]`)
                                .remove();
                        }
                    },
                });
            }
        });
    });
}

function assign() {
    $(".btn-subject-assign").unbind("click").on("click", function () {
        let id = $(this).data("id");
        let subject_id = $(this).data("subject");
        $.ajax({
            url: `/api/v1/assign/list?id=${id}&subject_id=${subject_id}`,
            method: "GET",
            success: ({ data }) => {
                $(".assigns").html("");
                if(data.length == 0){
                    $(".assigns").append(`<li class="list-group-item"> No data </li>`)
                    return;
                }
                data.map(e=>{
                    $(".assigns").append(`<li class="list-group-item">${e.name} &emsp;<button class="btn btn-danger btn-assign" data-id="${e.id}" data-subject="${subject_id}"> <i class="fas fa-plus"></i> </button> </li>`)
                })
                $(".btn-assign").unbind("click").on("click",function(){
                    let user_id = $(this).data("id");
                    let outline_assign_id = $(this).data("subject");
                    $.ajax({
                        url: `/api/v1/assign/add`,
                        method: "POST",
                        data: { user_id , outline_assign_id },
                        success: ({data})=>{
                            $(".btn-out-modal").click();
                            $(`tr[data-id=${data.id}]`)
                            .find("td:nth-child(8)")
                            .html(` <button type="button" class="btn btn-green">
                            <i class="fas fa-abacus"></i> &nbsp;  ${data.list_completed.length}/${data.list_assignment.length} (${data.list_completed.length == 0 ? 0 : (data.list_completed.length/data.list_assignment.length) * 100}%) </button>`);
                        }
                    })
                })
            },
        });
        
    });
}

function unAssign() {
    $(".btn-subject-views").unbind("click").on("click", function () {
        let subject_id = $(this).data("subject");
        $.ajax({
            url: `/api/v1/assign/list/to?subject_id=${subject_id}`,
            method: "GET",
            success: ({ data }) => {
                $(".views").html("");
                if(data.length == 0){
                    $(".views").append(`<li class="list-group-item"> No data </li>`)
                    return;
                }
                data.map(e=>{
                    $(".views").append(`<li class="list-group-item">${e.name} &emsp;<button class="btn btn-danger btn-unassign" data-id="${e.id}" data-subject="${subject_id}"> <i class="fas fa-user-minus"></i> </button> </li>`)
                })
                $(".btn-unassign").unbind("click").on("click",function(){
                    let id = $(this).data("id");
                    let subject_id = $(this).data("subject");
                    $.ajax({
                        url: `/api/v1/assign/remove`,
                        method: "POST",
                        data: { id , subject_id },
                        success: ({data})=>{
                            $(".btn-out-modal").click();
                            $(`tr[data-id=${data.id}]`)
                            .find("td:nth-child(8)")
                            .html(` <button type="button" class="btn btn-green">
                            <i class="fas fa-abacus"></i> &nbsp;  ${data.list_completed.length}/${data.list_assignment.length} (${data.list_completed.length == 0 ? 0 : (data.list_completed.length/data.list_assignment.length) * 100}%) </button>`);
                        }
                    })
                })
            },
        });
        
    });
}

$(document).ready(function () {
    createSubject();
    editSubject();
    deleteSubject();
    assign();
    unAssign();
});
