<?php
    //Ez a fő php
?>

<!DOCTYPE html>
<html lang="en">
  <head>
        <meta charset="utf-8" />
        <title>PET technológiák mindenkinek</title>
        <meta name="author" content="Iliás Renáta" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        
        <script src="js/jquery-1.2.6.js" type="text/javascript"></script>
        <script src="js/jquery.scrollTo-1.3.3.js" type="text/javascript"></script>
        <script src="js/jquery.localscroll-1.2.5.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/jquery.serialScroll-1.2.1.js" type="text/javascript" charset="utf-8"></script>
        <script src="js/slider_left_to_rigth.js" type="text/javascript" charset="utf-8"></script>
        
    </head>
    <body>
        <?php
            ob_start();
            //Csatlakozás a facebook SDK-hoz
            require "php/facebook.php";
            $signed_request = $_REQUEST["signed_request"];
            list($encoded_sig, $payload) = explode('.', $signed_request, 2);
            $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

            //Lájkolta-e már az adott felhasználó az oldalt
            $has_liked = $data["page"]["liked"];
 
            if($has_liked){
              //Az adott látogató már lájkolta az oldalt, akkor nézzük meg engedélyezte-e az alkalmazást
              if (!$data["user_id"]) {
                //Ha még nem akkor irányítsuk át az engedélyeztető képernyőre
                $app_id = "147259788772077"; 
                $tab_url = urlencode("https://www.facebook.com/..."); //ide kerül a tab URL
                $scope = "email,publish_actions";
                $auth_url = "http://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . $tab_url . "&scope=" . $scope;
                echo("<script> top.location.href='" . $auth_url . "'</script>");
              } else {
                //Már engedélyezte, akkor láthatja az alkalmazást, átírányít az alkalmazás php oldalára
                header("Location: index_y.php");
              }
            } else {
              //A látogató még nem rajongó, kérjük meg, hogy legyen az. Üres tábla lesz, ahol utalás van arra, hogy kedvelje az oldalt a felhasználó
            ?>
               <!--A tábla teteje-->
                  <div id="fejlec">
                    <div id="oldalcim">
	                    <a href="#home"><img src="images/oldalcim.png" alt="Oldal címe" /></a>
                    </div>   
               </div>
               <!--Tartalom panelok-->
                <div id="tartalom">
                    <div class="scroll">
                                <div class="panel" id="home">
                                    <a class="jobbra" ><img src="images/szoveg.png" alt="Facebook" /></a>
                    	         </div>
                     </div> 
                 </div> 
                 <!--Alsó gomb menüsor-->
                 <div id="menu">
                        <ul class="navigation">
                           
                        </ul>
                 </div>
            <?php
            }
            ?>
    </body>
</html>
