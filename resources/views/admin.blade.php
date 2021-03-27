@extends ('layout')

@section('content')
    <admin-component v-bind:initdata="{{$campings}}" action={{$action}}></admin-component>
@endsection