<?php
/*
Plugin Name: AddThis Social Bookmarking Widget (drop-down)
Plugin URI: http://www.addthis.com
Description: Help your visitor promote your website or blog. Put the AddThis Social Bookmarking Widget on your site or blog, so any visitor can easily bookmark it. The widget works with all popular bookmarking services.
Version: 1.2
Author: AddThis.com
Author URI: http://www.addthis.com
*/



class addthis_social_widget_drop{


  //=====================================
  //Want stats with your AddThis plugin? 
  //Put your AddThis username in this variable 

    var $addthis_username = "";
  //===================================== 


  function addthis_social_widget_drop(){
     add_filter('the_content', array(&$this, 'social_widget'));
  }

  function social_widget_doposts($content){  

     for ($i=0; $i<10; $i++){
         $content .= $this->social_widget_post($i);
     }
     return $content;
  }

  function social_widget($content){  
     $link  = urlencode(get_permalink());
     $title = urlencode(get_the_title($id));

     return $content . $this->social_widget_badge($link, $title);
  }

  function social_widget_post($entry){
     $link  = urlencode(get_permalink());
     $title = urlencode(get_the_title($id));
     if (!isset($link)){
       $widget_post  = $this->social_widget_badge($link, $title);
       $widget_post .= $this->social_widget_postit($entry);
     }
     return $widget_post;
  }


  function social_widget_badge($link, $title){
    $pub = $this->addthis_username;

    $badge  = "<script type=\"text/javascript\">\n";
    $badge .= "  addthis_url    = '$link';\n";   
    $badge .= "  addthis_title  = '$title';\n"; 
    $badge .= "  addthis_pub    = '$pub';\n";
    $badge .= "</script><script type=\"text/javascript\" src=\"http://s7.addthis.com/js/addthis_widget.php?v=12\" ></script>\n";

    return $badge;
  }


  function social_widget_postit($i){
     add_filter('the_content', array(&$this, 'social_widget'));
     $content = $this->social_widget($content);

     $cut = explode("|", $content);
     $post = $cut[0];
     $link  = $cut[1]; 
     return content . "<br />$link";
  }

}

$addthis &= new addthis_social_widget_drop();

?>