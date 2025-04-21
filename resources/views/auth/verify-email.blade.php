<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Verify Your Email Address</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-center">
                            Before proceeding, please check your email for a verification link.
                        </p>
                        <p class="text-center">
                            If you did not receive the email, click the button below to request another.
                        </p>
                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success text-center" role="alert">
                                A new verification link has been sent to your email address.
                            </div>
                        @endif
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                            </div>
                        </form>
                        <hr>
                        <div class="text-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
