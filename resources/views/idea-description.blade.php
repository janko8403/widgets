<a href="/"><div class="backbutton" id="back1"></div></a>
<div class="backbutton" id="idea-back" style="display:none"></div>
<div class="main-container align-middle">
    <div id="idea1">
        <div class="row justify-content-center mb-5">
            <div class="col-md-12">

                <img src="/img/logo.svg" class="mb-5 mx-auto d-block" width="90px">

                <div class="t-text text-center">
                    <p class="p1">Zadanie konkursowe:</p>

                    Opisz pomysł, który symbolizuje według Ciebie <b>praktyczny minimalizm</b> - może to być istniejący produkt lub nowy kreatywny pomysł na coś innowacyjnego
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="t-text text-center">
                    <textarea class="idea-description" onfocus="if ($(this).val()=='Tu opisz swój pomysł...') $(this).val('')" id="idea_description" name="idea_description" >Tu opisz swój pomysł...</textarea>
                </div>
            </div>
        </div>
        <div class="row" align="right">
            <div id="counter" class="letter-counter">0/400</div>
        </div>

        <div class="row justify-content-center mt-4" >
            <div class="iqbutton text-center iqnext" id="user">
                DALEJ
            </div>
        </div>
    </div>
    <div id="idea2" style="display:none">
        <div class="main-container align-middle">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <img src="/img/logo.svg" class="mb-5 mx-auto d-block"  width="90px">

                    <div class="mb-2 h-s">
                        Podaj nam swoje dane, wyraź zgody na ich przetwarzanie oraz zatwierdź zgłoszenie konkursowe.
                        <div class="mb-2 h-s-l">
                            Pamiętaj, że w chwili przystąpienia do Konkursu, musisz być zarejestrowany w konsumenckiej bazie danych Philip Morris i posiadać zarejestrowane urządzenie lil SOLID 2.0. W razie pytań, prosimy o kontakt pod numerem infolinii 801 801 501 lub 22 455 14 04**
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-ad">
                <input type="text" placeholder="Imię i nazwisko" id="name" name="name">
            </div>
            <div class="row justify-content-center mt-ad">
                <input type="text" placeholder="Adres email" id="email" name="email">
            </div>
            <div class="row justify-content-center mt-ad">
                <input type="text" placeholder="Nr telefonu" name="phone" id="phone">
            </div>
        </div>

        <div class="main-container align-middle">
            <div class="row justify-content-center mt-ad">
                <div class="col-12" id="agr1-c">
                    <input type="checkbox" name="agr1" id="agr1" class="me-2">
                    Oświadczam, że znam i akceptuję <span class="regLink" id="reg">Regulamin</span> Programu "Praktyczny Minimalizm" i <a href="https://www.pmiprivacy.com/poland/pl/business-partner/" class="regLink" target="_blank">Politykę Prywatności*</a>
                </div>

                <div class="col-12" id="agr2-c">
                    <input type="checkbox" name="agr2" id="agr2" class="me-2">
                    Wyrażam zgodę na przekazywanie mi przez Philip Morris Polska Distribution Sp. z o.o. z siedzibą w Krakowie (PMPL-D) informacji dotyczących mojego udziału w Programie "Praktyczny Minimalizm" na adres email oraz na mój numer telefonu z wykorzystaniem e-mail oraz SMS*
                </div>
                <div class="col-12 mt-1">
                    * wymagane zgody
                </div>
                <div class="col-12 mt-1">
                    ** Koszt połączenia zgodny ze stawką Twojego operatora. Jesteśmy dostępni w godzinach 8-22, również w weekendy. Informacje na temat dostępności w święta i dni wolne znajdziesz na Facebooku IQOS Polska.
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4" >
            <div class="iqbutton text-center iqsend" id="final">
                WYŚLIJ ZGŁOSZENIE
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

<div class="iq-overlay" id="iq-overlay">
        <div class="backbutton-modal" id="idea-back" onclick='closeModal()'"></div>
    <div id="reg-content" class="reg"></div>
</div>

<script>
    function validateEmail(email)
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function validatePhone(p) {
        var phoneRe = /^\+?([0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/;
        var phoneReNoArea = /^([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/;
        v1 = phoneRe.test(p);
        v2 = phoneReNoArea.test(p);
        if (v1 || v2)
        {
            return true;
        }
        else {
            return false;
        }
    }

    $("#idea_description").on('keyup paste', function(){
        var Characters = $(this).val().replace(/(<([^>]+)>)/ig,"").length;
        if (Characters > 400 ) {
            Characters = 400;
            var content = $(this).val();
            $(this).val(content.substring(0,400));
        }
        $("#counter").text(Characters+"/400");
    });
    $("#user").click(function () {
        $(".error-form").removeClass("error-form");
        idea = $("#idea_description").val();
        if (idea.length < 10) {
            $("#idea_description").addClass("error-form");
            return 1;
        }
        $("#idea1").hide();
        $("#idea1").hide();
        $("#idea-back").show();
        $("#idea2").show();
    });

    $("#idea-back").click(function () {
        $("#idea-back").hide();
        $("#idea2").hide();
        $("#idea1").show();
        $("#idea1").show();
    });

    $("#final").click(function (event) {
        $("#final").hide();
        let preValidation = 1;
        $(".error-form").removeClass("error-form");
        $(".error-agr").removeClass("error-agr");

        idea = $("#idea_description").val();
        phone = $("#phone").val();
        email = $("#email").val();
        name = $("#name").val();

        if (!$('#agr1').is(":checked"))
        {
            $("#agr1-c").addClass("error-agr");
            preValidation = 0;
        }

        if (!$('#agr2').is(":checked"))
        {
            $("#agr2-c").addClass("error-agr");
            preValidation = 0;
        }

        if (name.length<5) {
            preValidation = 0;
            $("#name").addClass("error-form");
        }

        if (!validateEmail(email))
        {
            $("#email").addClass("error-form");
            preValidation = 0;
        }

        if (!validatePhone(phone))
        {
            $("#phone").addClass("error-form");
            preValidation = 0;
        }

        if (preValidation == 1) {
            let $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                url: "{{ url('/final') }}",
                type: 'POST',
                cache: false,
                data: {'idea': idea, 'phone': phone, 'email': email, 'name': name, '_token': $_token},
                datatype: 'html',
                success: function (data) {
                    $("#content-container").html(data);
                },
                error: function (xhr, textStatus, thrownError) {
                    console.log(xhr + "\n" + textStatus + "\n" + thrownError);
                }
            });
        }
        $("#final").show();
    });

    function toggleModal()
    {
        $("#iq-overlay").show();
        $("#reg-content").show();
        $(".backbutton").hide();
    }

    function closeModal()
    {
        $("#iq-overlay").hide();
        $("#reg-content").hide();
        $(".backbutton").show();
    }

    $("#reg").click(function () {
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url: "{{ url('/getReg') }}",
            type: 'GET',
            cache: false,
            datatype: 'html',
            success: function(data) {
                $("#reg-content").html(data);
                toggleModal();
            },
            error: function(xhr,textStatus,thrownError) {
                console.log(xhr + "\n" + textStatus + "\n" + thrownError);
            }
        });
    });
</script>


