jQuery(document).ready(function(){

   	//AJAX Upload
		jQuery('.upload_button').each(function(){
		
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');	
		new AjaxUpload(clickedID, {
			  action: '?tmpl=save-upload',
			  name: clickedID, // File upload name
			  data: { // Additional data to send
					action: 'file_upload',
					type: 'upload',
					data: clickedID },
			  autoSubmit: true, // Submit file after selection
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension){
					clickedObject.text('Uploading'); // change button text, when user selects file	
					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
			  },
			  onComplete: function(file, response) {
			   
			  	window.clearInterval(interval);
				clickedObject.text('Upload');	
				this.enable(); // enable upload button
				
				// If there was an error
			  	if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
				
				}
				else{
					var buildReturn = '<div class="upload_response">Uploaded '+response+' </div>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
					clickedObject.next('span').fadeIn();
					clickedObject.parent().prev('input').val(response);
				}
			  }
			});
		
		}); 
});
