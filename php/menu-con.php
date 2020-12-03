<style>
#main_menu ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333333;
  }
  
  #main_menu li {
      margin:0 auto;
    float: left;
  }
  
  #main_menu li a {
    display: block;
    color: white;
    text-align: center;
    padding: 25px;
    text-decoration: none;
  }
  
  #main_menu li a:hover {
    background-color: #111111;
  }

</style>

<?php
$menuItems = array(
    'Home' => './',
    'statistics' => '/FinalProj/stats.php',
    'settings'=> '/FinalProj/admin/settings.php',
    'Sign Out' => '/FinalProj/signout.php'
);

function createMenu($menuItems){
    echo "<div id=\"main_menu\">";
    echo '<ul>';
    foreach($menuItems as $key=>$item){
        echo "<li> <a href='$item'>";
        echo $key;
        echo '</a></li>';
    }
    echo '</ul></div>';
}


createMenu($menuItems);
?>
