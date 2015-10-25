<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 10/24/15
 * Time: 23:03
 */?>

<html>
<head>
    <title>Upload video</title>
    <script type='text/javascript'>

        window.onload = function (){

            var video = document.getElementById('my_video');
            var thecanvas = document.getElementById('thecanvas');
            var img = document.getElementById('thumbnail_img');


            video.addEventListener('pause', function(){

                draw( video, thecanvas, img);

            }, false);

        };


        function draw( video, thecanvas, img ){

            // get the canvas context for drawing
            var context = thecanvas.getContext('2d');

            // draw the video contents into the canvas x, y, width, height
            context.drawImage( video, 0, 0, thecanvas.width, thecanvas.height);

            // get the image data from the canvas object
            var dataURL = thecanvas.toDataURL();

            // set the source of the img tag
            img.setAttribute('src', dataURL);

        }
    </script>
</head>
<body>
The Video<br />

<video id="my_video" width="640" height="360" controls>
    <source src="images/commercial.mp4" type="video/mp4" />
</video>


<br />
The Canvas<br />
<canvas id="thecanvas" width="640" height="360" style="display:block;"> </canvas>
<br />The Image<br />



<div class="foo" id="message"></div>
<img id="thumbnail_img" alt="Right click to save" /><br />

<button class="form" onclick="saveImage()">hello</button>
</body>
<!--<script type="text/javascript" src="pico-master/pico/client.js"></script>-->
<script type="text/javascript" src="includes/clarifai-basic.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    var clarifai;
    var finalClassification = "help";
    var maxConfidence = 0.0;
    var count =  21;
    var path;

    function saveImage(){
        canvas = document.getElementById('thecanvas');
       var dataURL = canvas.toDataURL("image/png");
        $.ajax({
            type: "POST",
            url: "php/upload_binary.php",
            data: {
                imgBase64: dataURL
            }
        }).done(function(o) {
	console.log(o);
            predict(o);
        });
    }

    $(document).ready(
        function(){
            clarifai = new Clarifai(
                {
                    'clientId': '1Tq4UdWv4nBSd_adCXZYuoNKld6qMqMnbpMWl2yq',
                    'clientSecret': 'LZY6U6_rbotpD-9UcyYUQpQX5OLPelbfWC8ppgRB'
                }
            );
        }
    );


    function foo(classification, confidence){
        //console.log("confidence:" + confidence + "max confidence: " + maxConfidence);
        if(confidence > maxConfidence){
            finalClassification = classification;
            maxConfidence = confidence;
            //alert(finalClassification);
        }
        if(count ==1){
	    $("#message").append($("<P>").text(finalClassification+ " "));
            count = 21;
        }
        count--;
    }


    function predict(url){
        var models = ["letter_a",
            "letter_b",
            'letter_c',
            'letter_d',
            'letter_e',
            'letter_f',
            'letter_g',
            'letter_h',
            'letter_i',
            'letter_l',
            'letter_m',
            'letter_n',
            'letter_o',
            'letter_q',
            'letter_r',
            'letter_s',
            'letter_t',
            'letter_u',
            'letter_v',
            'letter_w',
            'letter_y'];
        
        for(var i=0; i< models.length; i++)
        {

            (function(i) {
                setTimeout(function() {
                    clarifai.predict('http://montycheese.cloudapp.net/digits/images/photo.png', models[i], function(obj){
                        (function (i){
                            return foo(models[i],obj.score);
                        }(i))
                    });
                }, 1000);
            })(i);

            //replace url with our server's image location, this will only work when the code is on server
            /*clarifai.predict('http://imgur.com/dEzAAdf.jpg', models[i], function(obj){
                (function (i){
                    return foo(models[i],obj.score);
                }(i))
            });*/
        }
        //return getResult();
    }

</script>
</html>