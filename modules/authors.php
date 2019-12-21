<?php 


add_filter("page_template", "magyar_page_author");
function magyar_page_author($page_template)
{
   $id = substr($page_template, strrpos($page_template, '/') + 1);
   if ($id == 'page-template-authors.php') {
    $page_template = plugin_dir_path(__FILE__) . 'page-template-authors-hun.php';
   }
   return $page_template;
}