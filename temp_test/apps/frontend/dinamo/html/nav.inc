 <nav>
                    <div class="container">
                        <a href="<?php echo DOMAIN; ?>" class="logo">Dinamo Eleltrik</a>
                        <ul>
                        <?php 
                         $wi = $_SESSION['website'];
                            $w = "select * from core_website where status='1' and core_website_name='$wi'";
                            $w = $db->get_row($w);
                            if($w->id == '1'){
                                $catID = '1';
                            }
                            else{
                                $catID = '3';
                            }
                            $hNavQuery = "select * from categories where status='1' and core_website_id='$w->id' and parent_id='1' and category_group_id='$catID'";

                            $hNav = $db->get_results($hNavQuery);
                            if($hNav){


                                foreach($hNav as $h){
                                    $url = "select * from core_url where id ='$h->core_url_id' and status ='1'";
                                    $url = $db->get_row($url);

                                    //sub menu
                                    $sub = "select * from categories where status='1' and parent_id='$h->id'";
                                    $sub = $db->get_results($sub);
                                    if($sub){
                                        echo '<li class="dd-menu"><a href="'.DOMAIN.$url->core_url_key.'" title="'.$h->category_name.'" >'.$h->category_name.'</a>';
                                        echo '<div class="dropdown_fullwidth">';
                                        echo '<ul>';
                                        foreach($sub as $s){
                                            $url = "select * from core_url where id ='$s->core_url_id' and status ='1'";
                                            $url = $db->get_row($url);  
                                           echo '<li><a href="'.DOMAIN.$url->core_url_key.'" title="'.$s->category_name.'">'.$s->category_name.'</a></li>';
                                        }
                                        //<li><a href="#">KAMPANYA ADI BİR</a></li>
                                        echo '</ul></div>';
                                        echo '</li>';
                                    }
                                    else{
                                    echo '<li><a href="'.DOMAIN.$url->core_url_key.'" title="'.$h->category_name.'" >'.$h->category_name.'</a></li>';
                                        
                                    }
                                }
                            }
                            else{
                                echo '<li><a href="#" title="ERROR">Tanımlanmamış Hızlı Menu</a></li>';
                            }
                        ?>
                         
                        </ul>
                        <!--mobil galiba-->
                        <div class="menu-icon">
                            <ul class="hidden-dd">
                        <?php 
                            $wi = $_SESSION['website'];
                            $w = "select * from core_website where status='1' and core_website_name='$wi'";
                            $w = $db->get_row($w);
                            if($w->id == '1'){
                                $catID = '1';
                            }
                            else{
                                $catID = '3';
                            }
                            $hNavQuery = "select * from categories where status='1' and core_website_id='$w->id' and parent_id='1' and category_group_id='$catID'";

                            $hNav = $db->get_results($hNavQuery);
                            if($hNav){


                                foreach($hNav as $h){
                                    $url = "select * from core_url where id ='$h->core_url_id' and status ='1'";
                                    $url = $db->get_row($url);

                                    //sub menu
                                    $sub = "select * from categories where status='1' and parent_id='$h->id'";
                                    $sub = $db->get_results($sub);
                                    if($sub){
                                        echo '<li class="show-nested-item"><a href="#" title="'.$h->category_name.'" >'.$h->category_name.'</a>';
                                        echo '<div class="nested-dd">';
                                        echo '<ul>';
                                        foreach($sub as $s){
                                            $url = "select * from core_url where id ='$s->core_url_id' and status ='1'";
                                            $url = $db->get_row($url);  
                                           echo '<li><a href="'.DOMAIN.$url->core_url_key.'" title="'.$s->category_name.'">'.$s->category_name.'</a></li>';
                                        }
                                        //<li><a href="#">KAMPANYA ADI BİR</a></li>
                                        echo '</ul></div>';
                                        echo '</li>';
                                    }
                                    else{
                                    echo '<li><a href="'.DOMAIN.$url->core_url_key.'" title="'.$h->category_name.'" >'.$h->category_name.'</a></li>';
                                        
                                    }
                                }
                            }
                            else{
                                echo '<li><a href="#" title="ERROR">Tanımlanmamış Hızlı Menu</a></li>';
                            }
                        ?>
                              <!--  <li><a href="kesfet.html">KEŞFET</a></li>
                                <li><a href="#">TARİFELER</a></li>
                                <li class="show-nested-item">
                                    <a href="#">KAMPANYALAR</a>
                                    <div class="nested-dd">
                                        <ul>
                                            <li><a href="#">KAMPANYA ADI BİR</a></li>
                                            <li><a href="#">KAMPANYA ADI İKİ</a></li>
                                            <li><a href="#">KAMPANYA ADI ÜÇ</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#">DİNAMOLU OLMAK İSTİYORUM</a></li>-->
                            </ul>
                        </div><!--mobil galiba-->
                    </div>
                </nav>
            </header>