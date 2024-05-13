@extends('layouts.admin')
@section('content')
    <style>
        .container {
            min-height: 50vh;
            overflow-y: auto;
        }

        .modal-body {
            max-height: calc(100vh - 200px);
            overflow-y: auto;
        }
    </style>
    <div class="container mt-5">
        <h2>Insert Store Profile</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">
            Edit Profile
        </button>
        <form action="{{ route('admin.store.insert') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nameStore" class="form-label">Name Store</label>
                <input type="text" class="form-control" id="nameStore" name="name_store">
            </div>
            <div class="mb-3">
                <label for="storeLocation" class="form-label">Store Location</label>
                <input type="text" class="form-control" id="storeLocation" name="store_location">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="mb-3">
                <label for="officeLocation" class="form-label">Office Location</label>
                <input type="text" class="form-control" id="officeLocation" name="office_location">
            </div>
            <div class="mb-3">
                <label for="workHours" class="form-label">Work Hours</label>
                <input type="text" class="form-control" id="workHours" name="work_hours">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="instagramUrl" class="form-label">Instagram URL</label>
                <input type="url" class="form-control" id="instagramUrl" name="instagram_url">
            </div>
            <div class="mb-3">
                <label for="facebookUrl" class="form-label">Facebook URL</label>
                <input type="url" class="form-control" id="facebookUrl" name="facebook_url">
            </div>
            <div class="mb-3">
                <label for="twitterUrl" class="form-label">Twitter URL</label>
                <input type="url" class="form-control" id="twitterUrl" name="twitter_url">
            </div>
            <div class="mb-3">
                <label for="mapUrl" class="form-label">Map URL</label>
                <input type="url" class="form-control" id="mapUrl" name="map_url">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Modal for Editing -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Store Profile</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="{{ route('admin.store.update') }}" method="POST">
                        @csrf
                        @method('POST') <!-- or @method('PUT') depending on your route setup -->
                        <div class="mb-3">
                            <label for="editNameStore" class="form-label">Name Store</label>
                            <input type="text" class="form-control" id="editNameStore" name="name_store" required
                                value="{{ $profile->name_store }}">
                        </div>
                        <div class="mb-3">
                            <label for="editStoreLocation" class="form-label">Store Location</label>
                            <input type="text" class="form-control" id="editStoreLocation" name="store_location"
                                required value="{{ $profile->store_location }}">
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editPhone" name="phone" required
                                value="{{ $profile->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="editOfficeLocation" class="form-label">Office Location</label>
                            <input type="text" class="form-control" id="editOfficeLocation" name="office_location"
                                required value="{{ $profile->office_location }}">
                        </div>
                        <div class="mb-3">
                            <label for="editWorkHours" class="form-label">Work Hours</label>
                            <input type="text" class="form-control" id="editWorkHours" name="work_hours" required
                                value="{{ $profile->work_hours }}">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required
                                value="{{ $profile->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="editInstagramUrl" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control" id="editInstagramUrl" name="instagram_url"
                                value="{{ $profile->instagram_url }}">
                        </div>
                        <div class="mb-3">
                            <label for="editFacebookUrl" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control" id="editFacebookUrl" name="facebook_url"
                                value="{{ $profile->facebook_url }}">
                        </div>
                        <div class="mb-3">
                            <label for="editTwitterUrl" class="form-label">Twitter URL</label>
                            <input type="url" class="form-control" id="editTwitterUrl" name="twitter_url"
                                value="{{ $profile->twitter_url }}">
                        </div>
                        <div class="mb-3">
                            <label for="editMapUrl" class="form-label">map URL</label>
                            <input type="url" class="form-control" id="editMapUrl" name="map_url"
                                value="{{ $profile->map_url }}">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditForm()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitEditForm() {
            document.getElementById('editForm').submit();
        }
    </script>
@endsection
