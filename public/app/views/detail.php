<div class="container">
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header" style="margin-bottom: 0;"><?= $prop_code; ?> - <?= $property_data['location_name']; ?></h1>
                <h4 class="page-header"><?= $property_data['property_summary']; ?></h1>

                    <div class="carousel property">
                        <div class="content">

                            <a class="carousel-prev" href="#">Previous</a>
                            <a class="carousel-next" href="#">Next</a>
                            <ul>
                                <li class="active">
                                    <img src="<?= base_url("photos/" . $prop_code . "/" . $property_data['property_img']); ?>" alt="">
                                </li>
                                <?php
                                foreach ($photos as $photo) {
                                    echo '<li>';
                                    echo '<img src="' . base_url("photos/" . $prop_code . "/" . $photo) . '" alt="">';
                                    echo '</li>';
                                }
                                ?>                            
                            </ul>
                        </div>                    
                        <!-- /.content -->
                        <div class="preview">
                            <img src="<?= base_url("photos/" . $prop_code . "/" . $property_data['property_img']); ?>" alt="">
                        </div><!-- /.preview -->
                    </div>
                    <!-- /.carousel -->
            </div>
            <div class="sidebar span3">
                <div class="widget contact">
                    <?= $contact_form; ?>
                </div><!-- /.widget -->
                <div class="widget properties last">
                    <?= $latest_prop; ?>
                </div><!-- /.properties -->
            </div>
        </div>
        <div class="property-detail">
            <div class="overview">
                <div class="row">
                    <div class="span7">
                        <h2 style="margin: 0 0 6px;">Overview</h2>
                        <p style="margin: 0 0 16px;"><strong><?= $property_data['property_summary']; ?></strong></p>
                        
                        <?= $property_data['property_overview']; ?>

                    </div>
                    <div class="span4">
                        <table class="table-bordered table-striped table-hover property-details">
                            <tr>
                                <th colspan="2">PROPERTY DETAILS</th>
                            </tr>
                            <tr>
                                <td>SLEEPS</td>
                                <td><?= $property_data['property_sleeps']; ?></td>
                            </tr>
                            <tr>
                                <td>LOW SEASON PRICE:</td>
                                <td><?= fdisplayCurrency($property_data['property_rate_low']); ?></td>
                            </tr>
                            <tr>
                                <td>MID SEASON PRICE:</td>
                                <td><?= fdisplayCurrency($property_data['property_rate_med']); ?></td>
                            </tr>
                            <tr>
                                <td>HIGH SEASON PRICE:</td>
                                <td><?= fdisplayCurrency($property_data['property_rate_high']); ?></td>
                            </tr>
                            <tr>
                                <td>BEDROOMS:</td>
                                <td><?= $property_data['property_bedrooms']; ?></td>
                            </tr>
                            <tr>
                                <td>BATHROOMS:</td>
                                <td><?= $property_data['property_bathrooms']; ?></td>
                            </tr>
                            <tr>
                                <td>LOCATION:</td>
                                <td><?= $property_data['location_name']; ?></td>
                            </tr>
                            <tr>
                                <td>PROPERTY TYPE:</td>
                                <td><?= $property_data['type_name']; ?></td>
                            </tr>
                        </table>

                    </div>
                    <!-- /.span4 -->
                </div>
                <!-- /.row -->
                <div class="row">        
                    <div class="span11">        
                        <h2>Map</h2>
                        <div id="property-map"></div><!-- /#property-map -->
                    </div>
                </div>

            </div>
            <!-- /.overview -->
        </div>
        <!-- /.property detail -->
    </div> <!-- /#main -->
    <?php
//    wts($property_data);
//    wts($photos);
    ?>
</div> <!-- /#container -->