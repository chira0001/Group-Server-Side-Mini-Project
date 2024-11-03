<!DOCTYPE html>
<html lang="en">

<head>
    <title>Image Gallery</title>
    <link rel="stylesheet" href="">
    <script src="jquery-3.7.1.min.js"></script>
    <script src="bootstrap.js"></script>
    <script src="masonry.pkgd.min.js"></script>
    <link rel="stylesheet" href="gallery_css.css">
    <style>
        .chi_body_container {
            font-family: calibri;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: darkgray;
        }

        .item {
            margin: 2px 2px;
            transition: .5s;
            z-index: 1;
            border-radius: 5px;
            /* border: 1px solid red; */
        }

        .item:hover {
            transform: scale(1.1);
            /* transform: scaleX(50%); */
            z-index: 2;
            box-shadow: 0px 0px 15px black;
            /* border: 10px solid white; */
        }

        .gallery_container {
            width: 100%;
        }

        #masonry {
            display: flex;
            justify-content: content;
            width: 85%;
            /* border: 1px solid red; */
            /* margin: 50px; */
        }

        .search_bar_div {
            width: 100%;
        }

        #searchresult {
            display: flex;
            align-items: center;
            justify-content: center;
            /* border: 1px solid black; */
            width: 100%;
            padding-block: 20px;
        }
        #searchresult table {
            width: 80%;
        }
        #searchresult table th {
            text-align: center;
            padding: 10px;
        }
        #searchresult table td {
            text-align: center;
            padding: 5px;
        }
    </style>
</head>

<body>



<div class="chi_body_container"></div>
    <div class="search_bar_div">
        <input type="text" class="search_text_box form-control" name="search_text" placeholder="Search..." id="live_search">
        <button><a href="../home.php">Home</a></button>
    </div>
    <div id="searchresult">

    </div>
    <div class="gallery_container">
        <?php
        $fo = opendir("Images");
        echo "<div id = 'masonry'>";
        while ($file = readdir($fo)) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array("jpg", "png", "jpeg"))) {
                list($width, $height) = getimagesize("Images/" . $file);
                $new_height = ($height / $width) * 200;
                $new_height = $new_height . "px";
                echo "<div class='img_container'>";
                echo "<img style='height:$new_height' class='item img-thumbnail' src='Images/$file'>";
                echo "</div>";
            }
        }
        echo "</div>";
        ?>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var input = $(this).val();
                // alert(input);
                if (input != "") {
                    $.ajax({
                        url: "livesearch.php",
                        method: "POST",
                        data: { input: input },

                        success: function (data) {
                            $("#searchresult").html(data);
                        }
                    });
                } else {
                    $("#searchresult").css("display", "none");
                    <?php
                    header("masonry.php", 0)
                        ?>
                }
            });
        });
    </script>

    <script>
        // mason();
        window.onload = function (ev) {
            mason();
        }
        function mason() {
            var container = document.querySelector("#masonry");
            var masonry = new Masonry(container, { columnWidth: 10, itemSelector: '.item' });
        }
    </script>
</body>

</html>