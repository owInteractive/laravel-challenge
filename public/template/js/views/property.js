$(function() {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 300;
});
$('[data-mask]').inputmask();
$('#cpf_cnpj').inputmask({
    mask: [
        '999.999.999-99',
        '99.999.999/9999-99',
    ],
    keepStatic: true,
});

$('.optgroup').multiSelect({
    selectableHeader: '<div class=\'text-center bg-dark text-white\'>' + textSelect + '</div>',
    selectionHeader: '<div class=\'text-center bg-dark text-white\'>' + textSelected + '</div>',
});


$(document).ready(function() {
    $('.mask-money').maskMoney({thousands: '.', decimal: ','});
});

$('.mask-money').maskMoney({thousands: '.', decimal: ','});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('button-image').addEventListener('click', (event) => {
        event.preventDefault();
        window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
    });
});

function fmSetLink ($url)
{
    document.getElementById('image_label').value = $url;
    document.getElementById('button-image').src = $url;
}

//dropzone
let uploadedDocumentMap = {};
Dropzone.options.documentDropzone = {
    url: urlDropzone,
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    params: {'uuid': propertyUuid},
    dictDefaultMessage: textDropzoneUpload,
    headers: {
        'X-CSRF-TOKEN': token,
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="images[' + response.name + '][path]" value="' + response.path + '">');
        $('form').append('<input type="hidden" name="images[' + response.name + '][size]" value="' + response.size + '">');
        $('form').append('<input type="hidden" name="images[' + response.name + '][extension]" value="' + response.extension + '">');
        uploadedDocumentMap[file.path] = response.path;
    },
    removedfile: function(file) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token,
            },
            url: urlDestroyDropzone,
            type: 'post',
            data: {name: file.name, path: file.path, uuid: propertyUuid},
            dataType: 'json',
            success: function(json) {
                file.previewElement.remove();
                $('form').find('input[name="images[]"][value="' + json.path + '"]').remove();
            },
        });
    },
    init: function() {
        if (propertyImages.length) {
            for (let i in propertyImages) {
                let file = {
                    name: propertyImages[i].title,
                    size: propertyImages[i].size,
                    type: propertyImages[i].extension,
                    path: propertyImages[i].path,
                    property_id: propertyImages[i].property_id,
                };
                this.options.addedfile.call(this, file);
                this.options.thumbnail.call(this, file, propertyImages[i].path);
                file.previewElement.classList.add('dz-complete');
                $('form').append('<input type="hidden" name="images[]" value="' + propertyImages[i].path + '">');
            }
        }
    },
};
