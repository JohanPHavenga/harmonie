                
        </div><!-- /#content -->
    </div><!-- /#wrapper-inner -->

<!-- FOOTER -->
<div id="footer-wrapper">
    <div id="footer-top">
        <div id="footer-top-inner" class="container">
            <div class="row">
                <div class="widget properties span3">
                    <?=$latest_prop;?>
                </div><!-- /.properties-small -->

                <div class="widget span3">
                    <div class="title">
                        <h2>Contact us</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <table class="contact">
                            <tbody>
                                <tr>
                                    <th class="address">Address:</th>
                                    <td>19 Bird Lane<br>Northcliff<br> Hermanus 7200<br>South Africa<br></td>
                                </tr>
                                <tr>
                                    <th class="phone">Phone:</th>
                                    <td>+27 (0)71 505 9201</td>
                                </tr>
                                <tr>
                                    <th class="email">E-mail:</th>
                                    <td><a href="mailto:info@harmonieprop.co.zas">info@harmonieprop.co.za</a></td>
                                </tr>
                                <tr>
                                    <th class="gps">GPS:</th>
                                    <td><a href="https://www.google.co.za/maps/search/-34.418073,+19.235384?sa=X&ved=0ahUKEwje49-8uq_WAhUoI8AKHVRGDUgQ8gEIIzAA" target="_blank">-34.418073, 19.235384</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span3">
                    <div class="title">
                        <h2 class="block-title">Useful links</h2>
                    </div><!-- /.title -->

                    <div class="content">
                        <ul class="menu nav">
                            <li class="first leaf"><a href="<?=base_url();?>">Home</a></li>
                            <li class="leaf"><a href="<?=base_url('about');?>">About us</a></li>
                            <li class="leaf"><a href="<?=base_url('contact');?>">Contact us</a></li>
                            <li class="last leaf"><a href="<?=base_url('faq');?>">FAQ</a></li>
                        </ul>
                    </div><!-- /.content -->
                </div><!-- /.widget -->

                <div class="widget span3">
                    <?= $contact_form; ?>
                </div><!-- /.widget -->
            </div><!-- /.row -->
        </div><!-- /#footer-top-inner -->
    </div><!-- /#footer-top -->

    <div id="footer" class="footer container">
        <div id="footer-inner">
            <div class="row">
                <div class="span6 copyright">
                    <p>© Copyright <?= date("Y");?> by <a href="<?=base_url();?>">Harmonie Property Services</a>. All rights reserved. <br><a href="<?=base_url("login/admin");?>">Admin Login</a></p>
                </div><!-- /.copyright -->

                <div class="span6 share">
                    <div class="content">
                        <ul class="menu nav">
                            <li class="first leaf"><a href="http://www.facebook.com/harmoniepropertieshermanus/" class="facebook">Facebook</a></li>
                        </ul>
                    </div><!-- /.content -->
                </div><!-- /.span6 -->
            </div><!-- /.row -->
        </div><!-- /#footer-inner -->
    </div><!-- /#footer -->
</div><!-- /#footer-wrapper -->

</div><!-- /#wrapper -->
</div><!-- /#wrapper-outer -->


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3&amp;sensor=true"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.ezmark.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.currency.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/jquery.cookie.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/retina.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/carousel.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/gmap3.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/gmap3.infobox.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/chosen/chosen.jquery.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/iosslider/_src/jquery.iosslider.min.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/libraries/bootstrap-fileupload/bootstrap-fileupload.js');?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/realia.js');?>"></script>
</body>
</html>
