<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agents Self Register Portal|| Non Individuals</title>

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
                    <img src="registration/images/comapany.jpg" alt="">
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
    <h2> Non-Individual Agents Self Registration</h2>
   
    <div class="form-group">
        <label for="Comapnyname">Company Name :</label>
        <input type="text" name="cname" id="cname" placeholder="Company name" required/>
    </div>
    <div class="form-row">
        
        <div class="form-group">
        <label for="bussines_type">Type of ID :</label>
            <div class="form-select">
                <select name="bussines_type" id="bussines_type">
                    
                <option selected disabled value="">Choose...</option>
                <option value="NIN">NIN</option>
                <option value="DL">Driving Licence</option>
                <option value="VotingCard">Voters Card</option>
                <option value="Passport">International Passport</option>
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
       
        <div class="form-group">
            <label for="mid_name">Document No :</label>
            <input type="text" name="mid_name" onkeyup="this.value = this.value.toUpperCase();" id="mid_name" required/>
        </div>
        <div class="form-group">
            <label for="last_name">BVN No :</label>
            <input type="text" name="last_name" onkeyup="this.value = this.value.toUpperCase();" id="last_name" required/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="phone">Phone :</label>
            <input type="text" name="phone" id="phone" required/>
        </div>
        <div class="form-group">
            <label for="email">Email Address :</label>
            <input type="email" name="email" id="email" required/>
        </div>
    </div>
    <div class="form-row">
    <div class="form-group">
        <label for="bussines_type">Busines Type :</label>
            <div class="form-select">
                <select name="bussines_type" id="bussines_type">
                    
                    <option value="1">Payment Finance</option>
                    <option value="2">Private Company</option>
                    <option value="3">Public Company</option>
                    <option value="4">NGO</option>
                    <option value="5">PROP/PARTNERSHIP</option>
                    <option value="6">General Collection</option>
                    <option value="7">Starter/SME</option>
                    <option value="8">Betting</option>
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
       
    <div class="form-group">
        <label for="doc_no">Doc No :</label>
        <input type="text" name="doc_no" id="doc_no" required>
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
    <div class="form-row">
    <div class="form-group">
        <label for="passport">Certificate of Incorporation:</label>
        <input type="file" name="cert_of_incorporation" id="cert_of_incorporation" accept="image/*" />
    </div>

    <div class="form-group">
        <label for="passport">Secondary Document:</label>
        <input type="file" name="secdoc" id="passport" accept="image/*" />
    </div>
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