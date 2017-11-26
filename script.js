var croppieImage = $('#imagePreview').croppie({
    viewport: {
        width: 300,
        height: 150
    },
    boundary: {
        width: 800,
        height: 800
    },
    showZoomer: true,
    enableResize: true,
    enableOrientation: true
});

$(document).ready(function (e) {
    $('.modal').modal();

    $(function () {
        $("#fileInput").change(function () {
            var file = this.files[0];
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((file.type === match[0]) || (file.type === match[1]) || (file.type === match[2]))) {
                $('#imagePreview').attr('src', 'noimage.png');
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = loadImagePreview;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

    function loadImagePreview(e) {
        croppieImage.croppie('bind', {
            url: e.target.result
        });
    }

    $("#uploadImage").on('submit',(function(e) {
        e.preventDefault();

        croppieImage.croppie('result', {type: 'blob', size: 'viewport'}).then(function (imgBlob) {
            var formData = new FormData();
            formData.append('file', imgBlob);
            formData.append('email', $('#emailInput').val());

            $.ajax({
                url: "sendImage_ajax.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                success: function(data) {
                    console.log(data);
                    $('#modal-img-content').html(data);
                    $('#modal1').modal('open');
                }
            });
        });
    }));
});

function rotateImage(deg) {
    croppieImage.croppie('rotate', deg);
}