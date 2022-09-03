@extends('layouts.index')

@section('content')
<div class="container">
    <div class="mt-5 w-50 mx-auto border rounded">
        <div class="py-3">
            <div class="row justify-content-center">
                <div class="col-6">
                    <select class="form-select" id="merchant">
                        {{-- @dd($merchant) --}}
                        @foreach ($merchant as $merch)
                        <option value="{{ $merch->id }}">{{ $merch->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 text-center">
                    <button class="btn btn-primary" id="btnMerchant">Simpan</button>
                </div>
            </div>
        </div>
        <div class="py-3">
            <div class="row px-4">
                <div class="col-2">
                    <label for="awb" class="form-label">AWB</label>
                </div>
                <div class="col">
                    <input type="text" class="form-control" id="awb" disabled>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let idmerchant;

    $('#btnMerchant').click(function () {
        idmerchant = $('#merchant').val();
        $('#awb').removeAttr('disabled');
        $('#btnMerchant').attr('disabled', true);
        $('#merchant').attr('disabled', true);
        $('#awb').focus();
    });

    $('#awb').keyup(function () {
        const resi = $('#awb').val();
        const jntShopee = /(JP)\d{10}/g;
        const jntTiktok = /(JX)\d{10}/g;
        const jntTokped = /TJNT-[A-Z0-9]{6}-[A-Z0-9]{6}/g;
        let ecoms;
        if (resi.match(jntShopee)) {
            ecoms = 1;
        } else if (resi.match(jntTiktok)) {
            ecoms = 3;
        } else if (resi.match(jntTokped)) {
            ecoms = 2;
        } else {
            return;
        }
        // ajax
        $.ajax({
            method: 'post',
            data: {
                _token: "<?= csrf_token(); ?>",
                awb: resi,
                merchant: idmerchant,
                ecommerce: ecoms,
                ekspedisi: 1
            },
            url: '{{ route("logs.store") }}',
            type: 'json',
            success: function (data) {
                if (data['success'] == false) {
                    if (data['validations'].hasOwnProperty('awb')) {
                        var audio = new Audio('https://www.w3schools.com/html/horse.mp3');
                        audio.play();
                    } else {
                        console.log(data['validations']);
                    }
                } else {
                    var audio = new Audio('{{ asset("audio/success.mp3") }}');
                    audio.play();
                }
            }
        })

        $('#awb').val('');
        $('#awb').focus();
    });

</script>
@endsection
