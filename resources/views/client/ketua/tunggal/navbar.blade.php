<div class="">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #89a0c4;box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);
    -webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{url('assets/img/ipsi.png')}}" alt="" width="75" height="75">
            </a>
              <a class="navbar-brand text-center" href="#" style="color:#fff; width:60%;margin-top: -12px">
                <div class="nav-up" style="background-image:url('{{url('/assets/img/bg2.png')}}'); background-size: 100% 115%; background-repeat: no-repeat; background-position:top center;height:50px;">
                    <h5 style="font-size: 2rem;font-weight: 700" class="pt-2 fw-bold">PENCAK SILAT</h5>
                </div>
                <div class="nav-down mt-2 order">
                    <h5 style="font-size: 1.5rem;font-weight: 700" class="fw-bold">{{$gelanggang->nama}} - Partai {{$jadwal->partai}} {{$jadwal->babak}} - {{$tampil['kategori']}} - {{$tampil['golongan']}}</h5>
                </div>
              </a>
              <a class="navbar-brand" href="#">
                <img src="{{url('assets/img/ipsi.png')}}" alt="" width="75" height="75">
              </a>
        </div>
      </nav>
</div>