<div>
    @section('title')
        Tunggal
    @endsection
    @section('style')
        @vite('resources/js/layout.js')
    @endsection
    @include('dewan.tunggal.header')
    @include('dewan.tunggal.body')
    @include('dewan.tunggal.footer')
    @section('script')
        <script>
            setInterval(() => {
                @this.call('kurangiWaktu')
            }, 1600);
            // Ambil tombol fullscreen
            const fullscreenButton = document.getElementById('fullscreen-btn');
            const fullscreenIcon = fullscreenButton.querySelector('i');

            // Tambahkan event listener untuk tombol
            fullscreenButton.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    // Masuk ke mode fullscreen
                    document.documentElement.requestFullscreen().then(() => {
                        fullscreenIcon.classList.remove('fa-expand');
                        fullscreenIcon.classList.add('fa-compress');
                    }).catch((err) => {
                        console.error(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
                    });
                } else {
                    // Keluar dari mode fullscreen
                    if (document.exitFullscreen) {
                        document.exitFullscreen().then(() => {
                            fullscreenIcon.classList.remove('fa-compress');
                            fullscreenIcon.classList.add('fa-expand');
                        }).catch((err) => {
                            console.error(`Error attempting to exit fullscreen mode: ${err.message} (${err.name})`);
                        });
                    }
                }
            });
        </script>
    @endsection
</div>
