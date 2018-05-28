
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-list font-dark"></i>
                    <span class="caption-subject bold uppercase"> List of Properties</span>
                </div>
            </div>
            <div class="portlet-body">

            <?php
                if ( ! (empty($property_data)))
                {
                    // create table
                    $this->table->set_template(ftable('properties_table'));
                    $this->table->set_heading(
//                            ["ID","Property Code","Status","Rate High","Rate Low","Sleeps","Bath","Beds","Property Type","Location","Created","Actions"]
                            ["ID","Property Code","Status","Property Type","Location","Created","Actions"]
                            );
                    foreach ($property_data as $id=>$data_entry) {
                        
                        $edit_uri="/admin/property/create/edit/".$data_entry['property_id'];
                        $action_array=[
                                [
                                "url"=>$edit_uri,
                                "text"=>"Edit",
                                "icon"=>"icon-pencil",
                                ],
                                [
                                "url"=>"/admin/property/delete/".$data_entry['property_id'],
                                "text"=>"Delete",
                                "icon"=>"icon-dislike",
                                "confirmation_text"=>"<b>Are you sure?</b>",
                                ],
                            ];
                        
        
//                        $row['id']=$data_entry['type_id'];                  
//                        $row['property_code']=$data_entry['property_code'];
//                        $row['actions']= fbuttonActionGroup($action_array);
                        
                        if ($data_entry['property_isfeatured']) 
                        {
                            $data_entry['property_code_search']=flableFeatured($data_entry['property_code_search']);
                        }
                        
                        
                        $this->table->add_row(
                                    $data_entry['property_id'],
                                    "<a href='$edit_uri' title='".strip_tags($data_entry['property_address'])."'>".$data_entry['property_code_search']."</a>", 
                                    flableStatus($data_entry['property_ispublished']),
//                                    fdisplayCurrency($data_entry['property_rate_high']), 
//                                    fdisplayCurrency($data_entry['property_rate_low']), 
//                                    $data_entry['property_sleeps'], 
//                                    $data_entry['property_bathrooms'], 
//                                    $data_entry['property_bedrooms'], 
                                    $data_entry['type_name'], 
                                    $data_entry['location_name'], 
                                    date("Y-m-d", strtotime($data_entry['created_date'])), 
                                    fbuttonActionGroup($action_array)                                   
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
                echo fbuttonLink($create_link."/add","Add Property","primary");
                }
                ?>
            
            </div>
        </div>
    </div>
</div>

