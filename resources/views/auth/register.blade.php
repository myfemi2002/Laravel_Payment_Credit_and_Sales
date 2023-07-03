<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <link rel="shortcut icon" href="customer/assets/images/favicon.png">
        <title>Register | DashLite Admin Template</title>
        <link rel="stylesheet" href="customer/assets/css/dashlite583f.css">
        <link href=" {{ asset('customer/assets/toaster/toastr.css') }}" rel="stylesheet" />
        <link id="skin-default" rel="stylesheet" href="customer/assets/css/theme583f.css">



        <style>
            .telephone-input-container {
            display: flex;
            align-items: center;
            }
            .country-select {
            margin-right: 10px;
            }
        </style>

    </head>
    <body class="nk-body bg-white npc-general pg-auth">
        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-lg">
                <div class="nk-content-body">
                    <div class="kyc-app wide-sm m-auto">
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="nk-kycfm">
                                    <div class="nk-kycfm-head">
                                        <div class="nk-kycfm-title">
                                            <h5 class="title">Register</h5>
                                            <p class="sub-title">Create New Account</p>
                                            <p class="mb-30">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                        </div>

                                    </div>
                                    <div class="nk-kycfm-content">
                                        <div class="nk-kycfm-note">
                                            <em class="icon ni ni-info-fill" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right"></em>
                                            <p>Please type carefully and fill out the form with your personal details. Your can’t edit these details once you submitted the form.</p>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}">@csrf
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Name <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="name" class="form-control form-control-lg" required>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Username <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="username" class="form-control form-control-lg" required>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('username')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Email Address <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="email" class="form-control form-control-lg" required>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('email')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Phone Number <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="telephone-input-container">
                                                        <div class="country-select">
                                                            <select id="country-code" name="country_code" class="form-select form-control-lg" required>
                                                                <option value="">Select Country</option>
                                                                {{-- <option value="country_code">Select Country</option> --}}
                                                            </select>
                                                        </div>
                                                        <input type="tel" id="phone" name="phone_number" class="form-control  form-control-lg" placeholder="Phone Number">
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('country_code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Gender <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <select name="gender" class="form-select form-control-lg">
                                                            <option value="" selected="" disabled="">-- Select --</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                            <option value="nonbinary">Non-Binary</option>
                                                            <option value="other">Other</option>
                                                        </select>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('gender')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Date of Birth <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="date_of_birth" class="form-control form-control-lg date-picker-alt">
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('date_of_birth')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Address <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <textarea type="text" name="address" class="form-control" rows="1" required style="min-height: 20px;" ></textarea>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Country <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <select id="country" name="country" class="form-select form-control form-control-lg">
                                                            <option value="">Select Country</option>
                                                        </select>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('country')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">City <span class="text-danger">*</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="city" class="form-control form-control-lg">
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Referral Code  <span class="text-danger">(Optional) </span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" name="referral_code" class="form-control form-control-lg">
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('city')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Password  <span class="text-danger">* </span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="password" name="password" class="form-control form-control-lg" required>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label"> Confirm Password  <span class="text-danger">* </span>
                                                        </label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                                                    </div>
                                                    <small class="form-control-feedback">
                                                        @error('password')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </small>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="nk-kycfm-footer">
                                        <div class="form-group">
                                            <div class="custom-control custom-control-xs custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="tc-agree">
                                                <label class="custom-control-label" for="tc-agree">I Have Read The <a href="#">Terms Of Condition</a> And <a href="#">Privacy Policy</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-control-xs custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="info-assure">
                                                <label class="custom-control-label" for="info-assure">All The Personal Information I Have Entered Is Correct.</label>
                                            </div>
                                        </div>
                                        <div class="nk-kycfm-action pt-2">
                                            <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="customer/assets/js/bundle583f.js"></script>
        <script src="customer/assets/js/scripts583f.js"></script>
        <script src="customer/assets/js/demo-settings583f.js"></script>
        <script src="customer/assets/js/charts/chart-crypto583f.js?ver=3.1.3"></script>
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <!-- Toaster js -->
        <script src="{{ asset('customer/assets/toaster/toastr.min.js') }}"></script>

        <script>

            @if (Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch (type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
            }

            @endif
        </script>

        <script>
            $(document).ready(function() {
              function populateCountrySelect() {
                $.ajax({
                  url: 'https://restcountries.com/v2/all',
                  method: 'GET',
                  success: function(data) {
                    var select = $('#country-code');
                    select.empty();
                    select.append('<option value="">Select Country</option>');
                    data.forEach(function(country) {
                      var countryCode = country.alpha2Code;
                      var countryName = country.name;
                      var countryPrefix = country.callingCodes[0];
                      select.append($('<option>').val(countryPrefix).text(countryName + ' (+' + countryPrefix + ')'));
                    });
                  },
                  error: function(error) {
                    console.error(error);
                  }
                });
              }

              populateCountrySelect();

              var isInputFocused = false;

              $('#phone').on('input', function() {
                if (!isInputFocused) {
                  var phoneNumber = $(this).val();
                  if (phoneNumber.length < 6) { // Assuming minimum phone number length is 6
                    populateCountrySelect();
                  } else {
                    $('#country-code').val('').text('Select Country');
                  }
                }
              });

              $('#phone').on('focus', function() {
                isInputFocused = true;
              });

              $('#phone').on('blur', function() {
                isInputFocused = false;
              });
            });
        </script>

          <script>
            // Fetch countries
            $.ajax({
              url: 'https://restcountries.com/v3.1/all',
              method: 'GET',
              success: function(data) {
                var selectCountry = $('#country');
                selectCountry.empty();
                selectCountry.append('<option value="">Select Country</option>');
                data.forEach(function(country) {
                  selectCountry.append($('<option>').val(country.name.common).text(country.name.common));
                });
              },
              error: function(error) {
                console.error(error);
              }
            });

            // Fetch cities for the selected country
            $('#country').on('change', function() {
              var selectedCountry = $(this).val();
              if (selectedCountry) {
                $.ajax({
                  url: 'https://countriesnow.space/api/v0.1/countries',
                  method: 'POST',
                  data: {
                    country: selectedCountry
                  },
                  success: function(data) {
                    var selectCity = $('#city');
                    selectCity.empty();
                    selectCity.append('<option value="">Select City</option>');
                    var cities = data.data[0].cities;
                    if (cities) {
                      cities.forEach(function(city) {
                        selectCity.append($('<option>').val(city).text(city));
                      });
                    }
                  },
                  error: function(error) {
                    console.error(error);
                  }
                });
              } else {
                $('#city').empty();
              }
            });
          </script>

<script>
    $(document).ready(function() {
        // Function to check if both checkboxes are ticked
        function checkCheckboxes() {
            var isChecked1 = $('#tc-agree').is(':checked');
            var isChecked2 = $('#info-assure').is(':checked');
            return isChecked1 && isChecked2;
        }

        // Disable or enable the submit button based on checkbox status
        function toggleSubmitButton() {
            var submitButton = $('button[type="submit"]');
            submitButton.prop('disabled', !checkCheckboxes());
        }

        // Toggle submit button on checkbox change
        $('#tc-agree, #info-assure').on('change', function() {
            toggleSubmitButton();
        });

        // Initial state of submit button
        toggleSubmitButton();
    });
</script>
</html>
