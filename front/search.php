<?php
if (isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])) {
    
$searchterm = $_POST['searchvalue'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://15.207.176.8/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('file' => $searchterm),
));

$searchResponse = curl_exec($curl);

curl_close($curl);
$searchResult = json_decode($searchResponse, true);

function searchPrintTxt($searchResult){
	$i=0;
	foreach($searchResult['question']['QuestionList'] as $QuestionList) {
	$TextData   = $QuestionList['TextData'];
		echo '<hr>';
		echo $TextData;
		echo '<p><b>Answer</b>:</p>';

		foreach($QuestionList['AnswerChoice'] as $content) {
			$IsCorrectAnswer   = $content['IsCorrectAnswer'];
			if($IsCorrectAnswer == "Y"){
				$AnswerChoiceTextData   = $content['AnswerChoiceTextData'];
				$AnswerChoiceExplanationData   = $content['AnswerChoiceExplanationData'];
				echo  $AnswerChoiceTextData;
				echo '<p><b>Explanation</b>' .$AnswerChoiceExplanationData.'</p>';
				$i++;
			}
		}
	}
}

function searchPrintVid($searchResult){
	$i=0;
	foreach($searchResult['script'] as $content) {
		$Type   = $content['Type'];
			$Name   = $content['Name'];
			$vidURL   = $content['Original_url'];
			$ThumbnailImageUrl   = $content['ThumbnailImageUrl'];
			
			echo '<div class="col-lg-3 mb-4">
					    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					      <div class="modal-dialog modal-lg" role="document">
					        <div class="modal-content">
					          <div class="modal-body mb-0 p-0">
					            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">';
			echo '<iframe class="embed-responsive-item" src="'.$vidURL.'"
					                allowfullscreen></iframe>
					            </div>
					          </div>
					          <div class="modal-footer justify-content-center">
					            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>
					          </div>
					        </div>
					      </div>
					    </div>';
			echo '<a><img class="img-fluid z-depth-1" src="'.$ThumbnailImageUrl.'" alt="video"
					        data-toggle="modal" data-target="#modal1">';
			echo '<p>'.$Name.'</p></a>

					  </div>';
			$i++;
	}
}

}
?>

