/* global $*/
/* global obj $*/
$(function(){
    $('#selected_images').on('change', function(){
        $('#show_images').empty();
        for (var i = 0; i < this.files.length; i++) {
        	var fileReader = new FileReader();
        	fileReader.onload = (function (e) {
        		$('#show_images').append('<img src="' + e.target.result + '">');
        		$('#show_images img').addClass('img-fluid mb-2 w-25');
        		$('#selected_images_label').text('画像を変更する')
        	});
        	fileReader.readAsDataURL(this.files[i]);
        } 
    });
    
    $('#show_souvenir_images img').on('click', function(){
       var image = $(this).attr('src');
       $('#show_thumb_image img').attr('src', image);
    });

});