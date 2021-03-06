<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title"><?= $items->title?> Adlı Ürünü Düzenliyorsunuz</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?= base_url("product/update/$items->id")?>" method="post">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" class="form-control" placeholder="Başlık" name="title" value="<?=$items->title?>">
                        <?php
                        if (isset($form_error)){?>
                            <smal class="pull-right" style="color: red;font-size: 12px;font-style: italic;font-weight: bold;"><?= form_error("title")?></smal>
                        <?php }?>

                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea class="m-0" name="description" data-plugin="summernote" data-options="{height: 250}"><?=$items->description?></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
                    <a href="<?php echo base_url("product") ?>" class="btn btn-outline btn-md btn-danger">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>