const queryString = window.location.search;
console.log(queryString);
const urlParams = new URLSearchParams(queryString);
$(document).ready(function () {
    if (urlParams.has('ts_id')) {
        const id = urlParams.get('ts_id');
        $.ajax({
            type: "get",
            url: "../manageTeachingSupport/getTeachSupportDetails.php?ts_id=" + id,
            success: function (contribute, status, xhr) {
                console.log(contribute);
                if (contribute.file != "") {
                    $(" <div class='col-12'>" +
                        "<div class='input-group'>" +
                        "<iframe  src='" + contribute.file + "' style='width: 842px;height: 1191px;border: none;margin:auto auto;' class='frame' id='fileIFrame'></iframe>" +
                        "</div>").appendTo("#filePlace");
                    $(" <div class='col-12 textAll'>" +
                        "<p class='text'> <b>Title:</b> " + contribute.title + "</p>" +
                        "<p class='text'> <b>Description:</b> " + contribute.desc + "</p>" +
                        "<p class='text'> <b>Author:</b> " + contribute.author + "</p>" +
                        "<p class='text'> <b>Date:</b> " + contribute.datePublic + "</p>" +
                        "</div>").appendTo("#fileDetailsPlace");
                }
                console.log(package);
            },
            error: function (xhr, resp, text) {
                $('#packageDetailsMessage').fadeIn();
                $('#packageDetailsMessage').html(xhr.responseText);
            },
        });
    }
});