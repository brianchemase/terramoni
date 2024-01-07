<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Company Registration</title>
 
  </head>

  <body>
 
    <div class="card">
       <h5 class="card-header">Company Registration</h5>
       <div class="card-body">


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    

    

        <div class="card mb-3">
            <img class="card-img-top" src="https://images.unsplash.com/photo-1663601481084-da89a51c9c0e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1633&q=80" width="" height="300" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">TerraMoni Company Registration Portal</h5>
                <p class="card-text">Make your formal application for industrial attachment at your desired Huduma Centre or the Secretariat. A Text notification will be delivered to you upon successful completion of an application. You will again be notified on successfull selection</p>
                <p class="card-text"><small class="text-muted">Ensure You fill in all the required documents</small></p>
            </div>
        </div>
        

            <div class="container">
            <form method="POST" class="register-form" id="register-form" action="{{url('saveapplication')}}" enctype="multipart/form-data">
                @csrf
                <div class="container" align="center"><h1>Business Information </h1></div>
                <hr>
                <div class="form-row">
                    <div class="form-group  col-md-6">
                        <label for="name">Business/Company Name</label>
                        <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="cname" placeholder="Enter your Business Name as registered" value="{{ old('cname') }}">
                    </div>

                    <div class="form-group  col-md-6">
                        <label for="name">Bussiness/Company Registration Number</label>
                        <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="bussines_no" placeholder="Enter your Business Registration Number" value="{{ old('bussines_no') }}">
                    </div>

                    <div class="form-group  col-md-6">
                        <label for="name">Bussiness Tax ID</label>
                        <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="taxid" placeholder="Enter your Business Tax ID Number" value="{{ old('taxid') }}">
                    </div>

                <div class="form-group col-md-6">
                    <label for="inputState">Citizenship</label>
                    <select id="inputState" name="citizenship" class="form-control">
                    <option selected>Choose Citizenship...</option>
                    <option value="kenyan">Kenyan Citizen</option>
                    <option value="non-kenyan">Non-Kenyan Citizen</option>
                    </select>
                </div>

                <div class="form-group  col-md-6">
                <label for="name">Surname</label>
                <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="surname" placeholder="Enter Your Surname" value="{{ old('surname') }}">
                </div>

                <div class="form-group  col-md-6">
                <label for="name">First Name</label>
                <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="first_name" placeholder="Enter Your First Name" value="{{ old('first_name') }}">
                </div>

                <div class="form-group  col-md-6">
                <label for="name">Other Names</label>
                <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="other_names" placeholder="Enter Your Other Names" value="{{ old('other_names') }}">
                </div>

                

                <div class="form-group col-md-6">
                    <label for="inputState">Gender</label>
                    <select id="inputState" name="gender" class="form-control">
                    <option selected>Choose Gender...</option>
                    <option value="m">Male</option>
                    <option value="f">Female</option>
                    </select>
                </div>

                <div class="form-group  col-md-6">
                <label for="name">Phone</label>
                <input type="text" class="form-control" name="phone_number" placeholder="Enter Your Primary Phone (254700000000)" value="{{ old('phone_number') }}">
                </div>


                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control"   onkeyup="this.value = this.value.toUpperCase();" name="email" id="inputEmail4" placeholder="Email" value="{{ old('email') }}">
                </div>
                
                </div>

                <div class="container" align="center"><h1>School details </h1></div>
                <div class="form-group">
                <label for="schoolname">Institute/College Name</label>
                <input type="text" class="form-control" name="schoolname"  onkeyup="this.value = this.value.toUpperCase();" id="schoolname" placeholder="Enter Your School Name" value="{{ old('schoolname') }}">
                </div>
                <div class="form-group">
                    <label for="field">Field Of Study</label>
                    <select id="field" name="field_of_study" class="form-control">
                    <option selected>Choose...</option>
                    <option value="ict">Information Communication Technology</option>
                    <option value="compscience">Computer Science</option>
                    <option value="bussadmin">Bussiness Administration</option>
                    <option value="customer_care">Customer Care</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="inputAddress2">Course Name</label>
                <input type="text" class="form-control" name="course_name"  onkeyup="this.value = this.value.toUpperCase();" id="inputAddress2" placeholder="Enter Your course of study" value="{{ old('course_name') }}">
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputState">Attachment Duration</label>
                    <select id="inputState" name="attachement_duration" class="form-control">
                    <option selected>Choose Attachment Duration...</option>
                    <option value="3">3 months</option>
                    <option value="2">2 months</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputCity">Expected Start Date</label>
                    <input type="date" name="start_date"  class="form-control" id="inputCity" value="{{ old('start_date') }}">
                </div>
                

                
                <div class="form-group col-md-4">
                    <label for="inputZip">Area of Residence</label>
                    <input type="text" class="form-control" name="residence"  onkeyup="this.value = this.value.toUpperCase();" id="residence" placeholder="Enter Your Area of Residence" value="{{ old('residence') }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputCity">Letter from the school</label>
                    <input type="file" class="form-control" name="school_letter" id="school_letter" value="{{ old('school_letter') }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="inputCity">Insuarance Cover</label>
                    <input type="file" class="form-control" name="insuarance_cover" id="coverletter" value="{{ old('insuarance_cover') }}">
                </div>
                </div>

            

            
                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-save" aria-hidden="true">Submit application</i> </button>
            </form>
            

            </div>
  </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>