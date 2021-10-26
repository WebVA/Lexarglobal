@extends('layout.home')

@section('style')
<style>
    .hero {
        /* background: linear-gradient(45deg, #262262, #9ec9ff); */
        background-color: #262262;
    }
    .checkSelect {
        margin-right: 15px;
    }
    .cus-label-1 {
        padding-left: 20px;
        text-align: end;
        margin-right: 30px;
    }
</style>
@endsection('style')

@section('content')
    <!-- Hero Section-->
    <section class="hero hero-page">
        <div class="container">
          <div class="row d-flex">
            <div class="col-lg-9 order-2 order-lg-1" style="display: flex;align-self: center;">
              <h4 style="color:white;margin: 0;">Contact Us</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">Contact Us</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <main class="contact-page">
        <!-- Contact page-->
        <section style="margin-top:50px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                      <p>Dedicated to you ! <br>
                          <br>
                          As a distributor, you get the best of everything. We offer top-notch products at rock bottom prices, but then we take it even further. Our company-wide dedication to accountability, and total distributor satisfaction is what really defines our business. That is why we have so many repeat customers! We welcome your questions, and feedback at any time!&nbsp;</p>
                        <p><br>
                          * Lexar Global works only with Ad Specialty member distributors. Your identity will be verified before contacting you.</p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <header class="mb-5" style="display: flex;align-items: baseline;">
                  <h3 class="heading-line">Contact Form </h3>
                </header>
                <div class="row">
                    <div class="col-md-12">
                        <form id="contact-form" method="post" action="/user/contactus" class="custom-form form">
                            @csrf
                            <div class="controls col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name" class="form-label" style="padding-left: 0px">Full Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" id="name"
                                            required="required" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="cname" class="form-label" style="padding-left: 0px">Company Name <span style="color: red">*</span></label>
                                        <input type="text" name="cname" id="cname"
                                            required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pos_com" class="form-label" style="padding-left: 0px">Position in Company</label>
                                        <input type="text" name="pos_com" id="pos_com" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="inum" class="form-label" style="padding-left: 0px">Industry affiliation number: ASI,SAGE,PPAI <span style="color: red">*</span></label>
                                        <input type="text" name="inum" id="inum" placeholder="Your Identity will be verified"
                                            required="required" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="office_phone" class="form-label" style="padding-left: 0px">Office Phone Number <span style="color: red">*</span></label>
                                        <input type="text" name="office_phone" id="office_phone" required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="mobile_phone" class="form-label" style="padding-left: 0px">Mobile Phone Number  </label>
                                        <input type="text" name="mobile_phone" id="mobile_phone"  class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email1" class="form-label" style="padding-left: 0px">eMail address <span style="color: red">*</span></label>
                                        <input type="email" name="email1" id="email1" required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email2" class="form-label" style="padding-left: 0px">eMail address</label>
                                        <input type="email" name="email2" id="email2" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="adr1" class="form-label" style="padding-left: 0px">Address 1 <span style="color: red">*</span></label>
                                        <input type="text" name="adr1" id="adr1" required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="adr2" class="form-label" style="padding-left: 0px">Address 2 </label>
                                        <input type="text" name="adr2" id="adr2" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="city" class="form-label" style="padding-left: 0px">City <span style="color: red">*</span></label>
                                        <input type="text" name="city" id="city" required="required" class="form-control" />
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="state" class="form-label" style="padding-left: 0px">State <span style="color: red">*</span></label>
                                        <select id="state" name="state" class="form-control" required="required">
                                            <option></option>
                                            @foreach ($state as $item)
                                                <option value="{{ $item->abbr }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="zip" class="form-label" style="padding-left: 0px">Zip Code <span style="color: red">*</span></label>
                                        <input type="text" name="zip" id="zip" required="required" class="form-control" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="message" class="form-label" style="padding-left: 0px">Comments</label>
                                        <textarea rows="4" name="message" id="message" placeholder="Enter your message" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="" style="display: flex;">
                                        <p class='cus-label-1'>Preffered method of contact: </p>
                                        <div style="display: flex;">
                                            <div class="checkSelect">
                                                <input type="checkbox" id="pemail" name="pemail">
                                                <label class='cus-label'>email</label>
                                            </div>
                                            <div class="checkSelect">
                                                <input type="checkbox" id="pphone" name="pphone">
                                                <label class='cus-label'>Phone</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <p style="padding-left: 20px;">
                                      Privacy information: Lexar Global, LLC does not sell, or share any information collected on this website, in part or in whole. Lexar Global, LLC uses this information to provide better solutions, products, and offerings.
                                  </p>
                                </div>
                                <div class="row">
                                    <p style="padding-left: 20px;">
                                        <span style="color: red">*</span>Fields with red dot represent mandatory fields
                                    </p>
                                </div>
                                <div class="row" style="align-items: center; padding: inherit;">
                                    <div class="g-recaptcha" data-sitekey="6Lcj6HMbAAAAACXXvS6LYYXE23uhvktfi3vb7JCz"></div>
                                    <button type="submit" class="btn btn-template" style="margin-left: 30px;">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
<script>
$("#contact-form").submit(function(event) {

var recaptcha = $("#g-recaptcha-response").val();
if (recaptcha === "") {
   event.preventDefault();
   alert("Please check the recaptcha");
}
});
</script>
@endsection