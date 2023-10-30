function deleteContribution(id) {
    /* bootbox.confirm("Are you sure?", function(confirmed) {
        console.log("Confirmed: "+confirmed);
    }); */
    var check = confirm("Are you sure to delete?");
    if (check) {
        $.ajax({
            url: "deleteContribute.php",
            method: 'post',
            data: { id: id },
            success: function (data) {
                window.location.replace("manageContribute.php");
            }, error: function (xhr, resp, text) {
                console.log(xhr.responseText);
            },
            complete: function () {
            }
        });
    }
    else {
        window.location.replace("manageContribute.php");
    }
}
function unpublishContribution(id) {
    /* bootbox.confirm("Are you sure?", function(confirmed) {
        console.log("Confirmed: "+confirmed);
    }); */
    console.log(id);
    var check = confirm("Are you sure to unpublish this contribution?");
    if (check) {
        $.ajax({
            url: "unpublishContribute.php",
            method: 'post',
            data: { c_id: id },
            success: function (data) {
                window.location.replace("manageContribute.php");
            }, error: function (xhr, resp, text) {
                console.log(xhr.responseText);
            },
            complete: function () {
            }
        });
    }
    else {
        window.location.replace("manageContribute.php");
    }
}
$("#publishForm").submit(function (event) {
    event.preventDefault();
    var formData = $(this).serialize();
    console.log(formData);
    $.ajax({
        type: "POST",
        url: "publishContribute.php",
        data: formData,
        dataType: "json",
        success: function (data) {
            if (data.status == 'success') {
                window.location.href = "manageContribute.php";
                //console.log(data.date);
            } else {
                console.log(data.status);
            }
        },
        error: function (xhr, resp, text) {
            console.log(xhr.responseText);
            /* $('#packageDetailsMessage').fadeIn();
            $('#packageDetailsMessage').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>'); */
        },
    });
});
function openForm(cid) {
    document.getElementById("container").style.display = "block";
    document.getElementById("container").style.visibility = "visible";
    document.getElementById("c_id").value = cid;
    /* if (n >= 8) {
        document.getElementById("container").style.height = "200vh";
    } */
    const element = document.getElementById("container");
    element.scrollIntoView();
}

function closeForm() {
    document.getElementById("container").style.display = "none";
}

$(document).ready(function () {

    $.ajax({
        type: "get",
        url: "getSubjects.php",
        success: function (output, status, xhr) {
            var result = $.parseJSON(output);
            console.log(result);
            $("#radioAJAX").html(result.output);


        },
        error: function (xhr, resp, text) {
            $('#packageDetailsMessage').fadeIn();
            $('#packageDetailsMessage').html(xhr.responseText);
        },
    });

    $('#part').change(function () {
        selected = $(this).find('option:selected').attr('value');
        if (selected == "tips") {
            $("#mindBoosterMore").hide();
            $("#tipsMore").show();

            $(".form-popup").css("height", "450px");

        } else if (selected == "mindbooster") {
            $("#mindBoosterMore").show();
            $("#tipsMore").hide();
            $(".form-popup").css("height", "600px");
        }
    });

    $('#tip_part').change(function () {
        selected = $(this).find('option:selected').attr('value');
        if (selected == "Student") {
            $("#tipsCategoryRadio").show();
            radioLabel = "<label class='radio-container m-r-70'>Living Skills<input type='radio' checked='checked' name='tipCategory' value='Living Skill'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Study Smart<input type='radio' name='tipCategory' value='Study Smart'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Citizenship<input type='radio' name='tipCategory' value='Citizenship'><span class='checkmark'></span></label>";

        } else if (selected == "Parent") {
            $("#tipsCategoryRadio").show();
            radioLabel = "<label class='radio-container m-r-70'>Children<input type='radio' checked='checked' name='tipCategory' value='Children'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Teens<input type='radio' name='tipCategory' value='Teens'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Tutoring<input type='radio' name='tipCategory' value='Tutoring'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Bonding<input type='radio' name='tipCategory' value='Bonding'><span class='checkmark'></span></label>";

        } else if (selected == "Teacher") {
            $("#tipsCategoryRadio").show();
            radioLabel = "<label class='radio-container m-r-70'>Counceling<input type='radio' checked='checked' name='tipCategory' value='Counceling'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Classroom Management<input type='radio' name='tipCategory' value='Classroom Management'><span class='checkmark'></span></label>";
            radioLabel += "<label class='radio-container m-r-70'>Co-curriculum<input type='radio' name='tipCategory' value='Co-curriculum'><span class='checkmark'></span></label>";

        }
        $(".form-popup").css("height", "550px");
        $("#radioAJAXTips").html(radioLabel);
    });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });
    $('#contributeTable').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,

        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE
            /* dataSrc: "", */

            error: function (data) {
                $("#contributeTable_processing").css("display", "none");
                /* console.log(data); */
            }
        },
    });
    $('#contributeTableWriter').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?category=writer', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            /* success: function (data) {
                console.log(data);
            }, */
            error: function () {
                $("#contributeTableWriter_processing").css("display", "none");
            }
        }
    });
    $('#contributeTableIllustrator').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?category=illustrator', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            error: function () {
                $("#contributeTableIllustrator_processing").css("display", "none");
            }
        }
    });
    $('#contributeTableCartoon').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?category=cartoon', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            /* success: function (data) {
                console.log(data);
            }, */
            error: function () {
                $("#contributeTableCartoon_processing").css("display", "none");
            }
        }
    });
    $('#contributeTableComic').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?category=comic', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            /* success: function (data) {
                console.log(data);
            }, */
            error: function () {
                $("#contributeTableComic_processing").css("display", "none");
            }
        }
    });
    $('#contributeTablePublished').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?publishStatus=published', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            /* success: function (data) {
                console.log(data);
            }, */
            error: function () {
                $("#contributeTablePublished_processing").css("display", "none");
            }
        }
    });
    $('#contributeTableUnpublish').DataTable({
        "bProcessing": true,
        "serverSide": true,
        "scrollX": true,
        'columns': [
            { "width": "2%" }, { "width": "10%" }, { "width": "15%" }, { "width": "10%" }, { "width": "10%" }, { "width": "10%" },
            { 'visible': false },
            { "width": "10%" }, { 'visible': false },
            { "width": "12%" }, { "width": "8%" },
        ],
        "ajax": {
            url: 'getContribute.php?publishStatus=unpublish', // json datasource
            type: "post",  // type of method  ,GET/POST/DELETE

            /* success: function (data) {
                console.log(data);
            }, */
            error: function () {
                $("#contributeTableUnpublish_processing").css("display", "none");
            }
        }
    });
});