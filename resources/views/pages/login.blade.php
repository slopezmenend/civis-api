@extends ('layouts.frontend')

@section('content')
    <h1>Civis API Dashboard</h1>

    <!------ Include the above in your HEAD tag ---------->

    <div class="row mt-4 justify-content-md-center">
        <div class="shadow p-1 mb-5 bg-white rounded col-6">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="text-center bg-dark text-white p-1">
                <h2>Login</h2>
            </div>

            <!-- Login Form -->
            <form class="p-2">
                <div class="row form-group pr-4">
                    <label class="ml-4 col-2 font-weight-bold" for="email">Email: </label>
                    <input type="email" id="email" class="col-10 ml-4" name="email" placeholder="email">
                </div>
                <div class="row form-group pr-4">
                    <label class="ml-4 col-2 font-weight-bold" for="password">Password: </label>
                    <input type="password" id="password" class="col-10 ml-4" name="password" placeholder="password">
                </div>
                <div class="row form-group justify-content-md-center">
                    <input type="submit" class="col-6 btn btn-info" value="Log In">
                </div>
            </form>

            <!-- Remind Passowrd -->
            <div class="row form-group justify-content-md-center">
                <a class="col-6 btn btn-info" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
@endsection
