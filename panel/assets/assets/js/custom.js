$(document).ready(function () {
    $(".sortable").sortable();
    $(".remove-btn").click(function () {
        var data_url=$(this).data("url")
        Swal.fire({
            title: 'Emin Misiniz?',
            text: "Sildikten sonra veri kaybolacaktır!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet,Sİl!',
            cancelButtonText: 'Hayır!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'İşlem Başarılı!',
                    'Veri Silindi',
                    'success'
                ).then(()=>{
                    window.location.href=data_url;
                })


            }
        })

    })
    $(".isActive").change(function () {
        let $data=$(this).prop("checked");
        let $data_url=$(this).data("url");

        if (typeof $data !=="undefined" && typeof $data_url !=="undefined"){
            // ----- Ajax ile -----
           // $.ajax({
           //     url:$data_url,
           //     data: {data:$data},
           //     type:"POST",
           //     success: (data)=> {
           //       alert(data);
           //     }
           //
           // })
            // ---- Jquery POst ile ----
          $.post($data_url,{data:$data},(response)=>{

              Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Aktif İşlemi Başarılı',
                  showConfirmButton: false,
                  timer: 1500
              })

          });
        }



    });
    $(".sortable").on("sortupdate",function (event,ui) {
        let $data_url=$(this).data("url");
        let $data=$(this).sortable("serialize");
        $.post($data_url,{data:$data},(res)=>{
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Sıralama Başarılı',
                showConfirmButton: false,
                timer: 1500
            })
        })

    })

});