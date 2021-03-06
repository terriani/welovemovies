document.addEventListener('DOMContentLoaded', ()=>{
    $(".sidenav").sidenav();
    $(".slider").slider();
    $(".materialboxed").materialbox();
    $('.tabs').tabs();
    $('select').formSelect();
})

function isOnline(titleFailure, msgFailure, titleSuccess, msgSuccess){
   window.addEventListener('online', ()=>{
        iziToast.success({
            title: titleSuccess,
            message: msgSuccess,
            position: "topRight"

        });
    })
    window.addEventListener('offline', ()=>{
        iziToast.error({
            title: titleFailure,
            message: msgFailure,
            position: "topRight"
        });
    })
}
