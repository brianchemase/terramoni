<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agents Self Register Portal</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="registration/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>
    <!-- Main css -->
    <link rel="stylesheet" href="registration/css/style.css">
</head>
<body>

    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="registration/images/signup-img.jpg" alt="" height="100%">
                </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <!-- {{ $message }} -->

                            <script>
                                window.addEventListener('DOMContentLoaded', function() {
                                    swal("Submited!", "Application Submited successfully.", "success");
                                });
                            </script>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
                        </div>
                    <script>
                        window.addEventListener('DOMContentLoaded', function() {
                            swal("Error!", "An error happened. Contact Admin.", "error");
                        });
                    </script>
                    @endif

                    <div class="alert alert-success"  id="b2">
                    
                 
                    </div>


                <div class="signup-form">
                <form method="POST" class="register-form" id="register-form" action="{{ route('agentsselfregister') }}" enctype="multipart/form-data">
    @csrf
    <h2>Agents Self Registration Portal</h2>
    <h2>Individual Portal</h2>
    <div class="form-row">
        <div class="form-group">
            <label for="first_name">First Name :</label>
            <input type="text" name="first_name" onkeyup="this.value = this.value.toUpperCase();" id="first_name" required/>
        </div>
        <div class="form-group">
            <label for="mid_name">Middle Name :</label>
            <input type="text" name="mid_name" onkeyup="this.value = this.value.toUpperCase();" id="mid_name" required/>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name :</label>
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
            <label for="taxid"> Business Name: </label>
            <input type="text" name="bname" id="address">
        </div>
        <div class="form-group">
            <label for="email">Business Address :</label>
            <input type="text" name="baddress" id="email" required/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="birth_date">Date Of Birth :</label>
            <input type="date" name="birth_date" id="birth_date">
        </div>
        <div class="form-group">
            <label for="taxid">TAX ID</label>
            <input type="text" name="taxid" id="taxid">
        </div>
        
    </div>
  
    <div class="form-row">
    <div class="form-group">
            <label for="doc_type">ID Type :</label>
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
        <label for="doc_no">ID No :</label>
        <input type="text" name="doc_no" id="doc_no" required>
    </div>
    <div class="form-group">
            <label for="iddoc">ID Document:</label>
            <input type="file" name="doc" id="doc" accept="image/*" required />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="issue">Issue Date :</label>
            <input type="date" name="issuedate" id="issuedate" required/>
        </div>
        <div class="form-group">
            <label for="issue">Expiry Date :</label>
            <input type="date" name="expirydate" id="expirydate" required/>
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
        <label for="acc_no">Bank Account No :</label>
        <input type="text" name="bank_acc_no" id="acc_no" required>
        <small id="bank description" class="form-text text-muted">This is the Bank Account from which you will always fund your Wallet/Virtual Account.</small>
    </div>
    </div>
    <div class="form-row">
    <div class="form-group">
        <label for="bvn">Refferal Code :</label>
        <input type="text" name="refcode" id="refcode" value="0">
        <small id="bank description" class="form-text text-muted">If you have the agent referal code update the field.</small>
    </div>
    <div class="form-group">
        <label for="bvn">BVN No :</label>
        <input type="text" name="bvn" id="bvn" required>
    </div>
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
        <label for="location">Residential Address :</label>
            <input type="text" name="location" id="location" >
        </div>
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
    <div class="form-row">
        <div class="form-group">
            <label for="passport">Passport Photo:</label>
            <input type="file" name="passport" id="passport" accept="image/*" required />
        </div>

        <div class="form-group">
            <label for="address_proof">Proof of Address:</label>
            <input type="file" name="address_proof" id="address_proof" accept="image/*" required />
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
    <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
    <script src="registration/vendor/jquery/jquery.min.js"></script>
    <script src="registration/js/main.js"></script>
    <script src="registration/js/lga.min.js"></script>
    <script src="registration/js/alert.js"></script>
</body>
</html>