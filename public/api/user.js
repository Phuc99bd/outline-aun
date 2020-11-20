function historyUser(){
    $(".btn-user-history").on("click",function(){
        let id = $(this).data("id");
        $.ajax({
            url: `/api/v1/outline/history`,
            type: "GET",
            data: { id },
            success: ({data})=>{
                $(".tbl-history").html("");
                data.map(e=>{
                    $(".tbl-history").append(`<td class="text-center text-muted">#${e.id}</td>
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
                        
                    </td>`)
                })
                console.log(data);
            }
        })
    })
}

$(document).ready(function(){
    historyUser();
})

