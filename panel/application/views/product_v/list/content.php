<div class="row">
    <div class="col-md-12">
        <div class="widget p-lg">
            <h4 class="m-b-lg">Liste
                <a href="<?= base_url("product/new_form")?>" class="btn pull-right btn-xs btn-outline btn-primary"><i class="fa fa-plus"></i>Yeni
                    Ekle</a>
            </h4>
            <?php
            if (empty($items)) {
                ?>
                <div class="alert alert-info alert-dismissible text-center">
                    <h5 class="alert-title">Kayıt Bulunamadı</h5>
                    <p>Yeni ürün eklemek için <a href="#">Tıklayın</a></p>
                </div>

            <?php } else {
                ?>
                <table class="table table-hover table-striped">
                    <thead>
                    <th><i class="fa fa-list"></i></th>
                    <th>#id</th>
                    <th>url</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Durumu</th>
                    <th>İşlem</th>
                    </thead>
                    <tbody class="sortable" data-url="<?=base_url("product/rankSetter")?>">
                    <?php foreach ($items as $item): ?>
                        <tr id="ord-<?php echo $item->id ?>">
                            <td style="cursor: grabbing;"><i class="fa fa-list"></i></td>
                            <td><?= $item->id ?></td>
                            <td><?= $item->url ?></td>
                            <td><?= $item->title ?></td>
                            <td><?= $item->description ?></td>
                            <td>

                                <input type="checkbox" data-switchery="true"
                                       data-url="<?=base_url("product/isActiveSetter/$item->id")?>"
                                       class="isActive"
                                       data-color="#10c469"
                                       <?php echo ($item->isActive) ? "checked": ""?>
                                       style="display: none;">

                            </td>
                            <td><button data-url="<?=base_url("product/delete/$item->id")?>" class="btn btn-outline btn-sm btn-danger remove-btn"><i class="fa fa-trash"></i>
                                    Sil</button>
                                <a href="<?=base_url("product/update_form/$item->id")?>" class="btn btn-outline btn-sm btn-info"><i class="fa fa-pencil"></i>
                                   Düzenle</a>
                            </td>


                        </tr>
                    <?php endforeach; ?>


                    </tbody>

                </table>

            <?php }

            ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>