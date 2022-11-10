@extends('layouts.index')

@section('content')
<div class="container vh-100 d-flex align-items-center">
    <div class="w-50 w-lg-100  mx-auto border rounded ">
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
                    <button class="btn btn-dark" id="btnMerchant">Simpan</button>
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
        <div class="px-4">
            <ul class="list-group" id="history-sementara">
            </ul>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let jumHistory = 0;
    let idmerchant;


    const jntShopee = /(JP)\d{10}/g;
    const jntTiktok = /(JX)\d{10}/g;
    const jntTokped = /TJNT-[A-Z0-9]{6}-[A-Z0-9]{6}/g;
    const jtrShopee = /JT\d{11}/g;
    const spxShopee = /SPXID[A-Z0-9]{12}/g;
    const jneShopee = /CM\d{11}/g;
    let ecoms;
    let ekspedisi;

    $('#btnMerchant').click(function () {
        idmerchant = $('#merchant').val();
        $('#awb').removeAttr('disabled');
        $('#btnMerchant').attr('disabled', true);
        $('#merchant').attr('disabled', true);
        $('#awb').focus();
    });

    $('#awb').keyup(function () {
        const resi = $('#awb').val();
        if (resi.match(jntShopee)) {
            ecoms = 1;
            ekspedisi = 1;
        } else if (resi.match(jntTiktok)) {
            ecoms = 3;
            ekspedisi = 1;
        } else if (resi.match(jntTokped)) {
            ecoms = 2;
            ekspedisi = 1;
        } else if (resi.match(jtrShopee)) {
            ecoms = 1;
            ekspedisi = 3;
        } else if (resi.match(spxShopee)) {
            ecoms = 1;
            ekspedisi = 4;
        } else if (resi.match(jneShopee)) {
            ecoms = 1;
            ekspedisi = 2;
        } else {
            if (resi.length > 0) {
                $('#awb').val('');
                $('#awb').focus();
                var audio = new Audio('https://www.w3schools.com/html/horse.mp3');
                audio.play();
                Swal.fire({
                    title: "LHO HE",
                    text: `KODE RESI ${resi} GAK BENER`,
                    icon: 'warning',
                    iconHtml: '!',
                    confirmButtonText: 'YO',
                });
            }
            return;
        }
        $('#awb').val('');
        $('#awb').focus();
        // ajax
        $.ajax({
            method: 'post',
            data: {
                _token: "<?= csrf_token(); ?>",
                awb: resi,
                merchant: idmerchant,
                ecommerce: ecoms,
                ekspedisi: ekspedisi,
            },
            url: '{{ route("logs.store") }}',
            type: 'json',
            success: function (data) {
                if (data['success'] == false) {
                    if (data['validations'].hasOwnProperty('awb')) {
                        var audio = new Audio('https://www.w3schools.com/html/horse.mp3');
                        audio.play();
                        let pesan = "";
                        let judul = "";
                        if (data['validations']['awb'] == 'AWB sudah pernah discan') {
                            judul = 'WES PERNAH DISCAN!';
                            pesan = `AWB ${resi} sudah pernah discan!`;
                        } else {
                            judul = 'DOBEL COK!';
                            pesan = `AWB ${resi} DOBEL!`;
                        }
                        Swal.fire({
                            title: judul,
                            text: pesan,
                            icon: 'warning',
                            iconHtml: '!',
                            confirmButtonText: 'YO',
                        })
                    } else {
                        console.log(data['validations']);
                    }
                } else {
                    var audio = new Audio('{{ asset("audio/masuk.mp3") }}');
                    audio.play();
                    if (jumHistory >= 4) {
                        $('#history-sementara li:last-child').remove();
                    }
                    $('#history-sementara').prepend(`<li class="list-group-item">${resi}</li>`);
                    jumHistory = jumHistory + 1;
                }
            }
        })
    });

</script>
@endsection
