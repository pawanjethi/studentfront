<?php

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
//echo $searchResponse;
$searchResult = json_decode($searchResponse, true);

function searchPrintTxt($searchResult){
	$i=0;
	foreach($searchResult['question']['QuestionList'] as $QuestionList) {
	//$QuestionList = $searchResult['question']['QuestionList'][0];
	$TextData   = $QuestionList['TextData'];
		echo '<hr>';
		//echo '<p><-b>Question</b>' .$TextData.'</p>';
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
			}//if($i>3) break;
		}//if($i>3) break; */
		/*foreach($QuestionList['AnswerChoice'] as $content) {
			$IsCorrectAnswer = $content['IsCorrectAnswer'];
			$AnswerChoiceTextData   = $content['AnswerChoiceTextData'];
			echo '<p><b>Answer</b>' .$AnswerChoiceTextData.'</p>';
			//if($IsCorrectAnswer == "Y"){
			//	echo '<p><b>Answer</b>' .$AnswerChoiceTextData.'</p>';
			//}
		} */
	}
}
// searchPrintTxt($searchResult);

function searchPrintVid($searchResult){
	$i=0;
	foreach($searchResult['script'] as $content) {
		$Type   = $content['Type'];
		//if($Type == "mpg" || $Type == "simulation"){
			$Name   = $content['Name'];
			$vidURL   = $content['Original_url'];
			$ThumbnailImageUrl   = $content['ThumbnailImageUrl'];
			
			echo '<div class="col-lg-3 col-md-12 mb-4">
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
		//}if($i>7) break;
	}
}
// searchPrintVid($searchResult);

?>