<?php include_once('searchapi.php')?>
<?php include 'inc/head.php'?>
<style>
	
	.searchHeading{
		text-align: center;
	}
	.searchHeading h2{
		font-family: Poppins-Regular;
		font-weight: 600;
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
    right: 21%;
    transform: translate(0, 35%);
}
</style>
<div class="page-load-animation pt-0" style="right: 0px;">
	<div class="white-layer white-layer-with-overlay bg-white pt-0">
				<div class="container">
					<div class="row">
						<div class="col-12 searchHeading">
							<h2>Doubt? Ask Us!</h2>
						</div>
						<form method="POST" action="" onsubmit="return validateSearch()" class="searchMain">
                            <ul class="searchList">
                            	<li>
                            		<div class="form-group searchList-li">
	                                <input type="search" value="" id="headerSearch" name="searchvalue" class="form-control pr-5" placeholder="Search contents...">
	                                <button value="1" id="headerSearchBtn" name="headerSearchBtn" type="submit" class="btn-wrap take-test-btn searchBTN">Search</button>
	                                <label class="mb-0 mr-1 search-cam-btn1" for="uploadImg"><i class="fa fa-camera imgAdd" style="line-height: 22px; height: 22px; width: 22px !important;"></i></label>
	                            	</div>
                            	</li>
                            </ul>

                        </form>
                    </div>
                </div>

                <div class="es-3"></div>

                <div class="container searchResult">
					<div class="row">
						<div class="col-sm-12">
							<p><?php echo searchPrintTxt($searchResult);?></p>
							<!--p>We have a <span>Practically Teacher</span> as one of the teacher types when approving/certifying teachers on Teach.Practically.com. We currently as part of seek help have a page where we request 
							teachers to submit their credentials for verification.</p>
							
							<p class="selected">We have a <span>Practically Teacher</span> as one of the teacher types when approving/certifying teachers on Teach.Practically.com. We currently as part of seek help have a page where we request teachers to submit their credentials for verification.</p>
							<p class="solution"><strong>Solution:</strong><br>We have a <span>Practically Teacher</span> as one of the teacher types when approving/certifying teachers on Teach.Practically.com.</p>

							<p>We have a <span>Practically Teacher</span> as one of the teacher types when approving/certifying teachers on Teach.Practically.com. We currently as part of seek help have a page where we request teachers to submit their credentials for verification.</p>
							<p>We have a <span>Practically Teacher</span> as one of the teacher types when approving/certifying teachers on Teach.Practically.com. We currently as part of seek help have a page where we request teachers to submit their credentials for verification.</p-->
						</div>
                    </div>



                    <!-- Grid row -->
					<div class="row">

					  <!-- Grid column -->
					  <?php echo searchPrintVid($searchResult);?>

					  <!--div class="col-lg-3 col-md-12 mb-4">
					    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					      <div class="modal-dialog modal-lg" role="document">
					        <div class="modal-content">
					          <div class="modal-body mb-0 p-0">

					            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
					              <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/wTcNtgA6gHs"
					                allowfullscreen></iframe>
					            </div>

					          </div>
					          <div class="modal-footer justify-content-center">

					            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

					          </div>

					        </div>

					      </div>
					    </div>

					    <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-2.jpg" alt="video"
					        data-toggle="modal" data-target="#modal1"><p>Video name as one of …</p></a>

					  </div-->
					  <!-- Grid column -->


					</div>
					<!-- Grid row -->
                </div>
                <div style="text-align: center;">
                	<button value="1" name="headerSearchBtn" type="submit" class="btn-wrap take-test-btn searchBTN">Seek Help</button>
                </div>
    </div>
</div>
<?php
?>
<?php include 'inc/footer.php'?>