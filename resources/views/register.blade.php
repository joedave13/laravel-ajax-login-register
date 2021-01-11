@extends('app')

@section('title', 'Register Page')

@section('content')
<div class="row">
    <div class="col-md-5 offset-md-3">
        <div class="card">
            <div class="card-body">
                <label>Register</label>
                <hr>
                <form id="register_form">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-register btn-primary btn-block">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="text-center" style="margin-top: 15px;">
            Sudah punya akun? <a href="{{ route('login.index') }}">Login</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#register_form').on('submit', function (e) {
            e.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var token = $('meta[name="csrf-token"]').attr('content');

            if (name.length == '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Nama harus diisi!'
                });
            } else if (email.length == '') {
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
                    url: "{{ route('register.store') }}",
                    type: "post",
                    cache: false,
                    data: {
                        "name": name,
                        "email": email,
                        "password": password,
                        "_token": token
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message
                            });

                            $('#name').val('');
                            $('#email').val('');
                            $('#password').val('');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            })
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: 'Server error!'
                        })
                    }
                })
            }
        })
    });

</script>
@endpush
