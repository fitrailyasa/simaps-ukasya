document.addEventListener("DOMContentLoaded", function () {
    // Mengambil ID dari elemen HTML
    let jadwalElement = document.getElementById("jadwal");
    let id = jadwalElement.getAttribute("data-id");

    window.Echo.private(`verifikasi-${id}`).listen(
        ".verifikasi-pelanggaran",
        (e) => {
            $("#penaltyModal").modal("show");
            if (e.verifikasi_pelanggaran.status == false) {
                $("#pelanggaran").modal("hide");
                $("#penaltyModal").modal("hide");
            }
            console.log(e);
        }
    );

    window.Echo.private(`verifikasi-${id}`).listen(
        ".verifikasi-jatuhan",
        (e) => {
            $("#verifyModal").modal("show");
            if (e.verifikasi_jatuhan.status == false) {
                $("#jatuhan").modal("hide");
                $("#verifyModal").modal("hide");
            }
            console.log(e);
        }
    );
});
