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
            <?php echo form_open() ?>
                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <?php echo form_input('title', null, ['class' => 'form-control', 'id' => 'title']) ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="url">Url</label>
                    <?php echo form_input('url', null, ['class' => 'form-control', 'id' => 'url']) ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="content">Content</label>
                    <?php echo form_textarea('content', null, ['class' => 'form-control', 'id' => 'content']); ?>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('/templates/footer') ?>