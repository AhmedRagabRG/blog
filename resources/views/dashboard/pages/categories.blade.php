@extends('dashboard.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">{{ __('category.category_list') }}</h3>
                    <button type="button" data-bs-target="#addmodal" data-bs-toggle="modal" class="btn btn-primary">{{ __('category.add-header') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="table_id">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">id</th>
                                <th class="wd-15p border-bottom-0">{{ __('category.title') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('category.content') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('category.category') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('main.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editmodal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('category.edit-header') }}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{ route('dashboard.categories.update') }}">
                    @csrf
                    @method('PATCH')
                    <input id="id" name="id" hidden>
                    <div class="modal-body">

                        @include('dashboard.components.error')

                        <div class="form-group">
                            <label class="form-label mt-0">{{ __('category.img') }}</label>
                            <input type="file" name="img" class="dropify" data-default-file="" data-bs-height="180" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">{{ __('category.category') }}</label>
                            <select class="form-control form-select" name="parent" aria-label="Default select example">
                                <option selected value="0">{{ __('category.main_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="panel panel-primary">
                            <div class="tab-menu-heading tab-menu-heading-boxed">
                                <div class="tabs-menu-boxed">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <ul class="nav panel-tabs">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                                <li><a href="#edit{{ $key }}" class="@if($loop->index == 0) active @endif" data-bs-toggle="tab">{{ $data['native'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                        <div class="tab-pane @if($loop->index == 0) active @endif"  id="edit{{ $key }}">
                                            <div class="form-group ">
                                                <label for="title" class="form-label">{{ __('category.title') }}</label>
                                                <input type="text" name="{{ $key }}[title]" class="form-control" id="title">
                                            </div>
                                            <div class="form-group">
                                                <label for="content">{{ __('category.content') }}</label>
                                                <input type="text" name="{{ $key }}[content]" class="form-control" id="content">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">{{ __('main.edit') }}</button>
                        <a class="btn btn-light" data-bs-dismiss="modal">{{ __('main.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addmodal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">{{ __('category.add-header') }}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        @include('dashboard.components.error')

                        <div class="form-group">
                            <label class="form-label mt-0">{{ __('category.img') }}</label>
                            <input type="file" name="img" class="dropify" data-default-file="" data-bs-height="180" />
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">{{ __('category.category') }}</label>
                            <select class="form-control form-select" name="parent" aria-label="Default select example">
                                <option selected value="0">{{ __('category.main_category') }}</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="panel panel-primary">
                            <div class="tab-menu-heading tab-menu-heading-boxed">
                                <div class="tabs-menu-boxed">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs">
                                        <ul class="nav panel-tabs">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                                <li><a href="#{{ $key }}" class="@if($loop->index == 0) active @endif" data-bs-toggle="tab">{{ $data['native'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body">
                                <div class="tab-content">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $key => $data)
                                        <div class="tab-pane @if($loop->index == 0) active @endif"  id="{{ $key }}">
                                            <div class="form-group">
                                                <label for="title" class="form-label">{{ __('category.title') }}</label>
                                                <input type="text" name="{{ $key }}[title]" class="form-control" id="title">
                                            </div>
                                            <div class="form-group">
                                                <label for="content">{{ __('category.content') }}</label>
                                                <input type="text" name="{{ $key }}[content]" class="form-control" id="content">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">{{ __('main.add') }}</button>
                        <a class="btn btn-light" data-bs-dismiss="modal">{{ __('main.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script type="text/javascript">

        $(function () {
            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.categories.all') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'parent',
                        name: 'parent'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            })
        })

        $('#table_id tbody').on('click', '#bDel', function (e) {
            var id = $(this).attr('data-id')
            Swal.fire({
                icon: 'warning',
                title: "{{ __('message.delete') }}",
                text: "{{ __('message.alert_delete_warn') }}",
                showCancelButton: true,
                confirmButtonText: "{{ __('main.delete') }}",
                cancelButtonText: "{{ __('main.cancel') }}",
                confirmButtonColor: '#5865F2',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "categories/delete/"+id,
                        success: function (res) {
                            Swal.fire('{{ __('message.delete_success') }}', '', 'success')
                        }
                    }).then((confirmed) => {
                        window.location.reload();
                    })
                }
            })

        })

        $('#table_id tbody').on('click', '#bEdit', function (e) {
            var id = $(this).attr('data-id')
            $('#editmodal #id').val(id)
        })

    </script>
@endpush
