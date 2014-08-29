
    <div class="wrapper">
            <header>
                <div class="top-menu">
                    <div class="container clearfix">
                        <ul class="customer-type">
                      <?php
                        $websiteQuery = "select * from core_website where status='1'";
                        $websites = $db->get_results($websiteQuery);
                            foreach ($websites as $website) {
                                if(isset($_SESSION['website']) && $_SESSION['website'] == $website->core_website_name ){
                                    echo '<li class="active"><a href="'.DOMAIN.$website->core_website_name.'" title="'.$website->core_website_value.'">'.$website->core_website_value.'</a></li>';
                                }
                                else{
                                    echo '<li><a href="'.DOMAIN.$website->core_website_name.'" title="'.$website->core_website_value.'">'.$website->core_website_value.'</a></li>';    
                                }
                                
                            }
                        ?>
                        </ul>
                        <ul class="online-menu clearfix">
                        <?php
                            $wi = $_SESSION['website'];
                            $w = "select * from core_website where status='1' and core_website_name='$wi'";
                            $w = $db->get_row($w);
                            if($w->id == '1'){
                                $catID = '5';
                            }
                            else{
                                $catID = '6';
                            }
                            $hNavQuery = "select * from categories where status='1' and core_website_id='$w->id' and parent_id='1' and category_group_id='$catID'";
                            $hNav = $db->get_results($hNavQuery);
                            if($hNav){


                                foreach($hNav as $h){
                                    $url = "select * from core_url where id ='$h->core_url_id' and status ='1'";
                                    $url = $db->get_row($url);

                                    echo '<li><a href="'.DOMAIN.$url->core_url_key.'" title="'.$h->category_name.'" ><span class="'.$h->icon_spec.'"></span>'.$h->category_name.'</a></li>';
                                }
                            }
                            else{
                                echo '<li><a href="#" title="ERROR">Tanımlanmamış Hızlı Menu</a></li>';
                            }

                        ?>
                         </ul>
                    </div>
                </div><!--top-menu-->