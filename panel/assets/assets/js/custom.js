$(document).ready(function () {
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

          });
        }



    });

});