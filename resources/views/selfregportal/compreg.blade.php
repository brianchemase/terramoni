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
                    <h3>Business Information</h3>
                    <fieldset>
                        <h2>Business Information</h2>
                        <p class="desc">Please enter your infomation and proceed to the next step so we can build your account</p>
                        <div class="fieldset-content">
                             <div class="form-group">
                                <label for="cname" class="form-label">Business Name</label>
                                <input type="cname" name="cname" onkeyup="this.value = this.value.toUpperCase();" id="cname" placeholder="Enter your Business Name as registered" />
                                <span class="text-input">Enter your business name as registered with the authorities</span>
                            </div>
                            <div class="form-group">
                                <label for="taxid" class="form-label">Business Registration Number</label>
                                <input type="taxid" name="bvn" id="bvn" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter your Business Registration Number" />
                                <!-- <span class="text-input">Enter Your Business Registration No</span> -->
                            </div>
                            <div class="form-group">
                                <label for="taxid" class="form-label">Business TAX ID Number</label>
                                <input type="taxid" name="taxid" id="taxid" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter your Business TAX ID Number" />
                                <!-- <span class="text-input">Enter Your Business Tax ID</span> -->
                            </div>
                            
                            <div class="form-row">
                                <label class="form-label">Business Contact Details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <span class="form-label">Business Phone</span>
                                        <input type="text" name="phone" id="cphone"  />
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label">Business Email</span>
                                        <input type="text" name="email" id="cemail" />
                                        
                                    </div>

                                  
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">Business Location</label>
                                <div class="form-flex">

                                <div class="form-group">
                                        <span class="form-label"><b>Business Physical Address</b></span>
                                        <input type="text" name="address" id="add" />
                                        
                                       
                                    </div>
                               
                                    <div class="form-group">
                                    <span class="form-label"><b>Select Business State</b></span>
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
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                    <span class="form-label"><b>Select Business LGA</b></span>
                                    <select name="city" id="lga" class="custom-select select-lga">
                                        
                                    </select>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="location" class="form-label">Business Type</label>
                                    <select name="agent_type" id="agent_type" class="custom-select">
                                        <option selected disabled value="">Choose...</option>
                                        <option value="Private_Limited_Company">Private Limited Liability </option>
                                        <option value="Public_Limited_Company">Public Limited Liability </option>
                                        <option value="Public_Company_Limited_by_Guarantee">Non-Government Organization </option>
                                        <option value="Public_Unlimited_Company">Proprietor/Partnership</option>
                                        <option value="Private_Unlimited_Company">General Collection </option>
                                        <option value="Business_Name">Starter Business/SMEs</option>
                                        <option value="7">Betting/Lottery </option>
                                        <option value="8">Payment/Finance</option> 
                                    </select>
                            </div>     

                           
                        </div>
                    </fieldset>

                    <h3>Directors Details</h3>
                    <fieldset>
                        <h2>Directors Data</h2>
                        <p class="desc">Please enter your infomation and proceed to next step so we can build your account (For all directors with 5% or more shareholding)</p>
                    
                            <div class="form-row">
                                <label class="form-label">1st Business Director Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <span class="form-label">Select Identification Document</span>
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label">Enter Document Number</span>
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director Name</span>
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director BVN No</span>
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">2nd Business Director Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <span class="form-label">Select Identification Document</span>
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label">Enter Document Number</span>
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director Name</span>
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director BVN No</span>
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">3rd Business Director Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <span class="form-label">Select Identification Document</span>
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label">Enter Document Number</span>
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director Name</span>
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director BVN No</span>
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <label class="form-label">4th Business Director Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <span class="form-label">Select Identification Document</span>
                                    <select name="doc_type[]" id="doc_type" class="custom-select">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label">Enter Document Number</span>
                                        <input type="text" name="directordoc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director Name</span>
                                        <input type="text" name="directornamesc[]" id="directordoc" />
                                        
                                    </div>

                                    <div class="form-group">
                                        <span class="form-label">Enter Director BVN No</span>
                                        <input type="text" name="directorBVN[]" id="directorBVN" />
                                        
                                    </div>
                                </div>
                            </div>
                           
                            
                    </fieldset>

                    <h3>Documents Uploads</h3>
                    <fieldset>
                        <h2>Upload Your Business Documents</h2>
                        <p class="desc">Upload each of the documents below</p>
                        <div class="fieldset-content">
                        <div class="form-row">
                                <!-- <label class="form-label">Business Documents Uploads</label> -->
                                <div class="form-flex">
                                    <div class="form-group">
                                        <span class="form-label"><b>Certificate of Incorporation</b></span>
                                        <input type="file"  name="cert_of_coop" id="cert_of_coop" />
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                         <span class="form-label"><b>Proof of Address(Utility Bill)</b></span>
                                        <input type="file" name="address_proof" id="address_proof" />
                                        
                                    </div>
                                </div>

                                <div class="form-flex">
                                    <div class="form-group">
                                        <span class="form-label"><b>Memorandum & Articles of Association</b></span>
                                        <input type="file" name="memandart" id="memandart" />
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <span class="form-label"><b>Statement of Return on Allotment of Shares</b></span>
                                        <input type="file" name="stateofreturn" id="stateofreturn" />
                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="form-label"><b>Copy of Operating License</b></span>
                                        <input type="file" name="operatinglicense" id="stateofreturn" />
                                        
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