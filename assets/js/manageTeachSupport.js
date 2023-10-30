function deleteTeachSupport(id) {
    /* bootbox.confirm("Are you sure?", function(confirmed) {
        console.log("Confirmed: "+confirmed);
    }); */
    var check = confirm("Are you sure to delete?");
    if (check) {
        $.ajax({
            url: "deleteTeachSupport.php",
            method: 'post',
            data: { id: id },
            success: function (data) {
                window.location.replace("manageTeachSupport.php");
            }, error: function (xhr, resp, text) {
                console.log(xhr.responseText);
            },
            complete: function () {
            }
        });
    }
    else {
        window.location.replace("manageTeachSupport.php");
    }
}
$(document).ready(function () {
    /* 
        $.ajax({
            type: "get",
            url: "getTeachSupportTypes.php",
            success: function (output, status, xhr) {
                var result = $.parseJSON(output);
                console.log(result);
                $("#tabList").append(result.output);
                /* $("#teachSupportTabTable").append(result.table);
                console.log($("#teachSupportTabTable").html); 
    
            },
            error: function (xhr, resp, text) {
                $('#packageDetailsMessage').fadeIn();
                $('#packageDetailsMessage').html(xhr.responseText);
            },
        }); */

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });
    $('#teachSupportTable').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,

        'columns': [
            { "width": "5%" }, { "width": "10%" }, { "width": "25%" }, { "width": "20%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" },
        ],
        "ajax": {
            url: 'getTeachSupport.php', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            /* dataSrc: "", */
            error: function (data) {
                $("#teachSupportTable_processing").css("display", "none");
                /* console.log(data); */
            }
        },
    });
    $('#teachSupportTablePedagogy').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,

        'columns': [
            { "width": "5%" }, { "width": "10%" }, { "width": "25%" }, { "width": "20%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" },
        ],
        "ajax": {
            url: 'getTeachSupport.php?category=pedagogy', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            /* dataSrc: "", */
            complete: function (data) {
                console.log(data);
            },
            error: function (data) {
                $("#teachSupportTablePedagogy_processing").css("display", "none");
                console.log(data);
            }
        },
    });
    $('#teachSupportTableCurriculum').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,

        'columns': [
            { "width": "5%" }, { "width": "10%" }, { "width": "25%" }, { "width": "20%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" },
        ],
        "ajax": {
            url: 'getTeachSupport.php?category=curriculum', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            /* dataSrc: "", */
            complete: function (data) {
                console.log(data);
            },
            error: function (data) {
                $("#teachSupportTableCurriculum_processing").css("display", "none");
                /* console.log(data); */
            }
        },
    });
    $('#teachSupportTableAssessment').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,

        'columns': [
            { "width": "5%" }, { "width": "10%" }, { "width": "25%" }, { "width": "20%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" },
        ],
        "ajax": {
            url: 'getTeachSupport.php?category=assessment', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            /* dataSrc: "", */
            error: function (data) {
                $("#teachSupportTableAssessment_processing").css("display", "none");
                /* console.log(data); */
            }
        },
    });
});