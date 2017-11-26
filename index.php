<html>
    <head>
        <script src="lib/jquery-3.2.1.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="lib/croppie.css" />
        <link type="text/css" rel="stylesheet" href="lib/materialize/css/materialize.min.css" media="screen,projection"/>
        <script src="lib/croppie.js"></script>
        <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form id="uploadImage" class="col s12" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="file-field input-field col s5">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" name="fileInput" id="fileInput" required />
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                        <div class="input-field col s5">
                            <input type="email" name="email" id="emailInput" required />
                            <label for="email">Email Address</label>
                        </div>
                        <input type="submit" value="Upload" class="input-field submit btn col s2" />
                </div>
            </form>

            <div class="row">
                <button onclick="rotateImage(90);" type="button" class="btn">Rotate</button>
            </div>

            <div class="row">
                <img id="imagePreview" class="" src="img/noimage.png"/>
            </div>

            <div id="response"></div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div id="modal-img-content" class="modal-content">
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">X</a>
            </div>
        </div>

        <script type="text/javascript" src="script.js"></script>
    </body>
</html>