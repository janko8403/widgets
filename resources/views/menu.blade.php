@extends('layouts.frontend')

@section('content')
    <div class="main-container align-middle">
        @if ($isDone == 0)
        <div class="row justify-content-center">
            <div class="col-md-12">

                <img src="/img/logo.svg" class="mb-5 mx-auto d-block" width="90px">

                <div class="age-label" align="center">
                    <p>Weź udział w konkursie</p>
                    <p>
                        <b>"Praktyczny Minimalizm"</b>
                    </p>
                    <p>
                    i wygraj atrakcyjne nagrody
                    </p>
                </div>

                <hr>

                <div class="row">
                    <div class="col-6">
                        <img src="/img/nagroda_I.png" class="neon-small mx-auto d-block" id="nimg1" onclick="toggleImage(1)">
                    </div>
                    <div class="col-6">
                        <img src="/img/nagroda_II.png" class="neon-small mx-auto d-block" id="nimg2" onclick="toggleImage(2)">

                    </div>
                </div>

                <hr>

                <div class="text-center mb-4">
                    Karty podarunkowe MediaMarkt (5x 2000 zł & 10x 500 zł)<br>
                    Tuby neonowe x15
                </div>
                
            </div>
        </div>
        @endif
        @if ($isDone == 1)
            <div class="row justify-content-center mt-4">
                <div class="t-text text-center">
                    Dziękujemy za udział w konkursie<br>
                    <b>"Praktyczny minimalizm"</b>
                </div>
            </div>
        @endif
        @if ($isDone == 0)
        <div class="row justify-content-center mt-4" >
            <div class="iqbutton text-center" id="start">
                WEŹ UDZIAŁ
            </div>
        </div>
        @endif
    </div>

    <div class="iq-overlay" id="iq-overlay">
        <div class="close-overlay" onclick="closeImage()">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.163" height="26.163" viewBox="0 0 26.163 26.163">
                <g id="Group_32" data-name="Group 32" transform="translate(-310 -16)">
                    <rect id="Rectangle_14" data-name="Rectangle 14" width="35" height="2" transform="translate(310 40.749) rotate(-45)" fill="#fff"/>
                    <rect id="Rectangle_15" data-name="Rectangle 15" width="35" height="2" transform="translate(311.414 16) rotate(45)" fill="#fff"/>
                </g>
            </svg>
        </div>
        <div class="img1" id="img1" align="center">
            <p>Zestaw personalizowanych neonów</p>
            <img src="/img/nagroda_I_large.png" class="img2-s">
        </div>
        <div class="img2" id="img2" align="center">
            <p>Neonowe lampy</p>
            <img src="/img/nagroda_II_large.png" class="img2-s">
        </div>
    </div>


    @include('partials.footer')

    <script>

        function toggleImage(id)
        {
            $("#iq-overlay").show();
            $("#img"+id).show();
        }

        function closeImage()
        {
            $("#iq-overlay").hide();
            $("#img1").hide();
            $("#img2").hide();
        }

        $(document).ready(function() {
            $("#start").click(function () {
                $.ajax({
                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                    url: "{{ url('/getStart') }}",
                    type: 'GET',
                    cache: false,
                    datatype: 'html',
                    success: function(data) {
                        $("#content-container").html(data);
                    },
                    error: function(xhr,textStatus,thrownError) {
                        alert(xhr + "\n" + textStatus + "\n" + thrownError);
                    }
                });
            });
        });
    </script>
@endsection


