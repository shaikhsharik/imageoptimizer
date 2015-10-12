<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Image Optimizer- Sharik</title>
<script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript"> 
$(document).ready(function() { 
//elements
var progressbox 		= $('#progressbox'); //progress bar wrapper
var progressbar 		= $('#progressbar'); //progress bar element
var statustxt 			= $('#statustxt'); //status text element
var submitbutton 		= $("#SubmitButton"); //submit button
var myform                      = $("#UploadForm"); //upload form
var output 			= $("#output"); //ajax result output element
var completed 			= '0%'; //initial progressbar value
var FileInputsHolder 	= $('#AddFileInputBox'); //Element where additional file inputs are appended
var MaxFileInputs		= 100; //Maximum number of file input boxs

// adding and removing file input box
var i = $("#AddFileInputBox div").size() + 1;
$("#AddMoreFileBox").click(function () {
		event.returnValue = false;
		if(i < MaxFileInputs)
		{
			$('<span><input type="file" id="fileInputBox" size="20" name="file[]" class="addedInput" value=""/><a href="#" class="removeclass small2"><img src="images/close_icon.gif" border="0" /></a></span>').appendTo(FileInputsHolder);
			i++;
		}
		return false;
});

$("body").on("click",".removeclass", function(e){
		event.returnValue = false;
		if( i > 1 ) {
				$(this).parents('span').remove();i--;
		}
		
}); 

$("#ShowForm").click(function () {
  $("#uploaderform").slideToggle(); //Slide Toggle upload form on click
});
	
$(myform).ajaxForm({
	beforeSend: function() { //brfore sending form
		submitbutton.attr('disabled', ''); // disable upload button
		statustxt.empty();
		progressbox.show(); //show progressbar
		progressbar.width(completed); //initial value 0% of progressbar
		statustxt.html(completed); //set status text
		statustxt.css('color','#000'); //initial color of status text
		
	},
	uploadProgress: function(event, position, total, percentComplete) {
            //on progress
		progressbar.width(percentComplete + '%') //update progressbar percent complete
		statustxt.html(percentComplete + '%'); //update status text
		if(percentComplete>50)
			{
				statustxt.css('color','#fff'); //change status text to white after 50%
			}else{
				statustxt.css('color','#000');
			}
			
		},
	complete: function(response) { // on complete
//		output.html(response.responseText).fadeOut( 8000, function() {
//                    
//                $("#uploaderform").slideToggle();
//                    
//                }); //update element with received data
output.html(response.responseText);
		myform.resetForm();  // reset form
		submitbutton.removeAttr('disabled'); //enable submit button
		progressbox.hide(); // hide progressbar
		$("#uploaderform").slideUp(); // hide form after upload
	}
});

}); 
</script> 
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="uploaderform">
<form action="upload.php" method="post" enctype="multipart/form-data" name="UploadForm" id="UploadForm">
    <h1>Image Optimizer - v1.0</h1>
    <p>Each recommended image file size must be less than 1MB!</p>
    
    <label>Files
    <span class="small"><a href="#" id="AddMoreFileBox">Add More Files</a></span>
    </label>
    <div id="AddFileInputBox"><input id="fileInputBox" style="margin-bottom: 5px;" type="file"  name="file[]" multiple required/></div>
    <div class="sep_s"></div>
    


	<label>Quality
    <span class="small required">Your Quality</span>
    </label>
    <div>
	<select name="selectquality">
	<option value="10">Low</option>
	<option value="30">Medium</option>
	<option value="50" selected>High</option>
	<option value="80">Very High</option>
	<option value="100">Maximum</option>
	</select>
	
	
	</div>


	<label>Width
    <span class="small">Image Width</span>
    </label>
    <div>

	<input id="width" class="imgwidth" style="margin-bottom: 20px;" type="text" value="640" name="imgwidth" required/>

	</div>


	<label>Height
    <span class="small">Image Height</span>
    </label>
	<div>
	<input id="height" class="imgheight" style="margin-bottom: 5px;" type="text" value="504" name="imgheight" required/>
	</div>

    
    <button type="submit" class="button" id="SubmitButton">Upload</button>
    
    <div id="progressbox"><div id="progressbar"></div ><div id="statustxt">0%</div ></div>
</form>
</div>
<div id="uploadResults">
	<div align="center" style="margin:20px;"><a href="#" id="ShowForm">Toggle Form</a></div>
    <div id="output"></div>
</div>


<script>
$(document).ready(function(){  

        $('#SubmitButton').click(function(e){
   var imgVal = $('#fileInputBox').val(); 
   var width = $('.imgwidth').val();
   var height = $('.imgheight').val();
   
   if(width <1 ||  height <1){
       
       alert("Cant be empty");
       return false;
       e.preventDefault();
   }
   if(imgVal==''){
            
       alert("empty input file"); 

   } 
    
});



});
</script>

</body>
</html>
