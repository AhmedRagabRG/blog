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
                    <h3 class="card-title">{{ __('user.users_data') }}</h3>
                    <button type="button" data-bs-target="#addmodal" data-bs-toggle="modal" class="btn btn-primary">{{ __('user.add-header') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom" id="table_id">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">id</th>
                                <th class="wd-15p border-bottom-0">{{ __('user.name') }}</th>
                                <th class="wd-15p border-bottom-0">{{ __('user.email') }}</th>
                                <th class="wd-20p border-bottom-0">{{ __('user.permissions') }}</th>
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
                    <h6 class="modal-title">{{ __('user.edit-header') }}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{ route('dashboard.users.updates') }}">
                    @csrf
                    @method('PATCH')
                    <input id="id" name="id" hidden>
                    <div class="modal-body">

                        @include('dashboard.components.error')

                        <div class="mb-3">
                                <label for="name" class="col-form-label">{{ __('user.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ value('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">{{ __('user.email') }}</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">{{ __('user.permissions') }}</label>
                                <select class="form-control form-select" name="permissions" aria-label="Default select example">
                                    <option selected value="writer">writer</option>
                                    <option value="admin">admin</option>
                                    <option value="">{{ __('user.status_not_active') }}</option>
                                </select>
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
                    <h6 class="modal-title">{{ __('user.add-header') }}</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <form method="post" action="{{ route('dashboard.users.store') }}">
                    @csrf
                    <div class="modal-body">

                        @include('dashboard.components.error')

                        <div class="mb-3">
                                <label for="name" class="col-form-label">{{ __('user.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="col-form-label">{{ __('user.email') }}</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="col-form-label">{{ __('user.password') }}</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">{{ __('user.permissions') }}</label>
                                <select class="form-control form-select" name="permissions" aria-label="Default select example">
                                    <option value="writer">writer</option>
                                    <option value="admin">admin</option>
                                    <option selected value="">{{ __('user.status_not_active') }}</option>
                                </select>
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
                ajax: "{{ Route('dashboard.users.all') }}",
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
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
                        url: "users/delete/"+id,
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
