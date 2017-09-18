<div class="container">

    <div id="main">
        <div class="row">
            <div class="span9">
                <h1 class="page-header">Rental properties | <?=ucfirst($filter['property_type']);?></h1>
                <div class="properties-rows">
                    <div class="filter">
                        <form action="?" method="get" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label" for="inputSortBy">
                                    Sort by
                                    <span class="form-required" title="This field is required.">*</span>
                                </label>
                                <div class="controls">
                                    <select id="inputSortBy">
                                        <option id="price">Price</option>
                                        <option id="published">Beds</option>
                                        <option id="sleeps">Sleeps</option>
                                    </select>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="control-group">
                                <label class="control-label" for="inputOrder">
                                    Order
                                    <span class="form-required" title="This field is required.">*</span>
                                </label>
                                <div class="controls">
                                    <select id="inputOrder">
                                        <option id="asc">ASC</option>
                                        <option id="desc">DESC</option>
                                    </select>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->
                        </form>
                    </div><!-- /.filter -->
                </div><!-- /.properties-rows -->

                <div class="properties-grid">
                    <div class="row">
                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-1.png" alt="">
                                </div><!-- /.content -->

                                <div class="price">R 1 800</div><!-- /.price -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">16 4th Street</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Voëlklip, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">10</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">5</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-2.png" alt="">
                                </div><!-- /.content -->
                                <div class="price">R 1 800</div><!-- /.price -->
                                <div class="reduced">Special Offer </div><!-- /.reduced -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">163 Main Road</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Kwaaiwater, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">8</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">4</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-3.png" alt="">
                                </div><!-- /.content -->

                                <div class="price">R 2 400</div><!-- /.price -->
                                <div class="reduced">Special Offer </div><!-- /.reduced -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">20 Piet Retief</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Sandbaai, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">6</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">2</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">1</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-4.png" alt="">
                                </div><!-- /.content -->
                                <div class="price">R 1 200</div><!-- /.price -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">30 Duiker Street</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Northcliff, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">8</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">3</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">3</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-5.png" alt="">
                                </div><!-- /.content -->

                                <div class="price">R 1 950</div><!-- /.price -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">110 10th Street</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Voëlklip, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">10</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">5</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">4</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->

                        <div class="property span3">
                            <div class="image">
                                <div class="content">
                                    <a href="detail.html"></a>
                                    <img src="<?= base_url();?>assets/img/tmp/property-small-6.png" alt="">
                                </div><!-- /.content -->

                                <div class="price">R 9 200</div><!-- /.price -->
                                <div class="reduced">Special Offer </div><!-- /.reduced -->
                            </div><!-- /.image -->

                            <div class="title">
                                <h2><a href="detail.html">20 Mason Street</a></h2>
                            </div><!-- /.title -->

                            <div class="location">Eastcliff, Hermanus</div><!-- /.location -->
                            <div class="area">
                                <span class="key">Sleeps:</span><!-- /.key -->
                                <span class="value">12</span><!-- /.value -->
                            </div><!-- /.area -->
                            <div class="bedrooms"><div class="content">6</div></div><!-- /.bedrooms -->
                            <div class="bathrooms"><div class="content">4</div></div><!-- /.bathrooms -->
                        </div><!-- /.property -->
                    </div><!-- /.row -->
                </div><!-- /.properties-grid -->

                <div class="pagination pagination-centered">
                    <ul>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">next</a></li>
                        <li><a href="#">last</a></li>
                    </ul>
                </div><!-- /.pagination -->            </div>
            <div class="sidebar span3">
                <h2>Property filter</h2>
                <div class="property-filter widget">
                    <div class="content">
                        <form method="get" action="?">
                            <div class="location control-group">
                                <label class="control-label" for="inputLocation">
                                    Location
                                </label>
                                <div class="controls">
                                    <select id="inputLocation">
                                        <option id="all">All of Hermanus</option>
                                        <option id="">Eastcliff</option>
                                        <option id="">Fernkloof</option>
                                        <option id="">Hemel-en-Aarde</option>
                                        <option id="">Hermanus Central</option>
                                        <option id="">Hermanus Heights</option>
                                        <option id="">Kwaaiwater</option>
                                        <option id="">Northcliff</option>
                                        <option id="">Sandbaai</option>
                                        <option id="">Voëlklip</option>
                                        <option id="">Westcliff</option>
                                    </select>
                                </div> <!-- /.controls -->
                            </div> <!-- /.control-group -->

                            <div class="type control-group">
                                <label class="control-label" for="inputType">
                                    Type
                                </label>
                                <div class="controls">
                                    <select id="inputType">
                                        <option id="house">House</option>
                                        <option id="apartment">Apartment</option>
                                    </select>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="beds control-group">
                                <label class="control-label" for="inputBeds">
                                    Beds
                                </label>
                                <div class="controls">
                                    <select id="inputBeds">
                                        <option id="11">1</option>
                                        <option id="12">2</option>
                                        <option id="13">3</option>
                                        <option id="14" selected>4</option>
                                        <option id="15">5+</option>
                                    </select>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="baths control-group">
                                <label class="control-label" for="inputBaths">
                                    Sleeps
                                </label>
                                <div class="controls">
                                    <select id="inputBaths">
                                        <option id="22">2</option>
                                        <option id="24">4</option>
                                        <option id="26">6</option>
                                        <option id="28" selected>8</option>
                                        <option id="20">10</option>
                                        <option id="21">12</option>
                                    </select>
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->


                            <div class="price-from control-group">
                                <label class="control-label" for="inputPriceFrom">
                                    Price from
                                </label>
                                <div class="controls">
                                    <input type="text" id="inputPriceFrom" name="inputPriceFrom">
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="price-to control-group">
                                <label class="control-label" for="inputPriceTo">
                                    Price to
                                </label>
                                <div class="controls">
                                    <input type="text" id="inputPriceTo" name="inputPriceTo">
                                </div><!-- /.controls -->
                            </div><!-- /.control-group -->

                            <div class="price-value">
                                <span class="from"></span><!-- /.from -->
                                -
                                <span class="to"></span><!-- /.to -->
                            </div><!-- /.price-value -->

                            <div class="price-slider">
                            </div><!-- /.price-slider -->

                            <div class="form-actions">
                                <input type="submit" value="Filter now!" class="btn btn-primary btn-large">
                            </div><!-- /.form-actions -->
                        </form>
                    </div><!-- /.content -->
                </div><!-- /.property-filter -->

            </div>
        </div>
    </div>
</div>
