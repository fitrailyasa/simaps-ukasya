<div class="dewan-tanding-body" style="width: 100%">
    <div class="dewan-tanding-body-header d-flex" style="width: 100%">
        <div class="kontingen-biru" style="width: 50%">
            <h4 class="fw-bold" style="color: #252c94">
                {{$sudut_biru->nama}}
            </h4>
        </div>
        {{-- <div class="{{$mulai == true ? "mulai" : ""}} waktu text-center d-flex flex-column justify-content-center" style="width: 20%">
                <h2 class="fw-bold">{{ sprintf("%02d:%02d", floor($waktu), ($waktu*60)%60) }}</h2>
        </div> --}}
        <div class="kontingen-merah text-right" style="width: 50%">
            <h4 class="fw-bold" style="color: #db3545">
                {{$sudut_merah->nama}}
            </h4>
        </div>
    </div>
    <div class="dewan-tanding-body-content d-flex">
        <div class="pesilat-a d-flex " style="width: 45%; height: 100%;">
            <div class="peringatan" style="width: 23%">
                <div class="peringatan-header border border-dark text-center" style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Peringatan</h5>
                </div>
                <div class="peringatan-content " style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="peringatan-babak-{{$i}} border border-dark text-end" style="min-height:42px;" >
                            @if (1 == $i)
                           @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'peringatan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if (($penilaian->babak == 1 || $penilaian->babak == 2) && $penilaian->jenis == 'peringatan' && ($jadwal->babak_tanding == 3 || $jadwal->babak_tanding == 2))
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if (($penilaian->babak == 3 || $penilaian->babak == 1 || $penilaian->babak == 2) && $penilaian->jenis == 'peringatan' && ($jadwal->babak_tanding == 3))
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            <div class="teguran" style="width: 23%">
                <div class="teguran-header border border-dark text-center" style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Teguran</h5>
                </div>
                <div class="teguran-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="teguran-babak-{{$i}} border border-dark text-end" style="min-height:42px" >
                            @if (1 == $i)
                           @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'teguran')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'teguran')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'teguran')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            <div class="binaan" style="width: 23%">
                <div class="binaan-header border border-dark text-center" style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Binaan</h5>
                </div>
                <div class="binaan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="binaan-babak-{{$i}} border border-dark text-end" style="min-height:42px" >
                           @if (1 == $i)
                           @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'binaan')
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'binaan')
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'binaan')
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            <div class="jatuhan" style="width: 31%">
                <div class="jatuhan-header border border-dark text-center" style="background-color: #0053a6">
                    <h5 class="fw-bold p-1 text-white">Jatuhan</h5>
                </div>
                  <div class="jatuhan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="jatuhan-babak-{{$i}} border border-dark text-end" style="min-height:42px" >
                           @if (1 == $i)
                           @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_biru as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div class="babak" style="width: 10%">
            <div class="babak-container text-center">
                <div class="babak-header border border-dark" style="">
                    <h5 class="fw-bold p-1 ">Babak</h5>
                </div>
                <div class="babak-content">
                    <div class="babak-1 text-center border border-dark {{ $jadwal->babak_tanding == 1 ? 'babak-active' : '' }}">
                        <img src={{url('/assets/svg/romawi-1.svg')}} height="40" width="40">
                    </div>
                    <div class="babak-2 text-center border border-dark {{ $jadwal->babak_tanding == 2 ? 'babak-active' : '' }}">
                        <img src={{url('/assets/svg/romawi-2.svg')}} height="40" width="40">
                    </div>
                    <div class="babak-3 text-center border border-dark {{ $jadwal->babak_tanding == 3 ? 'babak-active' : '' }}">
                        <img src={{url('/assets/svg/romawi-3.svg')}} height="40" width="40">
                    </div>
                </div>
            </div>
        </div>
        <div class="pesilat-b d-flex" style="width: 45%">
            <div class="jatuhan" style="width: 31%">
                <div class="jatuhan-header border border-dark text-center bg-danger" >
                    <h5 class="fw-bold p-1 text-white">Jatuhan</h5>
                </div>
                  <div class="jatuhan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="jatuhan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            @if (1 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 jatuhan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'jatuhan')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            <div class="binaan" style="width: 23%">
                <div class="binaan-header border border-dark text-center bg-danger" >
                    <h5 class="fw-bold p-1 text-white">Binaan</h5>
                </div>
                <div class="binaan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="binaan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            @if (1 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_merah ?? null as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'binaan')
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'binaan')
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 binaan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'binaan')                                       
                                        @if ($penilaian ?? null)
                                            {{$penilaian->dewan !== null ? $penilaian->dewan:""}}
                                        @endif
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
             <div class="teguran" style="width: 23%">
                <div class="teguran-header border border-dark text-center bg-danger"  >
                    <h5 class="fw-bold p-1 text-white">Teguran</h5>
                </div>
                <div class="teguran-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="teguran-babak-{{$i}} border border-dark" style="min-height:42px" >
                           @if (1 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'teguran')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 2 && $penilaian->jenis == 'teguran')
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 teguran-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 3 && $penilaian->jenis == 'teguran')
                                        {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
            <div class="peringatan" style="width: 23%">
                <div class="peringatan-header border border-dark text-center bg-danger" >
                    <h5 class="fw-bold p-1 text-white">Peringatan</h5>
                </div> 
                <div class="peringatan-content" style="height: 75%">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="peringatan-babak-{{$i}} border border-dark" style="min-height:42px" >
                            @if (1 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if ($penilaian->babak == 1 && $penilaian->jenis == 'peringatan')      
                                        {{$penilaian->dewan}}
                                    @endif
                                @endforeach
                             </h5>  
                             </h5>
                            @elseif(2 == $i)
                            @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if (( $penilaian->babak == 1 || $penilaian->babak == 2) && $penilaian->jenis == 'peringatan' && ($jadwal->babak_tanding == 3 || $jadwal->babak_tanding == 2))
                                        {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>  
                             @elseif(3 == $i)
                             @php
                               $nilai = 0
                            @endphp
                             <h5 class="fw-bold p-1 peringatan-{{$i}}">
                                @foreach ($penilaian_tanding_merah as $penilaian)
                                    @if (($penilaian->babak == 3 || $penilaian->babak == 1 || $penilaian->babak == 2) && $penilaian->jenis == 'peringatan' && ($jadwal->babak_tanding == 3))
                                    {{$penilaian->dewan}}                                        
                                    @endif
                                @endforeach
                             </h5>    
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
<div wire:ignore.self class="modal fade" id="error-modal-dewan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        {{$error}}
      </div>
      <div class="modal-footer">
        <button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>

@section('script')
    <script>
        setInterval(() => {
            if(@this.get('mulai') == true){
                @this.call('kurangiWaktu')
            }
                
            if(@this.get('error').length > 0){
                $(`#error-modal-dewan`).modal("show");
                $('#close').on('click', () => {
                    @this.set('error', "")
                })

            };
        }, 1000);
    </script>
@endsection