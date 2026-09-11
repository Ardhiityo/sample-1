<?php $this->load->view('/templates/header') ?>

<header class="masthead" style="background-image: url('/assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1 class="text-center">Login</h1>
                    <span class="meta text-center">
                        Login to your account
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container py-5">
    <div class="row flex justify-content-center">
        <div class="col-8 ">
            <?php
            if ($this->session->flashdata('error')) {
                echo
                    '<div class="alert alert-danger">'.
                    $this->session->flashdata('error')
                    .'</div>';
            }
            echo validation_errors() ? '<div class="alert alert-warning">'.validation_errors().'</div>' : null;
            ?>
            <?php echo form_open() ?>
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <?php echo form_input('username', set_value('username'), ['class' => 'form-control', 'id' => 'username']) ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <?php echo form_password('password', set_value('password'), ['class' => 'form-control', 'id' => 'password']) ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('/templates/footer') ?>