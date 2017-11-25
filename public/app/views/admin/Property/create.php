<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-edit font-dark"></i>
                    <span class="caption-subject font-dark bold uppercase"><?= ucfirst($action);?> entry</span>
                </div>
            </div>
            <div class="portlet-body">
            <?php 
                echo validation_errors(); 

                echo form_open($form_url); 

                // Property
                echo '<div class="row"><div class="col-md-6">';
                echo "<div class='form-group'>";
                echo form_label('Property Code  <span class="compulsary">*</span>', 'property_code');
                echo form_input([
                        'name'          => 'property_code',
                        'id'            => 'property_code',
                        'value'         => set_value('property_code', @$property_detail['property_code']),
                        'class'         => 'form-control',
                        'required'      => '',
                    ]);

                echo '</div>';
                echo "</div></div>";        
                
                 //  Location
                echo "<div class='form-group'>";
                echo form_label('Location <span class="compulsary">*</span>', 'location_id');
                echo form_dropdown('location_id', $location_dropdown, @$property_detail['location_id'], ["id"=>"location_id","class"=>"form-control input-xlarge"]);        
                echo "</div>";                
                
                 //  Property Type
                echo "<div class='form-group'>";
                echo form_label('Property Type <span class="compulsary">*</span>', 'type_id');
                echo form_dropdown('type_id', $type_dropdown, @$property_detail['type_id'], ["id"=>"type_id","class"=>"form-control input-xlarge"]);        
                echo "</div>";
                

                echo "<div class='btn-group'>";
                echo fbutton("Submit","submit","primary");
                echo fbuttonLink($return_url,"Cancel");
                echo "</div>";

                echo form_close();

            //    wts($user_detail);
            ?>
            </div>
        </div>
    </div>
</div>