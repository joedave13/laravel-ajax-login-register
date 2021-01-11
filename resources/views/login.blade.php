@extends('app')

@section('title', 'Login Page')

@section('content')
<div class="row">
    <div class="col-md-5 offset-md-3">
        <div class="card">
            <div class="card-body">
                <label>Login</label>
                <hr>

                <form id="login_form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-login btn-success btn-block">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center" style="margin-top: 15px;">
            Belum punya akun? <a href="{{ route('register.index') }}">Register</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#login_form').on('submit', function (e) {
            e.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var token = $('meta[name="csrf-token"]').attr('content');

            if (email.length == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Email harus diisi!'
                });
            } else if (password.length == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Password harus diisi!'
                });
            } else {
                $.ajax({
                    url: "{{ route('login.do_login') }}",
                    type: "post",
                    dataType: "json",
                    cache: false,
                    data: {
                        "email": email,
                        "password": password,
                        "_token": token
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Login Success!',
                                text: response.message,
                                timer: 3000,
                                showCancelButton: false,
                                showConfirmButton: false
                            }).then(function () {
                                window.location.href =
                                    "{{ route('dashboard.index') }}";
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                title: 'Login Failed!',
                                text: response.message
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                });
            }
        });
    });

</script>
@endpush
