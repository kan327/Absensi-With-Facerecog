<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture Photo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Capture Photo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div>
                <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
            </div>
            <div id="results" class="d-none"></div>
            <form method="post" id="photoForm">
                <input type="hidden" id="photoStore" name="photoStore" value="">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-warning mx-auto text-white" id="takephoto">Capture Photo</button>
            <button type="button" class="btn btn-warning mx-auto text-white d-none" id="retakephoto">Retake</button>
            <button type="submit" class="btn btn-warning mx-auto text-white d-none" id="uploadphoto" form="photoForm">Upload</button>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script src="./plugin/sweetalert/sweetalert.min.js"></script>
    <script src="./plugin/webcamjs/webcam.min.js"></script>
    <script>
        $(document).ready(function() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
        
            Webcam.reset();
            Webcam.on('error', function() {
                $('#photoModal').modal('hide');
                swal({
                    title: 'Warning',
                    text: 'Please give permission to access your webcam',
                    icon: 'warning'
                });
            });
            Webcam.attach('#my_camera');
            // $('#accesscamera').on('load', function() {
            // });
        
            $('#takephoto').on('click', take_snapshot);
        
            $('#retakephoto').on('click', function() {
                $('#my_camera').addClass('d-block');
                $('#my_camera').removeClass('d-none');
        
                $('#results').addClass('d-none');
        
                $('#takephoto').addClass('d-block');
                $('#takephoto').removeClass('d-none');
        
                $('#retakephoto').addClass('d-none');
                $('#retakephoto').removeClass('d-block');
        
                $('#uploadphoto').addClass('d-none');
                $('#uploadphoto').removeClass('d-block');
            });
        
            $('#photoForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'photoUpload.php',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data == 'success') {
                            Webcam.reset();
        
                            $('#my_camera').addClass('d-block');
                            $('#my_camera').removeClass('d-none');
        
                            $('#results').addClass('d-none');
        
                            $('#takephoto').addClass('d-block');
                            $('#takephoto').removeClass('d-none');
        
                            $('#retakephoto').addClass('d-none');
                            $('#retakephoto').removeClass('d-block');
        
                            $('#uploadphoto').addClass('d-none');
                            $('#uploadphoto').removeClass('d-block');
        
                            $('#photoModal').modal('hide');
        
                            swal({
                                title: 'Success',
                                text: 'Photo uploaded successfully',
                                icon: 'success',
                                buttons: false,
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                                timer: 2000
                            })
                        }
                        else {
                            swal({
                                title: 'Error',
                                text: 'Something went wrong',
                                icon: 'error'
                            })
                        }
                    }
                })
            })
        })
        
        function take_snapshot()
        {
            //take snapshot and get image data
            Webcam.snap(function(data_uri) {
                //display result image
                $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');
        
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                $('#photoStore').val(raw_image_data);
            });
        
            $('#my_camera').removeClass('d-block');
            $('#my_camera').addClass('d-none');
        
            $('#results').removeClass('d-none');
        
            $('#takephoto').removeClass('d-block');
            $('#takephoto').addClass('d-none');
        
            $('#retakephoto').removeClass('d-none');
            $('#retakephoto').addClass('d-block');
        
            $('#uploadphoto').removeClass('d-none');
            $('#uploadphoto').addClass('d-block');
        }
    </script>
</body>
</html>