<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Search</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style/style.css">
    <style>
        .bg-red-img{
            background-image: url('https://res.cloudinary.com/dtsebzfdk/image/upload/v1601407192/Shape_51_copy_1_nbjc7z.png'), -webkit-linear-gradient(90deg, rgb(157, 96, 255) 0%, rgb(68, 29, 173) 100%) !important;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .bg-red-img h1{
            font-family: Poppins-SemiBold;
            font-size: calc(40px + (80 - 40) * ((100vw - 320px) / (1600 - 320))) !important;
        }

        .bg-red-img {
            height: calc(550px + (620 - 550) * ((100vw - 320px) / (1600 - 320)));
        }

        .no-one-und {
            margin-top: 104px;
        }
        .card-learing h5{
            color: #393939 !important;
            font-family: Poppins-Regular;
            font-size: calc(14px + (18 - 14) * ((100vw - 320px) / (1600 - 320))) !important;
            font-weight: 400;
            margin-bottom: 0;
        }
        .card-learing h5 span{
            color: #b1b1b1;
            font-family: Poppins-Italic;
        }
        .obama{
            border-radius: 15px;
            background-color: #eff3f5;
            padding-top:25px  !important;
            padding-bottom:25px  !important;
            margin-bottom: calc(25px + (50 - 25) * ((100vw - 320px) / (1600 - 320)));
        }

        .learning .card-1 .card-learing{
            padding:calc(30px + (50 - 30) * ((100vw - 320px) / (1600 - 320))) calc(27px + (69 - 27) * ((100vw - 320px) / (1600 - 320)))
        }
        .learning h2{
            font-size: calc(30px + (36 - 30) * ((100vw - 320px) / (1600 - 320)));
        }

        .card-learing ul{
            margin-left: calc(20px + (50 - 20) * ((100vw - 320px) / (1600 - 320)));
            margin-bottom:calc(30px + (40 - 30) * ((100vw - 320px) / (1600 - 320)));
        }

        .card-learing li{
            color: #393939;
            font-family: Poppins-Regular;
            font-size: calc(15px + (17 - 15) * ((100vw - 320px) / (1600 - 320))) !important;
            font-weight: 400;
            line-height: 30px;
            
        }

        .card-learing .coding-li{
            line-height: 30px;
        }

        .card-learing h4{
            color: #393939;
            font-family:Poppins-SemiBold;
            font-size: calc(15px + (18 - 15) * ((100vw - 320px) / (1600 - 320))) !important;
            font-weight: 400;
            line-height: 30px;
        }

        .coming-soon h1{
            color: #e21f29;
            font-size: 40px;
            font-size: calc(25px + (35 - 25) * ((100vw - 320px) / (1600 - 320))) !important;
            font-weight: 700;
        }

        .world-tour{
            margin:calc(100px + (150 - 100) * ((100vw - 320px) / (1600 - 320))) auto !important ;
        }
        .select-link{
            color: #fcd529 !important;
        }



    .searchMain{
		width:80%;
		margin:auto;
	}
    .searchList{
		list-style:none;
	}
	.searchList-li{
		display:flex;
	}
	.searchList-li input{
		margin-right:10px;
	}
	button.searchBTN{
		border:#ff2020;
		font-family: Poppins-Regular;
	}

	.es-3{
		height: 30px;
	}
	.searchResult p{
		padding-right: 20px;
		padding-left: 20px;
		padding-top: 5px;
		padding-bottom: 5px;
		text-align: justify;
	}
	.searchResult p span{
		font-weight: 600;
	}
	.searchResult p.selected{
		background:#f0f0f0;
	}
	.searchResult p.solution{
		border:3px solid #212121;
		width: 90%;
		margin: auto;
		margin-bottom: 10px
	}
	.search-cam-btn1 {
    position: absolute;
    right: 23%;
    transform: translate(0, 35%);
	}
    .golden-btn{
        padding: 5px 28px !important;
    }

    </style>    
  
</head>

<body>       
    <div class="bg-red-img align-items-center">
        <div class="container-fluid ">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-12 col-12">
                    <div class="row">
                        <div class="col-12">
                            <nav class="navbar nav-menu navbar-expand-lg px-md-auto px-0">
                                <a class="my-auto  navbar-brand" href="#">
                                    <img class="img-fluid nav-icon" src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601028572/Vector_Smart_Object_jedoml.png"  alt="" loading="lazy">
                                </a>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
                                        <img class="img-fluid d-lg-none d-block" src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601324786/Layer_3_mds01x.png" alt="">
                                  </button>
                                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button> -->
                                <div class="my-auto collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav my-auto  ml-auto">
                                        <li class="my-auto mx-1 nav-item ">  <a class="nav-link" href="search.php">Doubt? Ask Us  <span class="sr-only">(current)</span></a> </li>
                                        <li class="my-auto mx-1 nav-item">   <a class="nav-link" href="live.html">Practically Live  </a> </li>
                                        <li class="my-auto mx-1 nav-item">   <a class="nav-link select-link" href="Practically++.html">Practically++  </a> </li>
                                        <li class="my-auto mx-1 nav-item">   <a class="nav-link" href="http://staging.corsalite.com/pracontent/docs/class-6th/maths/knowing-our-numbers/" target="_blank">Explore  </a> </li>
                                        <li class="my-auto mx-1 nav-item">   <a class="nav-link" href="#">Login  </a> </li>
                                        <li  class="my-auto mx-1  nav-item"> <a class="nav-link my-auto  mx-2 navbar-brand" href="#"><img src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601031674/Shape_41_adyxsj.png" width="39" height="9" alt="" loading="lazy"></a></li>
                                        <li class="nav-item btn-black"> <a class="nav-link btn golden-btn color px-4" style="box-shadow: none;" href="#contact">Are you a Teacher ?<span style="left: 72.1406px; top: 32px;"></span><span style="left: 91.1406px; top: 28px;"></span><span style="left: 130.141px; top: 16px;"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                     </div>
                     
                     <!--Why Err when start  -->
                     <div class="row   no-one-und justify-content-center">
                         <div class="col-12   text-center ">
                            <h1>Doubt? Ask Us!</h1>
                                </div>
                                <form method="POST" action="" class="searchMain">
                                    <ul class="searchList">
                                        <li>
                                            <div class="form-group searchList-li">
                                            <input type="search" value="" id="headerSearch" name="searchvalue" class="form-control pr-5" placeholder="Search contents...">
                                            <button value="1" id="headerSearchBtn" name="headerSearchBtn" type="submit" class="btn-wrap take-test-btn golden-btn color searchBTN">Search</button>
                                            <label class="mb-0 mr-1 search-cam-btn1" for="uploadImg"><i class="fa fa-camera imgAdd" style="line-height: 22px; height: 22px; width: 22px !important;"></i></label>
                                            </div>
                                        </li>
                                    </ul>

                                </form>
                         </div>
                     </div>
                     <!--Why Err when end  -->
                    
                </div>
                
            </div>
        </div>
    </div>

    
    <div class="container-fluid learning ">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-12 col-12">
              <div class="card card-1 pb-5">
                  <div class="card-body card-learing">
                    <div class="row">
                        <div class="col-12 ">
                        <?php if (isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])) {
                            echo searchPrintTxt($searchResult);
                            }
                            ?>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </div>

