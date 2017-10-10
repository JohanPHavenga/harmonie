<div class="container">
    <div id="main">
        <div class="login">
            <h2 class="page-header">Admin Login</h2>
            
            
            <?php
            // alert message on top of the page
            // set flashdata [alert|status]
            if($this->session->flashdata('alert'))
            {
                $alert_msg=$this->session->flashdata('alert');
                if ( ! ($this->session->flashdata('status')))
                {
                    $status='warning';
                }
                else
                {
                    $status=$this->session->flashdata('status');
                }
                echo "<div class='alert alert-$status' role='alert'>$alert_msg</div>";
                // <div class="alert alert-danger" role="alert">
            }
              
            echo validation_errors();
            
            echo form_open($form_url);

            echo "<div class='control-group'>";
            echo form_label('Login', 'user_username');
            echo form_input([
                'name'          => 'user_username',
                'id'            => 'user_username',
                'class'         => 'form-control',
//                'placeholder'   => 'Username',
                'required'      => '',
                'autofocus'     => '',
            ]);
            echo "</div>";

            echo "<div class='control-group'>";
            echo form_label('Password', 'user_password');
            echo form_input([
                'name'          => 'user_password',
                'id'            => 'user_password',
                'class'         => 'form-control',
                'type'          => 'password',
//                'placeholder'   => 'Password',
                'required'      => '',
            ]);
            echo "</div>";
            echo fbutton("Sign in", "submit", "primary");
            echo form_close();
            ?>
        </div><!-- /.login -->
    </div>
</div>


