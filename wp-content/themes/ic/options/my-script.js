jQuery(document).ready(function() {

jQuery('.upload_image_button').click(function() {

formfield = jQuery(this).prev(".upload_image");
post_id = jQuery('#post_ID').val();
tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
return false;
});
window.send_to_editor = function(html) {
imgurl = jQuery('img',html).attr('src');
formfield.val(imgurl);
tb_remove();
}

return false;


});

