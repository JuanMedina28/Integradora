@extends('layouts.app', ['class' => 'bg-gris-oxford'])

@section('content')
@include('layouts.headers.guest')

<div class="container mt--5 pb-5">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-transparent pb-2">
                    <h1 style="text-align: center" class="text-rosita">Registrate</h1>
                </div>
                <div class="card-body px-lg-5 py-lg-3">

                    <form role="form" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" type="text" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" type="password" name="password" required>
                            </div>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control" placeholder="{{ __('Confirmación de Password') }}" type="password" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-12">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                    <input class="custom-control-input" id="customCheckRegister" type="checkbox">
                                    <label class="custom-control-label" for="customCheckRegister">
                                        <span class="text-muted">{{ __('Acepto las') }} <a href="{{ route('terminos') }}">{{ __('Politicas de Privacidad') }}</a></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-dark text-cyan mt-4">{{ __('Crear cuenta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Términos y Condiciones PartyService</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
  
                <p>Esta aplicación web es propiedad y está operada por D.Power. Estos Términos establecen los términos y condiciones bajo los cuales el usuario puede usar la misma, así como los servicios ofrecidos por esta. Al acceder o usar la aplicación web PartyService, usted aprueba que ha leído, entendido y aceptado estar sujeto a estos Términos:</p>
                <p>Para usar esta aplicación web y / o recibir sus servicios, debes tener al menos 18 años, o la mayoría de edad legal en tu país.</p>
                <p>Al comprar un servicio, aceptas que: (I) Eres responsable de leer el listado completo del servicio antes de comprometerte a contratar: (II) Firmaras un acuerdo con el vendedor para contratar el servicio y completar el proceso de adquisición.</p>
                <p>Usted acuerda indemnizar y eximir de responsabilidad a D.Power de cualquier demanda, pérdida, responsabilidad, reclamación o gasto (incluidos los honorarios de abogados) que terceros realicen en su contra como consecuencia de, o derivado de, o en relación con el uso de la aplicación web o cualquiera de los servicios ofrecidos en la misma.</p>
                <p>Nos reservamos el derecho de modificar estos términos de vez en cuando a nuestra entera discreción. Por lo tanto, debes revisar estas páginas periódicamente. Cuando cambiemos los Términos de una manera material, te notificaremos que se han realizado cambios importantes en los Términos. El uso continuado de aplicación web o nuestro servicio después de dicho cambio constituye tu aceptación de los nuevos Términos. Si no aceptas alguno de estos términos o cualquier versión futura de los Términos, no uses o accedas (o continúes accediendo) a la aplicación web.</p>
    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark text-cyan" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection