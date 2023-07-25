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
            <input type="text" name="first_name" onkeyup="this.value = this.value.toUpperCase();" id="first_name" required/>
        </div>
        <div class="form-group">
            <label for="mid_name">Mid Name :</label>
            <input type="text" name="mid_name" onkeyup="this.value = this.value.toUpperCase();" id="mid_name" required/>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name :</label>
            <input type="text" name="last_name" onkeyup="this.value = this.value.toUpperCase();" id="last_name" required/>
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
    <div class="form-row">
    <div class="form-group">
            <label for="doc_type">Doc Type :</label>
            <div class="form-select">
                <select name="doc_type" id="doc_type">
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
        <label for="doc_no">Doc No :</label>
        <input type="text" name="doc_no" id="doc_no" required>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group">
            <label for="doc_type">Bank Name :</label>
            <div class="form-select">
                <select name="bank_name" id="doc_type">
                    
                <option selected disabled value="">Choose...</option>
                <option value="001">Ecobank Nigeria Limited</option>
                <option value="002">Fidelity Bank Plc.</option>
                <option value="003">First Bank of Nigeria Limited</option>
                <option value="004">First City Monument Bank Limited</option>
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
    <div class="form-group">
        <label for="acc_no">Bank Acc No :</label>
        <input type="text" name="bank_acc_no" id="acc_no" required>
    </div>
    </div>
    <div class="form-group">
        <label for="bvn">BVN No :</label>
        <input type="text" name="bvn" id="bvn" required>
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
                <select onchange="toggleLGA(this);" name="state" id="state" class="form-control">
                   
                <option value="" selected="selected" disabled>- Select -</option>
							<option value="Abia">Abia</option>
							<option value="Adamawa">Adamawa</option>
							<option value="AkwaIbom">AkwaIbom</option>
							<option value="Anambra">Anambra</option>
							<option value="Bauchi">Bauchi</option>
							<option value="Bayelsa">Bayelsa</option>
							<option value="Benue">Benue</option>
							<option value="Borno">Borno</option>
							<option value="Cross River">Cross River</option>
							<option value="Delta">Delta</option>
							<option value="Ebonyi">Ebonyi</option>
							<option value="Edo">Edo</option>
							<option value="Ekiti">Ekiti</option>
							<option value="Enugu">Enugu</option>
							<option value="FCT">FCT</option>
							<option value="Gombe">Gombe</option>
							<option value="Imo">Imo</option>
							<option value="Jigawa">Jigawa</option>
							<option value="Kaduna">Kaduna</option>
							<option value="Kano">Kano</option>
							<option value="Katsina">Katsina</option>
							<option value="Kebbi">Kebbi</option>
							<option value="Kogi">Kogi</option>
							<option value="Kwara">Kwara</option>
							<option value="Lagos">Lagos</option>
							<option value="Nasarawa">Nasarawa</option>
							<option value="Niger">Niger</option>
							<option value="Ogun">Ogun</option>
							<option value="Ondo">Ondo</option>
							<option value="Osun">Osun</option>
							<option value="Oyo">Oyo</option>
							<option value="Plateau">Plateau</option>
							<option value="Rivers">Rivers</option>
							<option value="Sokoto">Sokoto</option>
							<option value="Taraba">Taraba</option>
							<option value="Yobe">Yobe</option>
							<option value="Zamfara">Zamafara</option>
                
                </select>
                <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
            </div>
        </div>
        <div class="form-group">
            <label for="city">LGA :</label>
            <div class="form-select">
                <select name="city" id="lga" class="form-control select-lga" required>
                    
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
    <script src="registration/js/lga.min.js"></script>
</body>
</html>