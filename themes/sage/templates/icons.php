<?php 
$posttags = get_the_tags();
  if ($posttags) {
    echo '<div class="row">';
    foreach($posttags as $tag) {
      switch ($tag->name) {
        case 'Javascript':
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-javascript-plain colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'JQuery':
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-jquery-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Git' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-git-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'WordPress' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-wordpress-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'SSH' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-ssh-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'NodeJS' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-nodejs-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Sass' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-sass-original colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'MySQL' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-mysql-plain-wordmark colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'PHP' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-php-plain colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Twitter' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon fa fa-twitter-square fa-2x"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Instagram' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon fa fa-instagram fa-2x"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Yahoo Query Language' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon fa fa-yahoo fa-2x"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;        
        case 'Photoshop' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-photoshop-plain colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        case 'Illustrator' : 
          echo '<div class="col-xs-3 col-sm-3 col-md-3 icon-column">';
          echo '<i class="icons devicon-illustrator-plain colored"></i>';
          echo '<div class="col-md-12">';
          echo $tag->name . ' '; 
          echo '</div>';
          echo '</div>';
          break;
        
        default:
          # code...
          break;
      }
    }
    echo '</div>';
  }

?>