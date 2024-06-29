<div>
    @section('title')
        Solo
    @endsection
    @include('dewan.solo.header')
    @include('dewan.solo.body')
    @include('dewan.solo.footer')
    @section('style')
        @vite('resources/js/layout.js')
    @endsection
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
