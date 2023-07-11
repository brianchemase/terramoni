<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agents Self Register Portal</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="registration/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="registration/css/style.css">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="registration/images/signup-img.jpg" alt="">
                </div>
 @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


                <div class="signup-form">
                <form method="POST" class="register-form" id="register-form" action="{{ route('agentsselfregister') }}" enctype="multipart/form-data">
    @csrf
    <h2>Agents Self Registration Portal</h2>
    <h3>Individual Portal</h3>
    <div class="form-row">
        <div class="form-group">
            <label for="first_name">First Name :</label>
            <input type="text" name="first_name" id="first_name" required/>
        </div>
        <div class="form-group">
            <label for="mid_name">Mid Name :</label>
            <input type="text" name="mid_name" id="mid_name" required/>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name :</label>
            <input type="text" name="last_name" id="last_name" required/>
        </div>
    </div>
    <div class="form-group">
        <label for="phone">Phone :</label>
        <input type="text" name="phone" id="phone" required/>
    </div>
    <div class="form-group">
        <label for="email">Email Address :</label>
        <input type="email" name="email" id="email" required/>
    </div>
    <div class="form-group">
        <label for="birth_date">DOB :</label>
        <input type="date" name="birth_date" id="birth_date">
    </div>
    <div class="form-group">
        <label for="national_id_no">National ID No :</label>
        <input type="text" name="national_id_no" id="national_id_no">
    </div>
    <div class="form-group">
        <label for="bvn">BVN No :</label>
        <input type="text" name="bvn" id="bvn">
    </div>
    <div class="form-radio">
        <label for="gender" class="radio-label">Gender :</label>
        <div class="form-radio-item">
            <input type="radio" name="gender" id="male" value="male" checked>
            <label for="male">Male</label>
            <span class="check"></span>
        </div>
        <div class="form-radio-item">
            <input type="radio" name="gender" id="female" value="female">
            <label for="female">Female</label>
            <span class="check"></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="state">State :</label>
            <div class="form-select">
                <select name="state" id="state">
                    <option value=""></option>
                    <option value="us">America</option>
                    <option value="uk">English</option>
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="city">City :</label>
            <div class="form-select">
                <select name="city" id="city">
                    <option value=""></option>
                    <option value="losangeles">Los Angeles</option>
                    <option value="washington">Washington</option>
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="passport">Passport:</label>
        <input type="file" name="passport" id="passport" accept="image/*" />
    </div>
    <div class="form-submit">
        <input type="reset" value="Reset All" class="submit" name="reset" id="reset" />
        <input type="submit" value="Register" class="submit" name="submit" id="submit" />
    </div>
</form>

                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="registration/vendor/jquery/jquery.min.js"></script>
    <script src="registration/js/main.js"></script>
</body>
</html>