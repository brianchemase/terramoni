<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css">
  <title>Registration Form</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title text-center">Registration Form</h3>
          </div>
          <div class="card-body">
            <form action="/register" method="POST">
              @csrf
              <div class="row">
                    <div class="form-group">
                        <label for="cname" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter your company name" required>
                    </div>
                    <br>
                        <h5 class="card-title text-center">Company Profile</h5>
                    <hr>
                    <div class="form-group col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
              </div>
              <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" name="country" required>
                        <option value="">Select Country</option>
                        <option value="USA">USA</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">UK</option>
                        </select>
                    </div>
             
                    <div class="form-group col-md-6">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="file" name="file" required>
                    </div>



                        <div class="form-group col-md-6">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
              </div>

              <div class="row">
                    
                    <br>
                    <br>
                        <h5 class="card-title text-center">Company Directors Profile</h5>
                    <hr>
                    <!-- directors details start -->
                    <div class="form-group col-md-4">
                        <label for="country" class="form-label">Document Type</label>
                        <select class="form-select" id="country" name="country" required>
                        <option value="">ID No</option>
                        <option value="USA">Drivers Licence</option>
                        <option value="Canada">Canada</option>
                        <option value="UK">UK</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dname" class="form-label">Director Name</label>
                        <input type="text" class="form-control" id="dname[]" name="dname[]" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="docno" class="form-label">Doc No</label>
                        <input type="docno" class="form-control" id="docno" name="docno" required>
                    </div>

                    <!-- directors details end -->
                    
              </div>
              <br>

              
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
