@extends ('layout')

@section('content')
    <campingform-component v-bind:camp='{{$campsite}}' v-bind:tags='{{$tags}}' action="edit" method="{{$action}}"></campingform-component>
@endsection