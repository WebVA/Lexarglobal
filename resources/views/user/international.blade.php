@extends('layout.home')

@section('style')
<style>
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
              <h4 style="color:white;margin: 0;">International Customers</h4>
            </div>
            <div class="col-lg-3 text-right order-1 order-lg-2">
              <ul class="breadcrumb justify-content-lg-end">
                <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
                <li class="breadcrumb-item active" style="color:white">International Customers</li>
              </ul>
            </div>
          </div>
        </div>
    </section>

    <!-- policy-->
    <section class="padding-small">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="privacy-text pr-lg-3 pr-md-0 pr-0">
              <h2 class="pp-title fz20">International customers.&nbsp;</h2>
<p>Means of Prepayment: Lexar Global, LLC only accepts prepayment via wire transfer from all international customers.&nbsp;</p>
<p>Please note for all international incoming wires payments there is a $25.00 (Z) service fee&nbsp;</p>
<p>Shipping internationally: Lexar Global, LLC does not ship internationally, as our systems are not setup for this option. For any orders that must ship international, we require all distributors to prep all the shipping labels, commercial invoices, schedule pickup from Lexar Global etc... on their end. Then the distributor needs to send all shipping labels, commercial invoice, BOL, etc... to Lexar Global in a PDF format, this way all we need to do is apply them to the shipping cartons/and or shipment, and then hand the shipping cartons/and or shipment off to the currier or trucking. &nbsp;</p>
</div>
          </div>
          <div class="col-lg-6 col-md-12 pun mt-4 mt-lg-0 mt-md-4">
            <div class="privacy-content-images">
              <img src="assets/img/about-us-1.png" alt="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12"> </div>
          <div class="col-lg-6 col-md-12 pun mt-4 mt-lg-0 mt-md-4">
            <div class="privacy-content-images">
              <img src="assets/img/about-us-2.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
<script>

</script>
@endsection