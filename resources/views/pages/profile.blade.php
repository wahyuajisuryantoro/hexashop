@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card rounded bg-white mt-5 mb-5 border"
        style="width: 50%; border-radius: 20px; border: 1px solid black;">
        <div class="card-body">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <form>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control"
                                placeholder="first name" value="{{ $user->name }}"></div>
                        <div class="col-md-12"><label class="labels">Email ID</label><input type="email"
                                class="form-control" placeholder="enter email id" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text"
                                class="form-control" placeholder="enter phone number"
                                value="{{ $userProfile->phone_number ?? '' }}"></div>
                        <div class="col-md-12"><label class="labels">Address</label><input type="text"
                                class="form-control" placeholder="enter address"
                                value="{{ $userProfile->shipping_address ?? '' }}"></div>
                    </div>
                    <div class="pt-3 mb-4">
                        <button type="submit" class="btn btn-dark btn-lg btn-block">Save Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection