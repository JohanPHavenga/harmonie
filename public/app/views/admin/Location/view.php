
<div class="row">
    <div class="col-md-6">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-list font-dark"></i>
                    <span class="caption-subject bold uppercase"> List of Locations</span>
                </div>
            </div>
            <div class="portlet-body">

<?php
//    wts($location_data);
                if ( ! (empty($location_data)))
                {
                    // create table
                    $this->table->set_template(ftable('locations_table'));
                    $this->table->set_heading($heading);
                    foreach ($location_data as $id=>$data_entry) {
                        
                        $action_array=[
                                [
                                "url"=>"/admin/location/create/edit/".$data_entry['location_id'],
                                "text"=>"Edit",
                                "icon"=>"icon-pencil",
                                ],
                                [
                                "url"=>"/admin/location/delete/".$data_entry['location_id'],
                                "text"=>"Delete",
                                "icon"=>"icon-dislike",
                                "confirmation_text"=>"<b>Are you sure?</b>",
                                ],
                            ];
                        
        
                        $row['id']=$data_entry['location_id'];                  
                        $row['location_name']=$data_entry['location_name'];
                        $row['actions']= fbuttonActionGroup($action_array);
                        
                        $this->table->add_row(
                                $row['id'], 
                                $row['location_name'], 
                                $row['actions']
                                );
//                        $this->table->add_row($row);
                        unset($row);
                    }
                    echo $this->table->generate();

                }
                else
                {
                    echo "<p>No data to show</p>";
                }

                // add button
                if (@$create_link)
                {
                echo fbuttonLink($create_link."/add","Add Location","primary");
                }
                ?>
            
            </div>
        </div>
    </div>
</div>

