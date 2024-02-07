@extends('_default')

@section('content')

<div id="reader" width="400px"></div>
  
<!-- Modal -->
<div class="modal" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
		        <div class="text-center">
		            <h3 id="status"></h3>
                    <p id="msg"></p>
		        </div>
            </div>
        </div>
    </div>
</div>

<script src="/dist/js/html5-qrcode.min.js" type="text/javascript"></script>

<script>
    async function onScanSuccess(decodedText, decodedResult) {
        const modal = new bootstrap.Modal('#resultModal');
        const response = await fetch(`{{url('api/'.$jenis)}}/${decodedText}`);
        const data = await response.json();
        console.log(data);

        const statusElm = document.getElementById('status');
        const msgElm = document.getElementById('msg');

        statusElm.removeAttribute('class');

        if (data.success) {
            statusElm.textContent = 'Berhasil';
            statusElm.classList.add('text-success');
        } else {
            statusElm.textContent = 'Gagal';
            statusElm.classList.add('text-danger');
        }

        msgElm.textContent = data.msg;

        return modal.show();
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { 
            formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ],
            fps: 10, 
            qrbox: {width: 250, height: 250}
        },
        false
    );

    html5QrcodeScanner.render(onScanSuccess);
</script>


@endsection