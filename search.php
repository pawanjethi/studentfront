<?php
?>
<?php include 'inc/head.php'?>
<style>
	.searchHome{
		 position: absolute;
		 margin: auto;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
	}
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
	.search-cam-btn1 {
    position: absolute;
    right: 21%;
    transform: translate(0, 35%);
}
</style>
<div class="page-load-animation pt-0" style="right: 0px; height: 70vh;">
	<div class="white-layer white-layer-with-overlay bg-white pt-0">
				<div class="container searchHome">
					<div class="row">
						<div class="col-12 searchHeading">
							<h2>Doubt? Ask Us!</h2>
						</div>
						<form method="post" action="search-result.php" onsubmit="return validateSearch()" class="searchMain">
                            <ul class="searchList">
                            	<li>
                            		<div class="form-group searchList-li">
	                                <input type="search" value="" id="headerSearch" name="searchvalue" class="form-control pr-5" placeholder="Search contents...">
	                                <button value="Search" id="headerSearchBtn" name="search_button" type="submit" class="btn-wrap take-test-btn searchBTN">Search</button>
	                                <label class="mb-0 mr-1 search-cam-btn1" for="uploadImg"><i class="fa fa-camera imgAdd" style="line-height: 22px; height: 22px; width: 22px !important;"></i></label>
	                            	</div>
                            	</li>
                            </ul>

                        </form>
                    </div>
                </div>
    </div>
</div>
<!--div class="page-load-animation">
						<form method="POST" action="#" onsubmit="return validateSearch()">
								<div class="row"  style="width:70%; margin:auto;">
									<div class="col-sm-10 form-group">
										<input type="search" value="" id="" name="SearchMain" class="form-control pr-5" placeholder="Search contents...">
										<label class="mb-0 mr-1 search-cam-btn" for="uploadImg"><i class="fa fa-camera imgAdd" style="line-height: 22px; height: 22px; width: 22px !important;"></i></label>
									</div>
									<div class="col-sm-2">
	                                	<button value="1" id="SearchBtnMain" name="SearchBtnMain" type="submit">Search</button>
	                            	</div>
                            	</div>
                        </form>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
		<div class="row google-logo text-center">
		<img src="http://douxtech.com/google.png" alt="logo">	
			
		</div>
		<div class="row google-form text-center">
			<form action="#" method="get">
				<div class="form-group">

      <input type="text" class="form-control google-search" name="q">
      <div class="btn-group">
  <button type="submit" class="btn btn-default">Google Search</button>
  <a type="button" href="#" class="btn btn-default">I'm Feeling Lucky</a>
  
</div>
    </div>
			</form>
			
		</div>
		
		
	</div>
	</div>
</div-->
<?php
?>
<?php include 'inc/footer.php'?>