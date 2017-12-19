<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="<?=base_url('assets/img/home/home-1.jpg');?>">
        </div>

        <div class="item">
            <img src="<?=base_url('assets/img/home/home-2.jpg');?>">
        </div>
        
        <div class="item">
            <img src="<?=base_url('assets/img/home/home-3.jpg');?>">
        </div>
    </div>
</div>



<div class="container">
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header">Featured properties</h1>
                <?php
//                    wts($featured_properties);
                ?>
                <div class="properties-grid">
                    <div class="row">
                        
                        <?php
                        // cycle through featured propertyes
                        // this should only be 6
                        foreach ($featured_properties as $property_id=>$property) {
                            ?>
                            <div class="property span3">
                                <div class="image">
                                    <div class="content">
                                        <a href="<?=base_url("property/detail/".$property['property_code']."");?>"></a>
                                        <img src="<?=base_url("photos/".$property['property_code']."/".$property['property_img']);?>" alt="" style="width: 270px; height: 200px">
                                    </div><!-- /.content -->
                                    
                                    <div class="reduced">from <?= fdisplayCurrency($property['property_rate_low']); ?></div><!-- /.reduced -->
                                </div><!-- /.image -->

                                <div class="title">
                                    <h2><a href="<?=base_url("property/detail/".$property['property_code']."");?>"><?=$property['property_code'];?></a></h2>
                                </div><!-- /.title -->

                                <div class="location"><?=$property['location_name'];?>, Hermanus</div><!-- /.location -->
                                <div class="property-footer">
                                <div class="area">
                                    <span class="key">Sleeps:</span><!-- /.key -->
                                    <span class="value"><?=$property['property_sleeps'];?></span><!-- /.value -->
                                </div><!-- /.area -->
                                <div class="bedrooms"><div class="content"><?=$property['property_bedrooms'];?></div></div><!-- /.bedrooms -->
                                <div class="bathrooms"><div class="content"><?=$property['property_bathrooms'];?></div></div><!-- /.bathrooms -->
                                </div>
                            </div><!-- /.property -->
                            <?php
                        }
                        ?>
                        
                    </div><!-- /.row -->
                </div><!-- /.properties-grid -->
            </div>
            <div class="sidebar span3">
                <div class="widget our-agents">
                    <div class="title">
                        <h2>About Us</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <p>We offer <b>personalized service</b> in booking and managing properties blah blah blah etc and stuff.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <p><a href="">More About Us</a>
                    </div><!-- /.content -->
                </div><!-- /.our-agents -->
                <div class="hidden-tablet">
                    <div class="widget properties last">
                        <?=$latest_prop;?>
                    </div><!-- /.properties -->
                </div>
            </div>
        </div>
        <div class="carousel">
            <h2 class="page-header">All properties</h2>

            <div class="content">
                <a class="carousel-prev">Previous</a>
                <a class="carousel-next">Next</a>
                <ul>
                    <?php
                        // cycle through featured propertyes
                        // this should only be 6
                        foreach ($all_properties as $property_id=>$property) {
                            ?>
                            <li>
                                <div class="image">
                                    <a href="<?=base_url("property/detail/".$property['property_code']."");?>"></a>
                                    <img src="<?=base_url("photos/".$property['property_code']."/".$property['property_img']);?>" alt="" style="width: 270px; height: 200px;">
                                </div><!-- /.image -->
                                <div class="title">
                                    <h3><a href="<?=base_url("property/detail/".$property['property_code']."");?>"><?=$property['property_code'];?></a></h3>
                                </div><!-- /.title -->
                                <div class="location"><?=$property['location_name'];?>, Hermanus</div><!-- /.location-->
                                <div class="price">from <?= fdisplayCurrency($property['property_rate_low']); ?></div><!-- .price -->
                                <div class="area">
                                    <span class="key">Sleeps:</span>
                                    <span class="value"><?=$property['property_sleeps'];?></span>
                                </div><!-- /.area -->
                                <div class="bathrooms"><div class="inner"><?=$property['property_bathrooms'];?></div></div><!-- /.bathrooms -->
                                <div class="bedrooms"><div class="inner"><?=$property['property_bedrooms'];?></div></div><!-- /.bedrooms -->
                            </li>
                            <?php                            
                        }
                    ?>
                </ul>
            </div><!-- /.content -->
        </div><!-- /.carousel -->        
        <div class="features">
            <h2 class="page-header">Why Harmonie Rental Properties?</h2>

            <div class="row">
                <div class="item span4">
                    <div class="row">
                        <div class="icon span1">
                            <img src="assets/img/icons/features-seo.png" alt="">
                        </div><!-- /.icon -->

                        <div class="text span3">
                            <h3>Personal Service</h3>
                            <p>Hier kan jy nou mooi dingetjies sê van hoekom julle awesome is en beter is as ander maatskappye.</p>
                        </div><!-- /.logo -->
                    </div><!-- /.row -->
                </div><!-- /.item -->

                <div class="item span4">
                    <div class="row">
                        <div class="icon span1">
                            <img src="assets/img/icons/features-retina.png" alt="">
                        </div><!-- /.icon -->

                        <div class="text span3">
                            <h3>Local Knowledge</h3>
                            <p>Realia looks great even on Retina and high-resoultion displays. Every graphic element is sharp and clean. No blurry images anymore!</p>
                        </div><!-- /.logo -->
                    </div><!-- /.row -->
                </div><!-- /.item -->

                <div class="item span4">
                    <div class="row">
                        <div class="icon span1">
                            <img src="assets/img/icons/features-custom-widgets.png" alt="">
                        </div><!-- /.icon -->

                        <div class="text span3">
                            <h3>Nog iets wat sin maak</h3>
                            <p>Realia provides custom developed widgets to fulfil requirements of good real estate application.</p>
                        </div><!-- /.logo -->
                    </div><!-- /.row -->
                </div><!-- /.item -->
            </div>
            <!--    <div class="row">
                    <div class="item span4">
                        <div class="row">
                            <div class="icon span1">
                                <img src="assets/img/icons/features-bootstrap.png" alt="">
                            </div> /.icon 
            
                            <div class="text span3">
                                <h3>Prepared for Bootstrap</h3>
                                <p>Developer friendly code based on Bootstrap and SASS makes your own customizations really easy.</p>
                            </div> /.logo 
                        </div> /.row 
                    </div> /.item 
            
                    <div class="item span4">
                        <div class="row">
                            <div class="icon span1">
                                <img src="assets/img/icons/features-pencil.png" alt="">
                            </div> /.icon 
            
                            <div class="text span3">
                                <h3>Frontend Submission</h3>
                                <p>Make the portal solution from your real estate by providing property submission on homepage.</p>
                            </div> /.logo 
                        </div> /.row 
                    </div> /.item 
            
                    <div class="item span4">
                        <div class="row">
                            <div class="icon span1">
                                <img src="assets/img/icons/features-responsive.png" alt="">
                            </div> /.icon 
            
                            <div class="text span3">
                                <h3>Responsive</h3>
                                <p>Realia is ready to put your website on higher ranks. Every line of code was developed with SEO principles in mind.</p>
                            </div> /.logo 
                        </div> /.row 
                    </div> /.item 
                </div> /.row -->
        </div><!-- /.features -->    
    </div>
</div>

<div class="bottom-wrapper">
    <div class="bottom container">
        <div class="bottom-inner row">
            

            <div class="item span4">
                <div class="gps decoration"></div>
                <h2><a>Property rentals</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div><!-- /.item -->

            <div class="item span4">
                <div class="key decoration"></div>
                <h2><a>Property Management</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                <a href="#" class="btn btn-primary">Read more</a>
            </div><!-- /.item -->
            
            <div class="item span4">
                <div class="address decoration"></div>
                <h2><a>List your property</a></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan dui ac nunc imperdiet rhoncus. Aenean vitae imperdiet lectus</p>
                <a href="#" class="btn btn-primary">List Property</a>
            </div><!-- /.item -->
        </div><!-- /.bottom-inner -->
    </div><!-- /.bottom -->
</div><!-- /.bottom-wrapper -->    



