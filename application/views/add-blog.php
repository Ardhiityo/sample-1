<?php $this->load->view('/templates/header') ?>

<header class="masthead" style="background-image: url('/assets/img/post-bg.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1 class="text-center">Add Post</h1>
                    <span class="meta text-center">
                        Make your creativity
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container py-5">
    <div class="row flex justify-content-center">
        <div class="col-8 ">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input class="form-control" type="text" name="title">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="url">Url</label>
                    <input class="form-control" type="text" name="url">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="content">Content</label>
                    <textarea name="content" class="form-control" id="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('/templates/footer') ?>