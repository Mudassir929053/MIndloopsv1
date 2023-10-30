$(function () {
    $('#addContributeWriter').ajaxForm({
        /* beforeSubmit: ShowRequest, */
        success: SubmitSuccesful,
        error: AjaxError
    });
});
$(function () {
    $('#addContributeIllustrator').ajaxForm({
        /* beforeSubmit: ShowRequest, */
        success: SubmitSuccesful,
        error: AjaxError
    });
});
$(function () {
    $('#addContributeComic').ajaxForm({
        /* beforeSubmit: ShowRequest, */
        success: SubmitSuccesful,
        error: AjaxError
    });
});
$(function () {
    $('#addContributeCartoon').ajaxForm({
        /* beforeSubmit: ShowRequest, */
        success: SubmitSuccesful,
        error: AjaxError
    });
});

function ShowRequest(formData, jqForm, options) {
    var queryString = $.param(formData);
    alert('BeforeSend method: \n\nAbout to submit: \n\n' + queryString);
    return true;
}

function AjaxError() {
    alert("An AJAX error occured.");
}

function SubmitSuccesful(responseText, statusText) {
    /* alert("SuccesMethod:\n\n" + responseText); */
    alert("Thank you for your contribution!");
    location.href = "manageContribute.php";
}