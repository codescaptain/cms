<header class="widget-header">
    <h4 class="widget-title"><b><?=$item->title?></b> Ürününün Fotoğrafları</h4>
</header><!-- .widget-header -->
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <th>#id</th>
        <th>Resim</th>
        <th>Resim Adı</th>
        <th>Durumu</th>
        <th>Kapak</th>
        <th>İşlem</th>
        </thead>

        <tbody>
        <?php foreach ($items as $image){?>
            <tr>
                <td class="w100 text-center"><?=$image->id?></td>
                <td class="w100"><img width="100" src="<?=base_url("uploads/$viewFolder/$image->img_url")?>" alt=""></td>
                <td>Resim adım</td>
                <td class="w100  text-center">
                    <input type="checkbox" data-switchery="true"
                           data-url="<?=base_url("product/isActiveSetter")?>"
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
                    <button data-url="<?=base_url("product/delete/$image->id")?>" class="btn btn-outline btn-sm btn-danger remove-btn btn-block"><i class="fa fa-trash"></i>
                        Sil</button>
                </td>
            </tr>

        <?php }?>
        </tbody>
    </table>

</div><!-- .widget-body -->