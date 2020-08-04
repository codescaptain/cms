<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Yeni foto ekle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form id="dropzone" data-url="<?=base_url("product/refresh_image_list/$item->id")?>" action="<?=base_url("product/image_upload/$item->id")?>" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?=base_url("product/image_upload/$item->id")?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Drop files here or click to upload.</h3>
                        <p class="m-b-lg text-muted">(This is just a demo dropzone. Selected files are not actually uploaded.)</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>
<div class="row">
    <div class="col-md-12 ">
        <div class="widget p-lg image-list-container">


        <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v") ?>
            </div>

    </div><!-- END column -->
</div>