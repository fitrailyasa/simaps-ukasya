@extends('layouts.admin.bagan')

@section('title', 'Bagan TGR')

@section('table-bagan-tgr', 'active')

@section('style')
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/bagan/css/jquery.bracket-world.css') }}" rel="stylesheet">
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="d-flex justify-content-center align-items-center">
            <div class="form-group ml-0">
                <select name="golongan" id="golongan" class="form-select @error('golongan') is-invalid @enderror">
                    <option value="">-- Pilih Golongan --</option>
                    <option value="Usia Dini 1">Usia Dini 1</option>
                    <option value="Usia Dini 2">Usia Dini 2</option>
                    <option value="Pra Remaja">Pra Remaja</option>
                    <option value="Remaja">Remaja</option>
                    <option value="Dewasa">Dewasa</option>
                    <option value="Master">Master</option>
                </select>
            </div>
            <div class="form-group ml-2">
                <select name="jenis_kelamin" id="jenis_kelamin"
                    class="form-select @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L">Putra</option>
                    <option value="P">Putri</option>
                </select>
            </div>
            <div class="form-group ml-2">
                <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Tunggal">Tunggal</option>
                    <option value="Ganda">Ganda</option>
                    <option value="Regu">Regu</option>
                    <option value="Solo Kreatif">Solo Kreatif</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-3">
            <button type="submit" class="btn mx-1 btn-primary">Generate</button>
            <button type="button" class="btn mx-1 btn-success">Print</button>
        </div>
    </form>
    <div id="bracket2" class="bracket"></div>
@endsection

@section('script')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/bagan/js/jquery.bracket-world.min.js') }}"></script>
    <script>
        var minHeight = 0;
        $(document).ready(function() {
            setMainTitleHeight();

            minHeight = $('#main-title-content').height();
            $('#main-title-content').height(minHeight);

            $(window).resize(function() {
                setMainTitleHeight();
            });

            $('#bracket1').bracket();

            //$('#bracket1').bracket({teams:4});

            //$('#bracket1').bracket({teams:8, horizontal:0, scale:0.50, icons:false, bgcolor:'#ffffff', rectFill:'#000000'});

            $('#bracket2').bracket({
                teams: 11,
                topOffset: 50,
                scale: 0.45,
                horizontal: 0,
                height: '1000px',
                icons: true,
                teamNames: [{
                        name: 'Illinois',
                        seed: '6'
                    },
                    {
                        name: 'Iowa',
                        seed: '11'
                    },
                    {
                        name: 'Indiana',
                        seed: '5'
                    },
                    {
                        name: 'Penn State',
                        seed: '4'
                    },
                    {
                        name: 'Michigan State',
                        seed: '1'
                    },
                    {
                        name: 'Michigan',
                        seed: '10'
                    },
                    {
                        name: 'Ohio State',
                        seed: '7'
                    },
                    {
                        name: 'Wisconsin',
                        seed: '9'
                    },
                    {
                        name: 'Minnesota',
                        seed: '8'
                    },
                    {
                        name: 'Northwestern',
                        seed: '3'
                    },
                    {
                        name: 'Purdue',
                        seed: '2'
                    }
                ]
            });

            /*var theBracket = $('#bracket2').bracket({teams:6, height:'590px'});
            theBracket.data("bracket").setVertical().zoomIn(0.6).setTeams(
            [
                {
                    name:'Texas',
                    seed:'5'
                },
                {
                    name:'Kansas',
                    seed:'4'
                },
                {
                    name:'Kansas State',
                    seed:'1'
                },
                {
                    name:'Baylor',
                    seed:'6'
                },
                {
                    name:'Texas Tech',
                    seed:'3'
                },
                {
                    name:'TCU',
                    seed:'2'
                }
            ]);*/

            $('#bracket3, #bracket4').bracket({
                teams: 8
            });

            /*$('#bracket1').bracket({teamNames:[{name:'Stanford',seed:'1'}, {name:'California',seed:'2'}]});
            $('#bracket2').bracket({teams:64});*/

            //$('#bracket1, #bracket2').bracket({teams:64}).each(function(){$(this).data("bracket").zoomIn()});

            //$('#bracket1').bracket({teams:4, horizontal:0}).data("bracket").zoomIn(0.5, function(){$('#bracket2').bracket({horizontal:0, scale:0.5, teams:4}).data("bracket").setHorizontal(function(){alert('all done');});});
        });

        function setMainTitleHeight() {
            var windowHeight = $(window).height();
            if (windowHeight > minHeight) {
                $('#main-title').height(windowHeight);
                $('#main-title-content').css({
                    'margin-top': (($('#main-title').height() - $('#main-title-content').height()) / 2) + 'px'
                });
            } else $('#main-title').height(minHeight);
        }
    </script>
@endsection
