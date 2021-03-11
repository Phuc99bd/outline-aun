function historyUser() {
    $(".btn-user-history").on("click", function () {
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/outline/history`,
            type: "GET",
            data: { id },
            success: ({ data }) => {
                $(".tbl-history").html("");
                if (data.length > 0) {
                    data.map(e => {
                        $(".tbl-history").append(`<tr><td class="text-center text-muted">#${e.id}</td>
                        <td>
                            ${e.title}
                        </td>
                        <td>
                            ${e.version}
                        </td>
                        <td class="text-center">
                        <a
                        class="btn btn-primary btn-sm btn-outline-preview"
                       href="/outline/exportPdf?id=${e.id}">Export word</a>
                            
                        </td></tr>`)
                    })
                } else {
                    $(".tbl-history").append(`<tr> <td class='text-center' colspan='4'>No data </td> </tr>`)
                }
            }
        })
    })
    const loading = () => $(".btn-import-user").unbind('change').on("change", function () {
        let fileData = $(this).prop("files")[0];

        let data = new FormData();
        data.append("file", fileData);
        $('.btn-show-import').html(`<input type="file" class="btn-import-user" />
        Waiting...`)
        $.ajax({
            url: `/api/v1/user-api/import`,
            type: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: ({ data }) => {
                $('.btn-show-import').html(`<input type="file" class="btn-import-user" />
                Import user`)
                loading();
                Swal.fire(
                    'Import user successfully.',
                    'You clicked the button!',
                    'success'
                )
            },
            error: (err) => {
                Swal.fire(
                    'Import user error.',
                    'You clicked the button!',
                    'error'
                )
                $('.btn-show-import').html(`<input type="file" class="btn-import-user" />
                Import user`)
                loading();
            }
        })
    })
    loading();
}

$(document).ready(function () {
    historyUser();
})

