@extends('layouts.app')

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenido') . ' '. auth()->user()->name,
        'description' => __('Esta es tu página de perfil. Puede ver los datos almacenados y modificarlos.'),
        'class' => 'col-lg-12'
    ])   

    <profile-component/>
@endsection
