@extends('layout.home')

@section('style')
<style>
    .flex_form {
        display: flex;
        align-content: center;
        align-items: center;
    }
    
    .flex_form label {
        width: 300px;
    }

    .btn-register {
        background-color: rgb(18, 16, 119);
        border-radius: 15px;
        height: 50px;
        color:white;
    }

    .hero {
        /* background: linear-gradient(45deg, #262262, #9ec9ff); */
        background-color: #262262;
    }

</style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
          <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
              <h4 style="color:white;margin: 0;">Register</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Register</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <!-- text page-->
    <section class="padding-small">
      <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>New Distributor Registration</h3><br>
                <p class="text-muted">
                    Registration is ONLY for Ad Specialty distributors. Your industry affiliation will be verified
                    and strickly enforced. <br>
                    If you ARE NOT ASI, SAGE, PPAI or UPIC member, we will remove your registration information.
                </p>
                <p class="text-muted">(* marked fields are mandatory.)</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8" style="background: #f2f3f4; padding: 15px; border: 1px solid rgb(112 112 112 / 65%);">
                <form id="register-form" class="content-block" onSubmit="return validate()" action="/user/register_api" method="post">
                @csrf
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="company_name" class="form-label">*Company Name</label>
                        <input id="company_name" name="company_name" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="firstname" class="form-label">*First Name</label>
                        <input id="firstname" name="firstname" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="lastname" class="form-label">*Last Name</label>
                        <input id="lastname" name="lastname" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="email" class="form-label">*Email</label>
                            <input id="email" name="email" type="email" class="form-control"  required>
                        </div>
                        </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="password" class="form-label">*Password</label>
                        <input id="password" name="password" type="password" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group" style="possition:relative;">
                        <label for="confirm_password" class="form-label">*Confirm Password</label>
                        <input id="confirm_password" name="confirm_password" type="password" class="form-control" onclick="hide_label()" required>
                        </div>
                        <label id="alertlabel" style="color: red; position: absolute; top: 3px; left: 260px; display:none;">password not matched!</label>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="industry_number" class="form-label">ASI</label>
                            <input id="industry_number" name="industry_number" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="sage_number" class="form-label">SAGE</label>
                            <input id="sage_number" name="sage_number" type="text" class="form-control" >
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="phone_number" class="form-label">*Phone Number</label>
                        <input id="phone_number" name="phone_number" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="fax_number" class="form-label">Fax Number</label>
                        <input id="fax_number" name="fax_number" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="cell_number" class="form-label">Cell Phone Number</label>
                            <input id="cell_number" name="cell_number" type="text" class="form-control">
                        </div>
                        </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="address" class="form-label">*Address</label>
                        <input id="address" name="address" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                        <label for="city" class="form-label">*City</label>
                        <input id="city" name="city" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="zip" class="form-label">*Zip</label>
                            <input id="zip" name="zip" type="text" class="form-control"  required>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="state" class="form-label">*State</label>
                            <select id="state" name="state" class="form-control">
                                @foreach($state as $item)
                                <option value="{{$item->abbr}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="flex_form form-group">
                            <label for="country" class="form-label">*Country</label>
                            <select id="country" name="country" class="form-control">
                                @foreach($country as $item)
                                <option value="{{$item->abbr}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12" style="display: flex;align-items: center; padding: inherit;justify-content: flex-end;padding-right: 15px;">
                        <div class="g-recaptcha" data-sitekey="6Lcj6HMbAAAAACXXvS6LYYXE23uhvktfi3vb7JCz"></div>
                        <button class="btn btn-template" type="submit" style="margin-left: 30px;">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
<script>
    function validate(){
        if($("#password").val() == $("#confirm_password").val()){
            return true;
        }
        else{
            $("#confirm_password").val('');
            $("#alertlabel").show();
            return false;
        }
    }

    function hide_label(){
        $("#alertlabel").hide();
    }

    $("#register-form").submit(function(event) {

        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            alert("Please check the recaptcha");
        }   
    });
</script>
@endsection