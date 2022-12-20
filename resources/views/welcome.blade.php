@extends('layouts.frontend')

@section('content')

    <div class="main-container align-middle">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <img src="/img/logo.svg" class="mb-5 mx-auto d-block" width="90px">

                <div class="age-label">
                    Wprowadź swoją datę urodzenia aby potwierdzić, że jesteś pełnoletnim użytkownikiem wyrobów tytoniowych lub innych wyrobów zawierających nikotynę.
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-ac">
            <input type="text" name="agecheck" id="agecheck" placeholder="Data urodzenia">
        </div>

        <div class="iqbutton text-center mt-ab" id="verify-age" align="center">
            POTWIERDŹ
        </div>
    </div>
<script>
    $(function() {
        $('#agecheck').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            dateFormat: 'mm-yy',
            yearRange: "-80:+0",
            currentText: 'Dzisiaj',
            closeText : 'Wybierz',
            monthNames: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ],
            monthNamesShort: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ],
            onClose: function(dateText, inst) {
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
        });

        $("#verify-age").click(function () {
          let $_token = "{{ csrf_token() }}";
          let age = $("#agecheck").val();
          if (age.match(/^(\d{1,2})-(\d{4})$/)) {
              $.ajax({
                  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                  url: "{{ url('/agecheck') }}",
                  type: 'POST',
                  cache: false,
                  data: { 'age': age, '_token': $_token },
                  datatype: 'html',
                  success: function() {
                      window.location.reload();
                  },
                  error: function(xhr,textStatus,thrownError) {
                      alert(xhr + "\n" + textStatus + "\n" + thrownError);
                  }
              });
          }
        });
    })
</script>
@endsection


