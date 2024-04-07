<?php
$search_query = isset($_GET['s']) ? $_GET['s'] : '';
?>
<form method="get" id="blogtube_searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <input name="s" id="blogtube_searchinput" type="text" required spellcheck="false" placeholder="<?php echo esc_attr_e('Search', 'blogtube') ?>" value="<?php echo esc_attr($search_query); ?>">
    <input type="submit" id="blogtube_search_submit" value="&#xf002;">
</form>