<div class="container mb-0 mt-5">
    <div class="row">
        <?php if (isset($_POST['searchvalue']) && !empty($_POST['searchvalue'])) {
            echo searchPrintVid($searchResult);
            }
            ?>
    </div>
</div>
</div>





<div class="container ">
    <div class="row  black-grident download-now mx-1 justify-content-center">
        <div class="col ">
            <div class="row pl-xl-4">
                <div class="col-xl-3 col-lg-2 col-12 text-lg-left text-center">
                    <a class="my-auto  navbar-brand" href="#">
                        <img class="img-fluid practically" src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601028572/Vector_Smart_Object_jedoml.png" alt="" loading="lazy">
                    </a>
                </div>
                <div class="mb-4 justify-content-center col-md-auto col my-auto">
                    <h3>Did you experience <br class="d-xl-block d-none">
                        Practically yet?</h3>
                </div>
                <div class="black-download-button justify-content-center col-xl-auto col-12  my-auto"><a class="nav-link btn golden-btn color px-md-4 px-2" style="box-shadow: none;" href="#contact">Download the App Now<span style="left: 72.1406px; top: 32px;"></span><span style="left: 91.1406px; top: 28px;"></span><span style="left: 130.141px; top: 16px;"></span></a></div>
                <div class="black-download-button justify-content-center col  my-auto">
                    <div class="row d-flex justify-content-center" >
                        <div class="col text-right my-auto"> <img class="icon img-fluid" src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601318348/2-layers_5_fhn9tn.png" alt=""> </div>
                        <div class="col my-auto"> <img class="icon img-fluid" src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601318331/2-layers_4_u3dl2r.png" alt=""> </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>

<!-- footer -->
<footer id="footer">
    <div class="footer-top">
      <div class="container  ">
        <div class="row pl-lg-5 px-3">
            <div class="col-lg-3 col-md-6 pl-lg-5 col-6 footer-links right aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                <ul>
                      <li><a href="#" data-toggle="modal" data-target="#login_view">Login</a></li>
                       <li><a href="https://www.practically.com/influencer/#">Influencer</a></li>
                               
                     <li><a href="#">Pricing</a></li>
                     <li><a href="#">Teachers</a></li>
                     <li><a href="#">About Us</a></li>
                           <li><a href="#">Blog</a></li>
                              <li><a href="#">News</a></li>
                  <li><a href="#">FAQs</a></li>
                 
                  <li><a href="#">Contact Us</a></li>
            
               
                </ul>
              </div>    
          <div class="col-lg-3 col-md-6 col-6 footer-links left aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <ul>
              <li> <a href="video.php">Videos</a></li>
              <li> <a href="simulation.php">Simulations</a></li>
              <li> <a href="ar.php">Augmented Reality</a></li>
              <li> <a href="virtualReality.php">Virtual Reality</a></li>
            </ul>
          </div>

       

          <div class="col-lg-3 col-md-6 footer-links aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
              <h4 class="help mb-0" style="color:#fff;">Need Help?</h4>
            <p class="mb-0">
              You can contact us by phone<br>
              <br>
              <div class="sales">
                  Sales &amp; Support<br> +91 79959 95554<br>

              </div>
            </p>
          </div>

          <div class="col-lg-3 text-lg-right col-md-6 footer-links aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
            <div class="social-links mt-3">
              <a href="https://twitter.com/practicallyapp" class="twitter"><i><img src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601118715/Vector_Smart_Object_3_zknsld.png"></i></a>
              <a href="https://www.facebook.com/PracticallyApp/ " class="facebook"><i><img src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601118715/Vector_Smart_Object_4_bificv.png"></i></a>
              <a href="https://www.youtube.com/channel/UCJ_GsPmSWOwJic9QC7R8pNw" class="youtube"><i><img src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601118715/Vector_Smart_Object_5_scesvg.png"></i></a>
              <a href="https://www.linkedin.com/company/practically" class="linkedin"><i><img src="https://res.cloudinary.com/dtsebzfdk/image/upload/v1601118715/Vector_Smart_Object_6_krae5x.png"></i></a>
            </div>
          </div>

        </div>

      </div>
    </div>
