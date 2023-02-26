@extends('dashboard.layouts.master')

@section('title') Dashboard @endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{ route('dashboard.settings.update', ['setting' => $setting]) }}" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Shipping Details</h3>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <label class="form-label mt-0">Favicon</label>
                            <input type="file" name="favicon" class="dropify" data-default-file="{{ asset($setting->logo) }}" data-bs-height="180" />
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <label class="form-label mt-0">Logo</label>
                            <input type="file" name="logo" class="dropify" data-default-file="{{ asset($setting->favicon) }}" data-bs-height="180" />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <input type="text" class="form-control" name="facebook" id="name1" placeholder="Facebook" value="{{ $setting->facebook }}">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <input type="text" class="form-control" name="twitter" id="name2" placeholder="Twitter" value="{{ $setting->twitter }}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <input type="text" class="form-control" name="instagram" id="name1" placeholder="Instagram" value="{{ $setting->instagram }}">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-0">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="name2" placeholder="Email" value="{{ $setting->email }}">
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <input type="email" class="form-control" name="phone" id="inputEmail5" placeholder="Phone" autocomplete="username" value="{{ $setting->phone }}">
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabs style</h3>
            </div>
            <div class="card-body">
                <div class="panel panel-primary">
                    <div class="tab-menu-heading tab-menu-heading-boxed">
                        <div class="tabs-menu-boxed">
                            <!-- Tabs -->
                            <ul class="nav panel-tabs">
                                @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                    <li><a href="#{{ $key }}" class="@if($loop->index == 0) active @endif" data-bs-toggle="tab">{{ $data['native'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                <div class="tab-pane @if($loop->index == 0) active @endif"  id="{{ $key }}">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1" class="form-label">Email</label>
                                        <input type="text" name="{{ $key }}[title]" class="form-control" id="inputEmail5" placeholder="Email Address" autocomplete="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="floatingTextarea2">Content</label>
                                        <textarea class="form-control" name="{{ $key }}[content]" placeholder="Comments" id="floatingTextarea2" style="height: 100px"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="floatingTextarea2">Address</label>
                                        <textarea class="form-control" name="{{ $key }}[address]" placeholder="Comments" id="floatingTextarea2" style="height: 100px"></textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit">Submit</button>
    </form>
@endsection
