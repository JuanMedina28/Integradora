@extends('layouts.app')

@push('jsH')

     
   <style>
    body{background:#eee}
    .ratings i{font-size: 16px;color: red}
    .strike-text{color: red;text-decoration: line-through}
    .product-image{width: 100%}
    .dot{height: 7px;width: 7px;margin-left: 6px;margin-right: 6px;margin-top: 3px;background-color: blue;border-radius: 50%;display: inline-block}
    .spec-1{color: #938787;font-size: 18px}h5,h4{font-size: 18px}
    .para{font-size: 16px}
|   </style>
@endpush

@section('content')

<solicitud-component/>

@endsection