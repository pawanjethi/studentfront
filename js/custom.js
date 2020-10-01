$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

function getClassData(idBatch,selectedId = "", isDefaultValueChange = 0){
	
	if(idBatch){
		
		$.ajax({
			url: baseurl+"teacherapp/batch/"+idBatch+'/0/0/1',
			type: "GET",
			success: function(data){ 
				var batchData = jQuery.parseJSON(data);
				var idCourseInstance = batchData.idCourseInstance;
				var idSubject = batchData.selidCourseSubject;
				
				if(idCourseInstance){
					$('#idCourseInstance').find('option:selected').removeAttr('selected'); 
					$('#idCourseInstance').val(idCourseInstance).change();
				}
				
				if(idSubject){
					setTimeout(function(){ 
						$('#idSubject').find('option:selected').removeAttr('selected');
						$('#idSubject').val(idSubject).change(); 
					}, 500);
					
				}	 
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	} else {
		var data = '<option value="">'+selectValDefault+'</option>';
		if(selectedId){
			$("#"+selectedId).html(data);
		} else{
			$("#idSubject").html(data);
		}
	}
}

function getSubjects(idCourseInstance, selectedId = "", isDefaultValueChange = 0){
	if(isDefaultValueChange == 1) {
		var selectValDefault  = 'Select';
	} else if(isDefaultValueChange) {
		var selectValDefault  = isDefaultValueChange;
	} else {
		var selectValDefault  = 'All';
	}

	if(idCourseInstance){
		if(selectedId == ""){
			$("#idSubject").html("");
		}
		$.ajax({
			url: baseurl+"teacherapp/getSubjectByCourseInstance",
			type: "GET",
			data : { courseInstanceId : idCourseInstance, isDefaultValueChange : isDefaultValueChange },
			success: function(data){
				if(selectedId){
					$("#"+selectedId).html(data);
				} else{
					$("#idSubject").html(data);
				}
				$(".select-control").select2({
					minimumResultsForSearch: Infinity,
					selectionTitleAttribute: false
				});
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	} else {
		var data = '<option value="">'+selectValDefault+'</option>';
		if(selectedId){
			$("#"+selectedId).html(data);
		} else{
			$("#idSubject").html(data);
		}
	}
}

function getChapters(idSubject, selectedId = ""){
	if(idSubject){
		var idCourseInstance = $("#idCourseInstance").val() ? $("#idCourseInstance").val() : $("#idCourseInstanceExam").val();
		if(selectedId == ""){
			$("#idChapter").html("");
		}
		$.ajax({
			url: baseurl+"teacherapp/getChaptersBySubject",
			type: "GET",
			data : { idSubject : idSubject, courseInstanceId: idCourseInstance },
			success: function(data){
				if(selectedId){
					$("#"+selectedId).html(data);
				} else{
					$("#idChapter").html(data);
				}
				$(".select-control").select2({
					minimumResultsForSearch: Infinity,
					selectionTitleAttribute: false
				});
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	} else {
		var data = '<option value="">Select</option>';
		if(selectedId){
			$("#"+selectedId).html(data);
		} else{
			$("#idChapter").html(data);
		}
	}
}

$((function() {
	$(".create-quizze-evt").on("click", (function() {
		 var quizLimit = configquizLimit;
		 if ( $('#quizlist > li').length >= quizLimit ) { 
			var dialog = bootbox.dialog({
				title: 'Warning',
				centerVertical: true,
				message:'You can add only ' + quizLimit + ' Quizes',
			});
			var styles = {
				  backgroundColor : "orange",
				  color: "#fff"
				};
			$('.modal-header').css(styles);
			return false;
		}
		 if(validateLMForm()){
			$(".pop-quizzes-wrap").addClass("show"),
			$(".pop-quizzes-wrap .pos-fixed-overlay").removeAttr("hidden"), 
			$(".body-overlay").addClass("active"); 
		 }
	 }));
	 $(".quizess-pop-proceed").on("click", (function() {
		 var isSubmitQuizForm = 1;
		 $.each( $('#quizform').serializeArray(), function( key, value ) {
			if(value.name != "idContentQuiz") {
				if(value.value == "" || value.value == undefined){
					var txt = $("#"+value.name).next().text();
					if(value.name == "idChapterExam"){
						txt = "Chapter";
					}else if(value.name == "Complexity"){
						txt = "Level";
					} else if(value.name == "Topic") {
						txt = "Topic";
					}
					$("#"+value.name+"Error").text(txt+" is Required");
					isSubmitQuizForm = 0;
				} else {
					$("#"+value.name+"Error").text("");
				}
			}
		});
		var ComplexityVal	=  $('#Complexity').val();
		var NoOfQuestions 	=  $('#NoOfQuestions').val();
		if(ComplexityVal != "") {
			var totalNumQuestions 	=  $('#level_Questions_'+ComplexityVal).val();		
			if(	Number(NoOfQuestions) > Number(totalNumQuestions)) {
				 $('#NoOfQuestionsError').text("Max number of questions allowed for level "+ComplexityVal+" is "+totalNumQuestions);
				 isSubmitQuizForm = 0;
			}
		}
		if(isSubmitQuizForm){ 
			var textfileds = "";
			$.each( $('#quizform').serializeArray(), function( key, value ) {
				var fieldvalue = value.value;
				if($.isNumeric(fieldvalue)){
					fieldvalue = $("#quizform #"+value.name+" option:selected").text();
					fieldvalue = fieldvalue ? fieldvalue : value.value;
				}
				$("#quizformHidden #idCourseInstanceExamText").html($("#idCourseInstance option:selected").text());
				$("#quizformHidden #idSubjectExamText").html($("#idSubject option:selected").text());
				$("#quizformHidden #idContentQuizText").html($("#idContentQuiz option:selected").text());
				$("#quizformHidden #"+value.name+"Text").html(fieldvalue);
				textfileds += "<input type='hidden' name='"+value.name+"[]' value='"+value.value+"' >";
			});
			
			$("#quizformHidden #quizformHiddenTextFields").html(textfileds);
			
			var htmldata = $("#quizformHidden").html();
			$(".myquizzes__list").map((function() {
				var e = $(this).next().html();
				$(".tasktype--pane.quizzes-pane .selected-list > ul").append("<li>"+ htmldata + '<a href="javascript:void(0);" class="sub--close"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"><path fill="#262626" d="M1.41210061,7.24341505 C1.1824964,7.24341505 1,7.05508569 1,6.82560561 C1,6.59612554 1.1824964,6.41372781 1.41210061,6.41372781 L6.41035052,6.41372781 L6.41035052,1.41780944 C6.41072145,1.18832937 6.59915268,1 6.82875689,1 C7.0583611,1 7.2408575,1.18832937 7.2408575,1.41780944 L7.2408575,6.41372781 L12.2391074,6.41372781 C12.4687116,6.41372781 12.6571429,6.59612554 12.6571429,6.82560561 C12.6571429,7.05508569 12.4687116,7.24341505 12.2391074,7.24341505 L7.2408575,7.24341505 L7.2408575,12.2393334 C7.2408575,12.4688135 7.0583611,12.6571429 6.82875689,12.6571429 C6.59915268,12.6571429 6.41072145,12.4688135 6.41072145,12.2393334 L6.41072145,7.24341505 L1.41210061,7.24341505 Z" transform="rotate(45 6.829 6.829)"/></svg></a></li>')
			}));
			
			$.each( $('#quizform').serializeArray(), function( key, value ) {
				$("#"+value.name).val("");
			});
			$(".tasktype--pane.quizzes-pane .selected-list").removeAttr("hidden"); 
			
			$(".pop-quizzes-wrap label[for='SectionName']").removeClass("active");
			$(".pop-quizzes-wrap label[for='NoOfQuestions']").removeClass("active");
			$(".pop-quizzes-wrap .select-control").val('').trigger('change');
			$(".pop-quizzes-wrap").removeClass("show"); 
			$(".pop-quizzes-wrap .pos-fixed-overlay").attr("hidden", "hidden"); 
			$(".body-overlay").removeClass("active");
		} else {
			return false;
		}
	})); 
	 $(".create-presentation-evt").on("click", (function(e) { 
			if(validateLMForm()){
				 getContentIndex('pdf',0,'presentation');				 
				 $(".pop-video-wrap").addClass("show"),
				 $(".body-overlay").addClass("active"),
				 $(".pop-video-wrap .pos-fixed-overlay").removeAttr("hidden")
			}
	 })); 
	 $(".create-reference-evt").on("click", (function(e) { 
			if(validateLMForm()){
				 getContentIndex('pdf,mpg', 0 , 'reference');
				 $(".createrefmaterial").css("display", "block"),
				 $(".pop-video-wrap").addClass("show"),
				 $(".body-overlay").addClass("active"),
				 $(".pop-video-wrap .pos-fixed-overlay").removeAttr("hidden")
			}
	 })); 
	 $(".create-videos-evt").on("click", (function(e) { 
			if(validateLMForm()){
				 getContentIndex('mpg',0,'video');
				 $(".pop-video-wrap").addClass("show"), $(".body-overlay").addClass("active"), $(".pop-video-wrap .pos-fixed-overlay").removeAttr("hidden")
			}
	 })); 
	 
	  $(".create-simulate-evt").on("click", (function(e) {			
			if(validateLMForm()){
				getContentIndex('simulation', 0 , 'simulation');
				 $(".pop-video-wrap").addClass("show"), $(".body-overlay").addClass("active"), $(".pop-video-wrap .pos-fixed-overlay").removeAttr("hidden");
			}
	 })); 
	 
	 $(".quizbackbtn").on("click", (function(e) { 
			$.each( $('#quizform').serializeArray(), function( key, value ) {
				$("#"+value.name).val("");
				$("#"+value.name+"Error").html("");
			});
			$(".pop-quizzes-wrap label[for='SectionName']").removeClass("active");
			$(".pop-quizzes-wrap label[for='NoOfQuestions']").removeClass("active");
			$(".pop-quizzes-wrap .select-control").val('').trigger('change');
	  })); 
}));

function validateLMForm(){
	var idCollegeBatch = $("#idCollegeBatch").val();
	var idCourseInstance = $("#idCourseInstance").val();
	var idSubject		 = $("#idSubject").val();
	
	var isValid = 1; 
	$("#idCollegeBatchError").html("");
	$("#idCourseInstanceError").html("");
	$("#idSubjectError").html("");
	if(idCourseInstance == "" || idCourseInstance == undefined){
		var txt = $("#idCourseInstance").next().text();
		$("#idCourseInstanceError").html(txt+" is Required");
		isValid = 0; 
	} 
	
	if(idSubject == "" || idSubject == undefined || idCourseInstance == "" || idCourseInstance == undefined || idCollegeBatch == ""){
		var dialog = bootbox.dialog({
			title: 'Warning',
			centerVertical: true,
			message:'To add content to this class first you must select class and subject.',
		});
		var styles = {
			  backgroundColor : "orange",
			  color: "#fff"
			};
		$('.modal-header').css(styles);
		 $('html, body').animate({
			scrollTop: $("#idCollegeBatch").offset().top
		}, 1000);
		var txt = $("#idSubject").next().text();
		idCollegeBatch ? $("#idCollegeBatchError").html("") : $("#idCollegeBatchError").html("Class is Required");
		idSubject ? $("#idSubjectError").html("")  : $("#idSubjectError").html("Subject is Required");
		isValid = 0; 
	}
	
	if(isValid == 1){
		return true;
	} else {
		return false;
	}
}

function getContentIndex(ContentType, isSearch = 0, section = 0){
	var currentpage = $('#currentpage').val() ? $('#currentpage').val() : ""; 
	var idCourseInstance = $("#idCourseInstance").val();
	var idSubject		 = $("#idSubject").val();
	if(isSearch == 1) {
		var contentSearch	= $("#contentSearch").val();
	} else {
		var contentSearch	= "";
	}
	var idVideoContent = "";
	var idPdfContetns = "";
	
	if(ContentType == 'mpg'){
		var idVideoContentsArr = [];
		
		$("#selectedVideoUl input[name='idVideoContents[]']").each(function() {
			var value = $(this).val();
			if (value) {
				idVideoContentsArr.push(value);
			}
		});
		if (idVideoContentsArr.length > 0) {
			idVideoContent = idVideoContentsArr;
		}
	}else if(ContentType == 'simulation'){ 
		var idSimContentsArr = [];
		$("#selectedSimUl input[name='idSimulationContents[]']").each(function() {
			var value = $(this).val();
			if (value) {
				idSimContentsArr.push(value);
			}
		});
		if (idSimContentsArr.length > 0) {
			idVideoContent = idSimContentsArr;
		}
	}else if(ContentType == 'pdf'){ 
		var idPdfArr = [];
		$("#selectedPdfContents input[name='idPdfContents[]']").each(function() {
			var value = $(this).val();
			if (value) {
				idPdfArr.push(value);
			}
		});
		if (idPdfArr.length > 0) {
			idVideoContent = idPdfArr;
		}
	}else if(ContentType == 'pdf,mpg'){
		var idReferenceContents = [];
		$("#selectedRefContents input[name='idReferenceContents[]']").each(function() {
			var value = $(this).val();
			if (value) {
				idReferenceContents.push(value);
			}
		});
		if (idReferenceContents.length > 0) {
			idVideoContent = idReferenceContents;
		}
	}
	
	if(idCourseInstance && idSubject){
		var idCollegeBatch = $("#idCollegeBatch").val();
		$.ajax({
			url: baseurl+"teacherapp/ContentIndex",
			type: "GET",
			data : { idCourseInstance : idCourseInstance, idSubject : idSubject, ContentType: ContentType,
					 isSearch : isSearch, contentSearch : contentSearch, isSelectedVideos : idVideoContent, 
					 isPdfContents : idPdfContetns , currentpage : currentpage, currentsection : section, idCollegeBatch : idCollegeBatch
				   },
			async: false, 
			success: function(data){
				if(isSearch == 1) {
					$("#contentDataDisp").html(data);
				} else {
					$("#ContentDiv").html(data);	
				}
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	}
	/* if(idCourseInstance && idSubject && (section == 'reference')){
		var idCollegeBatch = $("#idCollegeBatch").val();
		$.ajax({
			url: baseurl+"teacherapp/ReferenceMaterials",
			type: "GET",
			data : { idCourseInstance : idCourseInstance, idSubject : idSubject, ContentType: ContentType,
					 isSearch : isSearch, contentSearch : contentSearch, isSelectedVideos : idVideoContent,
					 isPdfContents : idPdfContetns , currentpage : currentpage, currentsection : section,
					 idCollegeBatch : idCollegeBatch
				   },
			async: false, 
			success: function(data){
				if(isSearch == 1) {
					$("#contentDataDisp").html(data);
				} else {
					$("#ContentDiv").html(data);	
				}
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	} */
	
}

function displayConfirmView(){
	var isSubmitQuizForm = 1;
	$.each( $('#CreationDiv form input:not([type=hidden]),textarea,select:required').serializeArray(), function( key, value ) {
		if(value.value == "" || value.value == undefined){ //alert(value.name+" and "+value.value);
			var txt = $("#"+value.name).next().text();
			if(value.name == "idCollegeBatch"){
				txt = "Class";
			}else if(value.name == "idCourseInstance"){
				txt = "Course";
			}else if(value.name == "idSubject"){
				txt = "Subject";
			}
			$("#"+value.name+"Error").text(txt+" is Required");
			isSubmitQuizForm = 0;
		} else {
			var fieldvalue = value.value;
			if($.isNumeric(fieldvalue)){
				fieldvalue = $("#"+value.name+" option:selected").text();
				fieldvalue = fieldvalue ? fieldvalue : value.value;
			}
			$("#"+value.name+"Span").html(fieldvalue);
			$("#"+value.name+"Error").text("");
		}
	});
	
	var quizzeslength = $(".quizzes-pane .selected-list ul li").length;
	var simulationslength = $(".simulations-pane .selected-list ul li").length;
	var videoslength = $(".videos-pane .selected-list ul li").length;
	var presentationlength = $(".presentation-pane .selected-list ul li").length;
	var referenceMateriallength = $(".reference-pane .selected-list ul li").length;
	
	if(isSubmitQuizForm){
		if(!quizzeslength && !simulationslength && !videoslength && !presentationlength &&!referenceMateriallength){
			alert("Please add at least one Quiz / Video / Simulation / Presentation / ReferenceMaterial");
		} else {
			if(quizzeslength > 0){
				$("#QuizzesOverview").html($(".quizzes-pane .selected-list").html());
				$("#QuizzesOverview .sub--close").remove();
				$("#QuizzesOverview #quizformHiddenTextFields").remove();
			}
			if(simulationslength > 0){
				$("#SimulationsOverview ul").html($(".simulations-pane .selected-list  ul").html());
				$("#SimulationsOverview input").remove();
				$("#SimulationsOverview .sub--close").remove();
			}
			if(videoslength > 0){
				$("#VideosOverview ul").html($(".videos-pane .selected-list  ul").html());
				$("#VideosOverview input").remove();
				$("#VideosOverview .sub--close").remove();
			}
			if(presentationlength > 0){
				$("#PresentationsOverview ul").html($(".presentation-pane .selected-list ul").html());
				$("#PresentationsOverview input").remove();
				$("#PresentationsOverview .sub--close").remove();
			}
			if(referenceMateriallength > 0){ 
				$("#ReferenceMaterialOverview ul").html($(".reference-pane .selected-list ul").html());
				$("#ReferenceMaterialOverview input").remove();
				$("#ReferenceMaterialOverview .sub--close").remove();
			}
			$("#CreationDiv").hide();
			$("#LearningmoduleOverview").show();
		}
	}
}

function displayLmCreationDiv(){
	$("#CreationDiv").show();
	$("#LearningmoduleOverview").hide();
}

function StudentActivation(idStudent, Status, idCollegeBatch, Action){
	
	if(idStudent == "") {
		var studentArray = new Array(); 
		$("input[name='idStudents']:checked").each(function () {
		   studentArray.push($(this).val());
		});

		if(studentArray.length > 0) {
			idStudent = studentArray.join();
		} else {
			alert("Please select at least one student");
			return false;
		}
	}
	
	if(idStudent && Status && idCollegeBatch){		
		var r = confirm(" Are you sure you want to "+Action+" the student?");
		// alert(idStudent);
		// alert(idCollegeBatch);
		if (r == true) {
			$.ajax({
				url: baseurl+"teacherapp/StudentBatchAssignment",
				type: "POST",
				data : {idStudent : idStudent, Status : Status, idCollegeBatch: idCollegeBatch},
				async: false, 
				success: function(data){
					if(data == "SUCCESS"){
						location.reload();
					} else {
						alert("OOPS! Something Went Wrong..!");
					}
				},
				error:function(){
					console.log("oops! Something went wrong");
				}
			});
		}
	}
}

function LearningModuleListByDate(SelectedDate, event = ""){
	if(SelectedDate){
		var idCollegeBatch = $("#idCollegeBatch").val();
		if(event == "scroll"){
			var notDisplayNoData = 1;
		} else {
			var notDisplayNoData = 0;
		}
		if(event == "scroll"){
			var offset = $("#offsetVal").val();
		} else {
			var offset = "";
		}
		$.ajax({
			url: baseurl+"teacherapp/LearningModuleListByDate",
			type: "GET",
			data : {SelectedDate : SelectedDate, idCollegeBatch: idCollegeBatch, notDisplayNoData : notDisplayNoData, offset: offset, EventType: event},
			async: false, 
			success: function(data){
				if(event == "scroll"){
					$("#LMTable").append(data);
				} else {
					$("#offsetVal").val(0);
					$("#CalendarData").html(data);
				}
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		});
	}
}
function navigateToVideo(idContent, idCourseInstance = 0, idCourseSubject = 0, idChapter = 0) {
	window.location.href = baseurl+"teacherapp/video/"+idContent+"/"+idCourseInstance+"/"+idCourseSubject+"/"+idChapter;
}
function navigateToSimulation(idContent) {
	alert("Simulations are not playing in web view");
}
function navigateToAR(idContent) {
	alert("AR videos are not playing in web view");
}
function getTestQuestionPaper(idTestQuestionPaper){
	window.location.href = baseurl+"teacherapp/testQuestionPaper/"+idTestQuestionPaper;
}

$(document).ready(function(){
	$(".block-content-wrap .back-btn").on("click", (function() {
        $(this).parents(".block-content-wrap").removeClass("show"), $(".body-overlay").removeClass("active"), $(".body-overlay").removeClass("show-active"), $(".pop-video-wrap .pos-fixed-overlay").attr("hidden", "hidden"), $(".pop-quizzes-wrap .pos-fixed-overlay").attr("hidden", "hidden"), $(".unassigned-classroom-wrap").removeClass("show"), $(".assignment-added").removeClass("show"), $(".filter-actions-dialog").hide();
    })); 
	$(".transcript-link").on("click",(function(){
		//$(".transcript-wrap").slideToggle()
		$(".transcript-wrap").slideToggle();
		if($(this).find(".iconcaret .fa").hasClass("fa-angle-down")){
			$(this).find(".iconcaret .fa").removeClass("fa-angle-down").addClass("fa-angle-up");
		}else{
			$(this).find(".iconcaret .fa").removeClass("fa-angle-up").addClass("fa-angle-down");
		}
		
	}));
});

function bookmark(idContent){
	var IsBookmarkedYN = $("#bookmark_"+idContent).val();
	$.ajax({
		url: baseurl+"teacherapp/bookmark",
		type: "POST",
		data : {idContent : idContent, IsBookmarkedYN: IsBookmarkedYN},
		async: false, 
		success: function(data){
			if(IsBookmarkedYN == "Y"){
				$("#bookmark_"+idContent).val("N");
			} else {
				$("#bookmark_"+idContent).val("Y");
			}
			
			if(data == "SUCCESS"){
				if(IsBookmarkedYN == "Y"){
					var Message = "Successfully Bookmarked";
					var Class	= "alert-content alert-success";
					displayJSFlashMessage(Message, Class);
					$("#svg_"+idContent).attr("stroke", "green");
					$(".svg_"+idContent).attr("stroke", "green");
				} else {
					var Message = "Successfully Removed Bookmark";
					var Class	= "alert-content alert-success";
					displayJSFlashMessage(Message, Class);
					$("#svg_"+idContent).attr("stroke", "none");
					$(".svg_"+idContent).attr("stroke", "none");
				}
			}
		},
		error:function(){
			console.log("oops! Something went wrong");
		}
	});
}
function ContentRating(idContent){
	var Action = $("#contentrating_"+idContent).val();
	$.ajax({
		url: baseurl+"teacherapp/ContentRating",
		type: "POST",
		data : {idContent : idContent, Action: Action},
		async: false, 
		success: function(data){
			if(Action == "Delete"){
				var Message = "Successfully disliked";
				var Class	= "alert-content alert-success";
				displayJSFlashMessage(Message, Class);
				$("#contentrating_"+idContent).val('');
			} else{
				var Message = "Successfully liked";
				var Class	= "alert-content alert-success";
				displayJSFlashMessage(Message, Class);
				$("#contentrating_"+idContent).val('Delete');
			}
			
			if(data == "SUCCESS"){
				if(Action == "Delete"){
					$(".heart-icon i").css('color', '');
				} else {
					$(".heart-icon i").css('color', '#ff5353');
				}
			}
		},
		error:function(){
			console.log("oops! Something went wrong");
		}
	});
	
}

function chapterChange() {
	var idCourseInstance 		= $("#idCourseInstance").val();
	var idSubject		 		= $("#idSubject").val();
	var idCourseSubjectChapter 	= $("#idChapterExam").val();
	var ContentType 			= "mpg";
	var contentSearch 			= "";

	if(idCourseInstance && idSubject && idCourseSubjectChapter){
		$.ajax({
			url: baseurl+"teacherapp/ContentIndexBySearch",
			type: "GET",
			data : { idCourseInstance : idCourseInstance, idSubject : idSubject, ContentType: ContentType, idCourseSubjectChapter : idCourseSubjectChapter, contentSearch : contentSearch },
			async: false, 
			success: function(data){
				$("#quizContentsDiv").html(data);
				getTopics(idCourseSubjectChapter);
				/* $(".select-control").select2({
					minimumResultsForSearch: Infinity,
					selectionTitleAttribute: false
				}); */
			},
			error:function(){
				console.log("oops! Something went wrong");
			}
		}); 
	} else {
		
	}
	
	getQuestionsCountByLevel();
}

function getTopics(idChapter) {
	let disableOnchangeFunc = 1;
	$.ajax({
		url: baseurl+"chapter/gettopics/"+idChapter+"/"+disableOnchangeFunc,
		type: "GET",
		async: false, 
		success: function(data){
			$("#idTopic").html(data);
		},
		error:function(){
			console.log("oops! Something went wrong");
		}
	}); 
}

function getQuestionsCountByLevel(selectedId = ""){
	
	var idCourseSubjectChapter = $("#idChapterExam").val();
	var idContent = $("#idContentQuiz").val();
	
	if(!idCourseSubjectChapter){ return false; }
	$.ajax({
		url: baseurl+"teacherapp/getQuestionsCountByLevel",
		type: "GET",
		data : { idCourseSubjectChapter : idCourseSubjectChapter, idContent : idContent, isAjaxCall : 1 },
		success: function(data){
			if(selectedId){
				alert(selectedId);
				$("#"+selectedId).html(data);
			} else{
				$("#levelsDiv").html(data);
			}
			$(".select-control").select2({
					minimumResultsForSearch: Infinity,
					selectionTitleAttribute: false
				});
		},
		error:function(){
			console.log("oops! Something went wrong");
		}
	}); 
	
}

function displayJSFlashMessage(Message, Class){
	$("#javascriptflashmessageStyle").removeAttr("Class");
	$("#javascriptflashmessage").show();
	$("#javascriptflashmessageStyle").addClass(Class);
	$("#javascriptflashmessageStyle p").html(Message);
	setTimeout(function(){
		$("#javascriptflashmessage").hide();
	}, 3000);
}