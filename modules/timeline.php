<?php 


add_filter("page_template", "magyar_extra_idovonal");
function magyar_extra_idovonal($page_template)
{
   $id = substr($page_template, strrpos($page_template, '/') + 1);
   if ($id == 'page-template-timeline.php') {
    $page_template = plugin_dir_path(__FILE__) . 'page-template-timeline-hun.php';
   }
   return $page_template;
}