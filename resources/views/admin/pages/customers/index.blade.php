@extends('admin.layout.layout')

@section('title','Customers')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex gap-1">
                    <h4 class="card-title mb-0 flex-grow-1">All Customers</h4>
                    <a href="{{ route('create.customer') }}" class="btn btn-primary"><i class="bx bx-plus me-2"></i>Add
                        Customer</a>
                    <a data-bs-toggle="modal" data-bs-target="#importCustomersModal" class="btn btn-primary"><i
                            class="bx bx-plus me-2"></i>Import Customers</a>
                </div><!-- end card header -->
                <div class="prompt"></div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-centered align-middle table-nowrap mb-0" id="userTable">
                            <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Assigned User</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($customer->count() > 0)
                                @foreach($customer as $user)
                                    <tr>
                                        <td>
                                            <a class="fw-medium link-primary">#{{ $loop->index+1 }}</a>
                                        </td>

                                        <td>{{  $user->getAssignedUser->name  }}</td>
                                        <td>
                                            <div class="flex-grow-1">{{$user->name}}</div>
                                        </td>
                                        <td>
                                            {{$user->email}}
                                        </td>
                                        <td>
                                            {{$user->phone}}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('edit_customer',$user->id) }}"
                                                   class="btn btn-soft-success"><i
                                                        class="bx bx-edit"></i></a>
                                                <button class="btn btn-soft-danger" data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop"
                                                        onclick="deleteUser('{{$user->id}}')"><i
                                                        class="bx bx-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr><!-- end tr -->
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center mt-3 mb-3">
                                            No Record Found
                                        </div>
                                    </td>

                                </tr>
                            @endif

                            </tbody>

                        </table>
                        <div class="text-center mt-3 mb-3" id="noRecordMsg">No records found.</div>
                    </div>


                    <div class="row align-items-center mt-4 pt-2 gy-2 text-center text-sm-start">
                        {{ $customer->links('vendor.pagination.bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are You Sure To Delete ?
                </div>
                <div class="modal-footer">
                    <form id="deleteUserRecord">
                        <input type="hidden" name="customer_id" id="customer_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitDelForm" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Import Customers Modal -->
    <div class="modal fade" id="importCustomersModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import Customers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="importCustomersRequest">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">

                            <label class="form-label">Upload Excel</label>
                            <input type="file" name="excel_file" id="excel_file" class="form-control" accept="xls,xlxs">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select User</label>
                            <select name="users[]" multiple class="form-control">
                                <option value="all">Select All</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submitDelForm" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

    <script>


        $("#importCustomersRequest").on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData($("#importCustomersRequest")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('import.customer') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                beforeSend: function () {
                    $("#submitDelForm").prop('disabled', true);
                    $("#submitDelForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                },
                success: function (res) {
                    if (res.success == true) {
                        $('#importCustomersModal').modal('hide');
                        $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');
                        window.location.reload();
                    } else {
                        alert('fail')
                    }
                },
                error: function (e) {
                }
            });
        });

        function deleteUser(id) {
            $('#customer_id').val(id);
        }

        $("#deleteUserRecord").on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{ route('delete.customer') }}",
                dataType: 'json',
                data: {
                    id: $('#customer_id').val(),
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function () {
                    $("#submitDelForm").prop('disabled', true);
                    $("#submitDelForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                },
                success: function (res) {
                    if (res.success == true) {
                        $("#submitDelForm").prop('disabled', false);
                        $("#submitDelForm").html('Submit');
                        $('#staticBackdrop').modal('hide');
                        $('.prompt').show();
                        $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                        setTimeout(function () {
                            $('.prompt').hide()
                            window.location.reload();
                        }, 2000);

                    } else {
                        $("#submitForm").prop('disabled', false);
                        $('.prompt').show();
                        $('.prompt').html('<div class="alert alert-danger mb-3">' + res.message + '</div>');

                        setTimeout(function () {
                            $('.prompt').hide()
                        }, 2000);

                    }
                },
                error: function (e) {
                    $("#submitForm").prop('disabled', false);
                }
            });
        });
    </script>
@endsection

