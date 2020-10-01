<header class="widget-header">
    <h4 class="widget-title"><b><?=$item->title?></b> Ürününün Fotoğrafları</h4>
</header><!-- .widget-header -->
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <th><i class="fa fa-list"></i></th>
        <th>#id</th>
        <th>Resim</th>
        <th>Resim Adı</th>
        <th>Durumu</th>
        <th>Kapak</th>
        <th>İşlem</th>
        </thead>

        <tbody class="sortable" data-url="<?=base_url("product/imageRankSetter")?>">
        <?php foreach ($items as $image){?>
            <tr id="ord-<?php echo $image->id ?>">
                <td style="cursor: grabbing;"><i class="fa fa-list"></i></td>
                <td class="w100 text-center"><?=$image->id?></td>
                <td class="w100"><img width="100" src="<?=base_url("uploads/$viewFolder/$image->img_url")?>" alt=""></td>
                <td><?=$image->img_url?></td>
                <td class="w100  text-center">
                    <input type="checkbox" data-switchery="true"
                           data-url="<?=base_url("product/imageIsActiveSetter/$image->id")?>"
                        <?php echo ($image->isActive)==1 ? "checked":"" ?>
                           class="isActive"
                           data-color="#10c469"

                           style="display: none;">

                </td>
                <td class="w100 text-center">
                    <input type="checkbox" data-switchery="true"
                           data-url="<?=base_url("product/isCoverSetter/$image->id/$image->product_id")?>"
                        <?php echo ($image->isCover)==1 ? "checked":"" ?>
                           class="isCover"
                           data-color="#f15156"
                           style="display: none;">
                </td>
                <td class="w100">
                    <button data-url="<?=base_url("product/imageDelete/$image->id/$image->product_id")?>" class="btn btn-outline btn-sm btn-danger remove-btn btn-block"><i class="fa fa-trash"></i>
                        Sil</button>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>

</div><!-- .widget-body -->