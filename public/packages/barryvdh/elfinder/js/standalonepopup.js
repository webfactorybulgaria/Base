$(document).on('click','.popup_selector',function (event) {
    event.preventDefault();
    var updateID = $(this).attr('data-inputid'); // Btn id clicked
    var elfinderUrl = '/elfinder/popup/';

    // trigger the reveal modal with elfinder inside
    var triggerUrl = elfinderUrl + updateID;
    $.colorbox({
        href: triggerUrl,
        fastIframe: true,
        iframe: true,
        width: '70%',
        height: '50%'
    });

});
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {
    $('#' + requestingField).val(filePath);
    var that = $('#' + requestingField);
    var img = that.closest('.fieldset-field').prev().find('img');

    if(img.length) img.width(150).attr('src', '/' + that.val());
    else that.closest('.fieldset-field').prev().html('<img width="150" src="/'+that.val()+'" alt="">');
}
