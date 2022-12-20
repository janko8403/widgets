@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Ustawienia konkursu</div>
                <div class="card-body">
                    <input type="checkbox" name="contestActive" id="contestActive"> Konkurs aktywny
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nagrody</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">Pierwsza nagroda <span id="firstPrizeCount">{{ $firstPrizeCount }}</span>/5</div>
                        <div class="col-4">Druga nagroda <span id="secondPrizeCount">{{ $secondPrizeCount }}</span>/15</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Zgłoszenia</div>
                <div class="card-body">
                    <table class="table table-bordered table-responsive-lg">
                        <tr>
                            <th>No</th>
                            <th>Pomysł</th>
                            <th>Imię i nazwisko</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Utworzony</th>
                            <th>Pierwsza nagroda</th>
                            <th>Druga nagroda</th>
                        </tr>
                        @foreach ($contests as $contest)
                            <tr>
                                <td>{{ $contest->id }}</td>
                                <td>{{ $contest->idea }}</td>
                                <td>{{ $contest->name }}</td>
                                <td>{{ $contest->email }}</td>
                                <td>{{ $contest->phone }}</td>
                                <td>{{ $contest->created_at }}</td>
                                <td>
                                    <input type="checkbox" name="firstPrize{{ $contest->id }}" id="firstPrize{{ $contest->id }}" onclick="togglePrize(1,{{ $contest->id }})"
                                           @if ($contest->firstPrize == 1)
                                            checked="checked"
                                           @endif
                                </td>
                                <td>
                                    <input type="checkbox" name="firstPrize{{ $contest->id }}" id="firstPrize{{ $contest->id }}" onclick="togglePrize(2,{{ $contest->id }})"
                                    @if ($contest->secondPrize == 1)
                                            checked="checked"
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {!! $contests->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function togglePrize(type,id)
{
    let $_token = "{{ csrf_token() }}";
    $.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        url: "{{ url('/switchPrize') }}",
        type: 'POST',
        cache: false,
        datatype: 'html',
        data: { 'prizeType': type, 'id': id, '_token': $_token },
        success: function(data) {
            switch(type) {
                case 1:
                    $("#firstPrizeCount").html(data);
                    break;
                case 2:
                    $("#secondPrizeCount").html(data);
                    break;
            }
        },
    });
}
function toggleContest()
{

}
</script>
@endsection
