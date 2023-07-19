<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="wizard/fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="wizard/vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="wizard/css/style.css">
</head>

<body>

    <div class="main">

        <div class="container">
            <form method="POST" id="signup-form" class="signup-form" action="#">
                <div>
                    <h3>Company info</h3>
                    <fieldset>
                        <h2>Company information</h2>
                        <p class="desc">Please enter your infomation and proceed to next step so we can build your account</p>
                        <div class="fieldset-content">
                             <div class="form-group">
                                <label for="email" class="form-label">Comapny Name</label>
                                <input type="email" name="email" id="email" placeholder="Enter your Company name as registered" />
                                <span class="text-input">Enter Your Company name as registered with the authorities</span>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Company Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                        <input type="text" name="first_name" id="first_name" />
                                        <span class="text-input">Enter Company Phone</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone" class="form-label">Location</label>
                                <input type="text" name="phone" id="phone" />
                            </div>

                            <div class="form-group">
                                <label for="state" class="form-label">State</label>
                                <input type="text" name="state" id="state" />
                            </div>

                            <div class="form-group">
                                <label for="Country" class="form-label">Country</label>
                                <input type="text" name="Country" id="Country" />
                            </div>
                            
                            
                           
                        </div>
                    </fieldset>

                    <h3>Directors Details</h3>
                    <fieldset>
                        <h2>Directors Data</h2>
                        <p class="desc">Please enter your infomation and proceed to next step so we can build your account</p>
                    
                        <div class="form-row">
                                <label class="form-label">Company Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type" id="doc_type">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Enter Company Phone</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Company Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type" id="doc_type">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Enter Company Phone</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <label class="form-label">Company Contact details</label>
                                <div class="form-flex">
                                    <div class="form-group">
                                    <select name="doc_type" id="doc_type">
                                        <option value="NIN">NIN</option>
                                        <option value="DL">Driving Licence</option>
                                        <option value="VotingCard">Voters Card</option>
                                        <option value="Passport">International Passport</option>
                                    </select>
                                        <span class="text-input">Enter Company Phone</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="last_name" id="last_name" />
                                        <span class="text-input">Enter Company Email</span>
                                    </div>
                                </div>
                            </div>
                            
                    </fieldset>

                    <h3>Documents Uploads</h3>
                    <fieldset>
                        <h2>Upload Your Organization documents</h2>
                        <p class="desc">Upload your documents from here</p>
                        <div class="fieldset-content">
                        <div class="form-group">
                                <label for="ssn" class="form-label">Certificate of Incooperation</label>
                                <input type="file" name="ssn" id="ssn" />
                            </div>
                            <div class="form-group">
                                <label for="ssn" class="form-label">Proof of address</label>
                                <input type="file" name="ssn" id="ssn" />
                            </div>

                        <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" />
                                <span class="text-input">Example  :<span>  Jeff@gmail.com</span></span>
                            </div>
                           
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>

    </div>

    <!-- JS -->
    <script src="wizard/vendor/jquery/jquery.min.js"></script>
    <script src="wizard/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="wizard/vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="wizard/vendor/jquery-steps/jquery.steps.min.js"></script>
    <script src="wizard/vendor/minimalist-picker/dobpicker.js"></script>
    <script src="wizard/vendor/nouislider/nouislider.min.js"></script>
    <script src="wizard/vendor/wnumb/wNumb.js"></script>
    <script src="wizard/js/main.js"></script>
</body>

</html>