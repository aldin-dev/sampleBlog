$('#blog_img').on("change", function(){
    var tmp_url_img = URL.createObjectURL(event.target.files[0]);
    $('#image_viewer img').attr('src', tmp_url_img);
});