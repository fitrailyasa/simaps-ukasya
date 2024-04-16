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
    console.log(e);
});
window.Echo.channel("poin").listen(".hapus", (e) => {
    console.log(e);
});

window.Echo.channel("arena").listen(".ganti-babak", (e) => {
    console.log(e);
});
