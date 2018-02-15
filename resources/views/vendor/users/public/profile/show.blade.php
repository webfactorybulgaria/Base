@extends('core::public.master')

@section('title', trans('users::global.Profile'))

@section('page-header')
@endsection

@section('sidebar')
@endsection

@section('mainClass')
@endsection

@section('errors')
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $user->first_name . ' ' . $user->last_name}} - profile page</h1>
                <hr>

                <h2>User addresses:</h2>
                @if($user->addresses->count())
                    @foreach($addresses as $address)
                        <strong>Contact name:</strong> {{ $address->contact_name }}<br>
                        <strong>Phone:</strong> {{ $address->phone }}<br>
                        <strong>Address:</strong> {{ $address->address }}<br>
                        <strong>Address 2:</strong> {{ $address->address2 }}<br>
                        <strong>Postcode:</strong> {{ $address->postcode }}<br>
                        <strong>City:</strong> {{ $address->city }}<br>
                        <strong>State:</strong> {{ $address->state }}<br>
                        <strong>Country:</strong> {{ $address->country }}<br>
                        <strong>Details:</strong> {{ $address->details }}<br>
                        <a class="btn btn-primary" href="{{ route('profile.edit', $address->id) }}">Edit</a><br>
                        <hr>
                    @endforeach
                @else
                    <strong>no addresses found</strong>
                @endif

                <a href="{{ route('address.create') }}">add new address</a>
            </div>
        </div>
    </div>
@endsection