<!-- <div class="copy">
    <div class="container-fuild d-flex justify-content-center text-center">
          <div class="copyright row" style="width: 100%;">
              <div  class="col-md-2 col-sm-12 order-2 order-sm-2">
                  <p>
                  Practically is a product of <a href="https://www.3rdflix.com/">3rdFlix</a>.
                  </p>
              </div>
              <div class="col-md-auto col-sm-4 order-1 order-sm-4" style="padding: 0px;">
                <span><a href="#">© Copyright 2020 3RDFLIX Visual Effects Pvt. Ltd.</a></span>
            </div>
              <div class="col-md-2 col-sm-4 order-1 order-sm-4" style="padding: 0px;">
                  <span><a href="#">TERMS OF USAGE</a></span>
              </div>
              <div class="col-md-2 col-sm-4 order-1 order-sm-4" style="padding: 0px;">
                  <span><a href="#">PRIVACY POLICY</a></span>
              </div>
              <div class="col-md-2 col-sm-4 order-1 order-sm-4" style="padding: 0px;">
                  <span><a href="#">COOKIE POLICY</a></span>
              </div>
          </div>
          <div class="credits">
          </div>
    </div>
</div> -->
  <div class="copy">
      <div class=" container pl-lg-5">

      <div class="row">
          <div class="col-md-3 my-md-auto my-1 col-12">
            <p>Practically is a product of <a href="">3rdFlix</a> .</p>
          </div>
          <div class="col-md-4 col-12 my-md-auto my-1">
            <p>© Copyright 2020 3RDFLIX Visual Effects Pvt. Ltd.</p>
          </div>
          <div class="col-auto my-md-auto my-1">
            <div class="row">
                <div class="col-auto"> <p ><a href="">TERMS OF USAGE</a> </p> </div>
                <div class="col-auto"> <p> <a href="">PRIVACY POLICY</a> </p> </div>
                <div class="col-auto"> <p> <a href="">COOKIE POLICY </a> </p> </div>
            </div>
          </div>
      </div>
      </div>
    </div>

</footer>
<script>
    $(document).ready(function(){
        $("#testimonial-slider").owlCarousel({
            items:3,
            itemsDesktop:[1000,2],
            itemsDesktopSmall:[980,1],
            itemsTablet:[768,1],
            pagination:false,
            navigation:true,
            navigationText:["<img src='https://res.cloudinary.com/dtsebzfdk/image/upload/v1601229776/Shape_44_copy_jzavty.png'>","<img src='https://res.cloudinary.com/dtsebzfdk/image/upload/v1601230621/Shape_44_khtzwo.png'>"],
            autoPlay:true
        });
    });
</script>
<script>
    var TxtType = function(el, toRotate, period) {
		this.toRotate = toRotate;
		this.el = el;
		this.loopNum = 0;
		this.period = parseInt(period, 10) || 2000;
		this.txt = '';
		this.tick();
		this.isDeleting = false;
	};
	
	TxtType.prototype.tick = function() {
		var i = this.loopNum % this.toRotate.length;
		var fullTxt = this.toRotate[i];
	
		if (this.isDeleting) {
			this.txt = fullTxt.substring(0, this.txt.length - 1);
		} else {
			this.txt = fullTxt.substring(0, this.txt.length + 1);
		}
	
		this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';
	
		var that = this;
		var delta = 200 - Math.random() * 100;
	
		if (this.isDeleting) { delta /= 2; }
	
		if (!this.isDeleting && this.txt === fullTxt) {
			delta = this.period;
			this.isDeleting = true;
		} else if (this.isDeleting && this.txt === '') {
			this.isDeleting = false;
			this.loopNum++;
			delta = 500;
		}
	
		setTimeout(function() {
			that.tick();
		}, delta);
	};
	
	window.onload = function() {
		var elements = document.getElementsByClassName('typewrite');
		for (var i=0; i<elements.length; i++) {
			var toRotate = elements[i].getAttribute('data-type');
			var period = elements[i].getAttribute('data-period');
			if (toRotate) {
				new TxtType(elements[i], JSON.parse(toRotate), period);
			}
		}
		// INJECT CSS
		var css = document.createElement("style");
		css.type = "text/css";
		css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid transparent}";
		document.body.appendChild(css);
	};
    </script>

</body>

</html>