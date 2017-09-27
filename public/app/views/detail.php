<div class="container">
    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header">16 4th Street</h1>

                <div class="carousel property">
                    <div class="preview">
                        <img src="<?=base_url("assets/img/tmp/property-large-1.jpg");?>" alt="">
                    </div><!-- /.preview -->

                    <div class="content">

                        <a class="carousel-prev" href="#">Previous</a>
                        <a class="carousel-next" href="#">Next</a>
                        <ul>
                            <li class="active">
                                <img src="<?=base_url("assets/img/tmp/property-large-1.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-2.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-3.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-4.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-5.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-6.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-7.jpg");?>" alt="">
                            </li>
                            <li>
                                <img src="<?=base_url("assets/img/tmp/property-large-8.jpg");?>" alt="">
                            </li>
                        </ul>
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.carousel -->

                <div class="property-detail">
                    <div class="overview">
                        <div class="row">
                            <div class="span8">
                                <table class="table-bordered table-striped table-hover">
                                    <tr>
                                        <td>SLEEPS</td>
                                        <th>10</th>
                                    </tr>
                                    <tr>
                                        <td>PRICE FROM</td>
                                        <th>R 1 800</th>
                                    </tr>
                                    <tr>
                                        <td>PRICE TO:</td>
                                        <th>R 3 500</th>
                                    </tr>
                                    <tr>
                                        <td>BEDROOMS:</td>
                                        <th>5</th>
                                    </tr>
                                    <tr>
                                        <td>BATHROOMS:</td>
                                        <th>3</th>
                                    </tr>
                                    <tr>
                                        <td>LOCATION:</td>
                                        <th>Voëlklip</th>
                                    </tr>
                                </table>
                            </div>
                            <!-- /.span2 -->
                        </div>
                        <!-- /.row -->
                    </div>

                    <h2>Overview</h2>
                    <p><strong>5 Bedroom Holiday Home in Voëlklip Hermanus</strong></p>


                    <div class="row">
                        <ul class="span8">
                            <li class="checked">
                                Wonderful family house, perfect for the ideal holiday.
                            </li>
                            <li class="checked">
                                Open plan living and dining room and fire place.
                            </li>
                            <li class="checked">
                                Spacious, fully equipped kitchen with scullery.
                            </li>
                            <li class="checked">
                                Comfortable TV lounge.
                            </li>
                            <li class="checked">
                                Sociable outside built-in barbeque. Outside furniture.
                            </li>
                            <li class="checked">
                                Beautifully maintained garden.
                            </li>
                            <li class="checked">
                                Security gates and burglar bars on all doors and windows
                            </li>
                        </ul>
                    </div>

                    <p><strong>Downstairs:</strong></p>

                    <div class="row">
                        <ul class="span8">
                            <li class="checked">
                                Main double bedroom with en suite bathroom.
                            </li>
                            <li class="checked">
                                Sliding doors opens to garden.
                            </li>
                            <li class="checked">
                                2 twin bedrooms.
                            </li>
                            <li class="checked">
                                Bathroom with shower.
                            </li>
                        </ul>
                    </div>

                    <p><strong>Upstairs:</strong></p>

                    <div class="row">
                        <ul class="span8">
                            <li class="checked">
                                Double bedroom with sunny balcony facing north.
                            </li>
                            <li class="checked">
                                Gorgeous mountain views.
                            </li>
                            <li class="checked">
                                Twin bedroom with balcony facing south.
                            </li>
                            <li class="checked">
                                Third bathroom.
                            </li>
                        </ul>

                    </div>

                    <h2>Map</h2>

                    <div id="property-map"></div><!-- /#property-map -->
                </div>

            </div>
            <div class="sidebar span3">
                <div class="widget contact">
                    <?= $contact_form; ?>
                </div><!-- /.widget -->
                <div class="widget properties last">
                    <?=$latest_prop;?>
                </div><!-- /.properties -->
            </div>
        </div>
    </div>
</div> <!-- /#container -->