<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Company Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="wizard/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="wizard/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
		integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous">
        <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>

    <!-- Main css -->
    <link rel="stylesheet" href="wizard/css/style.css">
    <link rel="stylesheet" href="wizard/css/custom.css">
    
</head>

<body>

    <div class="main">
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

        <div class="container">
            <form method="POST" id="signup-form" class="signup-form" action="{{ route('compagentsselfregister') }}" enctype="multipart/form-data">
            @csrf    
            <div>
                    <h3>Business info</h3>
                    <fieldset>
                        <h2>Business information</h2>
                        <p class="desc">Please enter your infomation and proceed to next step so we can build your account</p>
                        <div class="fieldset-content">
                             <div class="form-group">
                                <label for="cname" class="form-label">Business Name</label>
                                <input type="cname" name="cname" onkeyup="this.value = this.value.toUpperCase();" id="cname" placeholder="Enter your Business name as registered" />
                                <span class="text-input">Enter Your Business name as registered with the authorities</span>
                            </div>
                            <div class="form-group">
                                <label for="taxid" class="form-label">TAX ID</label>
                                <input type="taxid" name="taxid" id="taxid" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter your Business TAX ID" />
                                <span class="text-input">Enter Your Business Tax ID</span>
                            </div>
                            <div class="form-group">
                                <label for="taxid" class="form-label">Business BVN No</label>
                                <input type="taxid" name="bvn" id="bvn" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter your Business registration No" />
                                <span class="text-input">Enter Your Business BVN No</span>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Business Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="text" name="phone" id="cphone" />
                                        <span class="text-input">Enter Business Phone</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="email" id="cemail" />
                                        <span class="text-input">Enter Business Email</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="address" id="add" />
                                        <span class="text-input">Enter Business Physical address</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Business Location</label>
                                <div class="form-flex">
                               
                                    <div class="form-group">
                                    <select   onchange="toggleLGA(this);" id="state"  name="state" class="custom-select">
                                    <option value="" selected="selected">- Select -</option>
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
                                        <span class="text-input">Select Bussiness State</span>
                                    </div>
                                    
                                    <div class="form-group">
                                    <select name="city" id="lga" class="custom-select select-lga">
                                        
                                    </select>
                                        <span class="text-input">Select Bussiness LGA</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="location" class="form-label">Business Type</label>
                                    <select name="doc_type" id="doc_type" class="custom-select">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="1">Private Limited Liability </option>
                                        <option value="2">Public Limited Liability </option>
                                        <option value="3">Non-Government Organization </option>
                                        <option value="4">Proprietor/Partnership</option>
                                        <option value="5">General Collection </option>
                                        <option value="6">Starter Business/SMEs</option>
                                        <option value="7">Betting/Lottery </option>
                                        <option value="8">Payment/Finance</option> 
                                    </select>
                            </div>     

                           
                        </div>
                    </fieldset>

                    <h3>Directors Details</h3>
                    <fieldset>
                        <h2>Directors Data</h2>
                        <p class="desc">Please enter your infomation and proceed to next step so we can build your account</p>
                    
                        <div class="form-row">
                                <label class="form-label">Bussiness Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Select Identification Document</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        <span class="text-input">Enter Document Number</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        <span class="text-input">Enter Director Name</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        <span class="text-input">Enter Director BVN No</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Bussiness Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Select Identification Document</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        <span class="text-input">Enter Document Number</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        <span class="text-input">Enter Director Name</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        <span class="text-input">Enter Director BVN No</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Bussiness Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Select Identification Document</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        <span class="text-input">Enter Document Number</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        <span class="text-input">Enter Director Name</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        <span class="text-input">Enter Director BVN No</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Bussiness Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Select Identification Document</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        <span class="text-input">Enter Document Number</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        <span class="text-input">Enter Director Name</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        <span class="text-input">Enter Director BVN No</span>
                                    </div>
                                </div>
                            </div>
                           
                            
                    </fieldset>

                    <h3>Documents Uploads</h3>
                    <fieldset>
                        <h2>Upload Your Organization documents</h2>
                        <p class="desc">Upload your documents from here</p>
                        <div class="fieldset-content">
                        <div class="form-row">
                                <label class="form-label">Business Documents Uploades</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="file"  name="cert_of_coop" id="cert_of_coop" />
                                        <span class="text-input">Certificate of Incooperation</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="file" name="address_proof" id="address_proof" />
                                        <span class="text-input">Proof of address(Utility Bill)</span>
                                    </div>
                                </div>

                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="file" name="memandart" id="memandart" />
                                        <span class="text-input">Memorandum & Articles of association</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="file" name="stateofreturn" id="stateofreturn" />
                                        <span class="text-input">Statement of Return on allotment of shares</span>
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="operatinglicense" id="stateofreturn" />
                                        <span class="text-input">Copy of Operating license</span>
                                    </div>
                                </div>
                                    <div class="form-group">
                                         <button type="submit" class="custom-btn">Submit Application</button>
                                    </div>
                            </div>                           
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="wizard/js/lga.min.js"></script>
    <!-- <script src="wizard/js/lga.js"></script> -->
   
    <script src="wizard/vendor/jquery/jquery.min.js"></script>
    <script src="wizard/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="wizard/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="wizard/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="wizard/vendor/minimalist-picker/dobpicker.js"></script>
    <script src="wizard/vendor/nouislider/nouislider.min.js"></script>
    <script src="wizard/vendor/wnumb/wNumb.js"></script>
    <script src="wizard/js/main.js"></script>
    
    <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

        
</body>

</html>