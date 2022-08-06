@extends('layouts.app')
@push('jsH')


<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript"
    src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
    <script type='text/javascript'
    src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>

    <script>
        $(document).ready(function() {

            OpenPay.setId('mx969jutgahr3m09j5xz');
            OpenPay.setApiKey('pk_54c214a1c44149abb337167b33ff1f72');
            OpenPay.setSandboxMode(true);
            //Se genera el id de dispositivo
            var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

            $('#pay-button').on('click', function(event) {
                event.preventDefault();
                $("#pay-button").prop( "disabled", true);
                OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
            });

            var sucess_callbak = function(response) {
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Pago Exitoso',
                showConfirmButton: false,
                timer: 1000
                });
              var token_id = response.data.id;
              $('#token_id').val(token_id);
              $('#payment-form').submit();
            };

            var error_callbak = function(response) {
                var desc = response.data.description != undefined ? response.data.description : response.message;
                Swal.fire('Oooooops! '+ response.status, desc);
                //)
                //alert("ERROR [" + response.status + "] " + desc);
                $("#pay-button").prop("disabled", false);
            };

        });
    </script>
    
   <style>
        body{background:#eee}
        .ratings i{font-size: 16px;color: red}
        .strike-text{color: red;text-decoration: line-through}
        .product-image{width: 100%}
        .dot{height: 7px;width: 7px;margin-left: 6px;margin-right: 6px;margin-top: 3px;background-color: blue;border-radius: 50%;display: inline-block}
        .spec-1{color: #938787;font-size: 18px}h5,h4{font-size: 18px}
        .para{font-size: 16px}
    </style>



@endpush
@section('content')

<historial-component/>

@endsection