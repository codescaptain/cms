<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Yeni foto ekle</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="../api/dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
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
    <div class="col-md-12">

        <div class="widget p-lg">

            <table class="table table-hover table-striped">
                <thead>
                <th>#id</th>
                <th>Resim</th>
                <th>Resim Adı</th>
                <th>Durumu</th>
                <th>İşlem</th>
                </thead>
                <tbody>
                <tr>
                    <td>#1</td>
                    <td><img width="100" src="https://siberci.com/wp-content/uploads/2020/07/en-iyi-11-ide-visual-studio-code-1024x379.png" alt=""></td>
                    <td>Resim adım</td>
                    <td>
                        <input type="checkbox" data-switchery="true"
                               data-url="<?=base_url("product/isActiveSetter")?>"
                               class="isActive"
                               data-color="#10c469"

                               style="display: none;">
                    </td>
                    <td>
                        <button data-url="<?=base_url("product/delete")?>" class="btn btn-outline btn-sm btn-danger remove-btn"><i class="fa fa-trash"></i>
                            Sil</button>
                    </td>
                </tr>
                </tbody>
            </table>

            </div><!-- .widget-body -->

    </div><!-- END column -->
</div>