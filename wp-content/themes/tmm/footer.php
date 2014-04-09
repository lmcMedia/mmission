<?php 
$footer_content = get_page_by_title('Footer Content');
echo $footer_content->post_content;
?>

<?php print get_option('tmm_analytics'); ?>