import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

window.Echo.channel("verifikasi").listen(".verifikasi-pelanggaran", (e) => {
    $("#penaltyModal").modal("show");
    if (e.verifikasi_pelanggaran.status == false) {
        $("#pelanggaran").modal("hide");
        $("#penaltyModal").modal("hide");
    }
    console.log(e);
});

window.Echo.channel("verifikasi").listen(".verifikasi-jatuhan", (e) => {
    $("#verifyModal").modal("show");
    if (e.verifikasi_jatuhan.status == false) {
        $("#jatuhan").modal("hide");
        $("#verifyModal").modal("hide");
    }
    console.log(e);
});

window.Echo.channel("arena").listen(".ganti-gelanggang", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-peringatan", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".tambah-binaan", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".tambah-jatuhan", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".tambah-teguran", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-pukulan", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-tendangan", (e) => {
    let tendangan = e.eventSent;
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus", (e) => {
    console.log(e);
    if (!e.penilaian) {
        $(`#error-modal-${e.juri}`).modal("show");
    }
    console.log(e);
});
window.Echo.channel("poin").listen(".poin-masuk-keluar", (e) => {});

window.Echo.channel("poin").listen(".salah-gerakan-tunggal", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-skor-tunggal", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".penalty-tunggal", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus-penalty-tunggal", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tahap-tunggal", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tampil-tunggal", (e) => {
    console.log(e);
});

window.Echo.channel("arena").listen(".ganti-tahap-ganda", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tahap-regu", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tampil-regu", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tampil-ganda", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tahap-solo", (e) => {
    console.log(e);
});
window.Echo.channel("arena").listen(".ganti-tampil-solo", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".salah-gerakan-regu", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-skor-regu", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".penalty-regu", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus-penalty-regu", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-skor-ganda", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".penalty-ganda", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus-penalty-ganda", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".tambah-skor-solo", (e) => {
    console.log(e);
});

window.Echo.channel("poin").listen(".penalty-solo", (e) => {
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus-penalty-solo", (e) => {
    console.log(e);
});

window.Echo.channel("arena").listen(".ganti-babak", (e) => {
    console.log(e);
});

window.Echo.channel("arena").listen(".mulai-pertandingan", (e) => {
    console.log(e);
});
