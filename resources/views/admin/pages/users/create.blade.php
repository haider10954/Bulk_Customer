@extends('admin.layout.layout')

@section('title', 'User - Create')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">User</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex gap-1">
                    <h4 class="card-title mb-0 flex-grow-1">Create User</h4>
                </div>
                <div class="card-body">
                    <div class="prompt"></div>
                    <form id="addUserForm">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label  class="form-label">User Name</label>
                                    <input type="text" class="form-control"  name="user_name"
                                           placeholder="Enter User Name">
                                </div>

                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label for="cleave-delimiter" class="form-label">Email</label>
                                    <input type="email" class="form-control"  name="email"
                                           placeholder="Enter User Email">
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="mt-3 mb-xl-0">
                                    <div class="text-end">
                                        <button id="submitForm" type="submit" class="btn btn-soft-success">Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>

        $("#addUserForm").on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData($("#addUserForm")[0]);
            formData = new FormData($("#addUserForm")[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('user.create') }}",
                dataType: 'json',
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                beforeSend: function () {
                    $("#submitForm").prop('disabled', true);
                    $("#submitForm").html('<i class="fa fa-spinner fa-spin me-1"></i> Processing');
                },
                success: function (res) {
                    if (res.success == true) {
                        $("#submitForm").prop('disabled', false);

                        $('.prompt').show();
                        $('.prompt').html('<div class="alert alert-success mb-3">' + res.message + '</div>');

                        setTimeout(function () {
                            $('.prompt').hide()
                            window.location.href = "{{ route('index') }}";
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
                    $("#submitForm").html('Submit');
                    var first_error = '';
                    $.each(e.responseJSON.errors, function (index, item) {
                        first_error = item[0];
                        return false;
                    });


                    $(".prompt").fadeIn();
                    {
                        {
                            $('.prompt').html('<div class="alert alert-danger">' + first_error + '</div>');
                        }
                    }
                    setTimeout(function () {
                        $(".prompt").fadeOut();
                        {
                            {
                                prompt.html('<div class="alert alert-danger">' + first_error + '</div>');
                            }
                        }

                    }, 2000);

                }
            });
        });
    </script>
@endsection
