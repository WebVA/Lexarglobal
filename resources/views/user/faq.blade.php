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
            <h4 style="color:white;margin: 0;">FAQ</h4>
          </div>
          <div class="col-lg-3 text-right order-1 order-lg-2">
            <ul class="breadcrumb justify-content-lg-end">
              <li class="breadcrumb-item"><a href="index.html" style="color:white">Home</a></li>
              <li class="breadcrumb-item active" style="color:white">FAQ</li>
            </ul>
          </div>
        </div>
      </div>
  </section>

  <!-- FAQ-->
  <section class="padding-small">
      <div class="container">
        <header>
          <p class="lead text-muted">
          Welcome to Lexar Global, LLC </h2>
          <br>
              </p>
          Here you will find answers to the most common questions about Lexar Global and services provided.
          <br>
          Should you have any questions not covered in this section, please email customer service at support@lexarglobal.com
          <br>
            </p>
          Thank You.                 
          <br>
              </p>
        </header>
          
        <hr>
        <div class="py-4">
          <div class="row">
            <div class="col-md-12">
              <div class="privacy-text pr-lg-3 pr-md-0 pr-0">
                <div class="accordion" id="accordionFaq">
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                    <i class="fa fa fa-chevron-right"></i><b> Who we are?</b>
                    </button>
                  <div id="collapse1" class="collapse" data-parent="#accordionFaq">
                    <div class="card-body">
                      Welcome to Lexar Global, LLC website, the internet's most comprehensive source of business gifts, trusted by a wide range of USA distributors. Lexar Global, LLC Founded in the heart of New York state as a promotional product suppler with ASI, SAGE, PPAI and UPIC. We believe that whatever type of business you work for, and whatever the size of your company, our service can add value to your marketing and promotional gifts campaign. We work hard to provide our clients with quality products at competitive prices combined with an attentive, fast and friendly service. Lexar Global, LLC has rapidly expanded year on year due to our keenness to satisfy our customers' needs & take pride in what we do.
                    </div>
                  </div>
                </div> <!-- /.card -->
                  <div class="card">
                      <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                      <i class="fa fa fa-chevron-right"></i><b> Is my credit card and Account Info secured?</b>
                      </button>
                    <div id="collapse2" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. does not accept payments online, however our office is utilizing latest technologies and complying with PCI standards, Lexar Global, LLC. guarantees your Credit card information. PC compliance is a set of security standards created by the major credit card companies to protect their customers from identity theft and security breaches. Under the PCI Data Security Standards, we can assure you that your credit card data, account information and transaction information are safe from hackers or any malicious system intrusion.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                    <i class="fa fa fa-chevron-right"></i><b> How can I find out about specials?</b>
                    </button>
                    <div id="collapse-3" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC..com has created a simple to apply for newsletter and specials subscription, just go to the home page and join the newsletter. We will make sure to provide you with the latest trends, news and specials Lexar Global, LLC. will run.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                    <i class="fa fa fa-chevron-right"></i><b> Shipping and Delivery, Methods used</b>
                    </button>
                    <div id="collapse-4" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Utilizing UPS services for most orders enables us to pass the savings onto you, the customer. For special orders, large orders, we can use FedEx or trucking to save on shipping costs.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                    <i class="fa fa fa-chevron-right"></i><b> Can I have my order shipped to multiple addresses?</b>
                    </button>
                    <div id="collapse-5" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        After placing an order, please contact Lexar Global, LLC. customer service sending send an email to support@ Lexar Global, LLC..com, please indicate customer name and order number. Include all your shipping and timing information. You will be promptly notified on receipt of your request.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">
                    <i class="fa fa fa-chevron-right"></i><b> How can I get my order faster after order was placed?</b>
                    </button>
                    <div id="collapse-6" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        After placing an order, please contact Lexar Global, LLC. customer service either by fax or send an email to support@ Lexar Global, LLC..com, please indicate customer name and order number. Include all your shipping and timing information. You will be promptly notified on new method of shipping and the price difference between the old method and new.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">
                    <i class="fa fa fa-chevron-right"></i><b> What are normal production and delivery times?</b>
                    </button>
                    <div id="collapse-7" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Production time varies from product to product. It largely depends on purchased product availability, it’s location and customers final destination. All item delivery and production time estimates will be given after receipt of your art work and it’s approval.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-8" aria-expanded="false" aria-controls="collapse-8">
                    <i class="fa fa fa-chevron-right"></i><b> What happens if a product is backordered?</b>
                    </button>
                    <div id="collapse-8" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. customer service will do all it can do to fulfill your order as soon as possible, however, some product availability might be delayed for any unforeseen reason, we will notify you immediately and make a decision with you on the appropriate action to provide you with similar item or alternate item.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-9" aria-expanded="false" aria-controls="collapse-9">
                    <i class="fa fa fa-chevron-right"></i><b> What are the standard minimum order quantities?</b>
                    </button>
                    <div id="collapse-9" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        We have made all effort to specify minimum order quantities on the website. <br>If you order and item without imprint, in most cases minimum quantity is set to 1. <br>products with imprint show the minimum quantity as default. If your needs are different than those indicated, please contact us, we’ll do all we can to accommodate your request.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-10" aria-expanded="false" aria-controls="collapse-10">
                    <i class="fa fa fa-chevron-right"></i><b> What are the standard setup charges and time?</b>
                    </button>
                    <div id="collapse-10" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Screen and setup charges: $50.00(v) per color. <br>
                        Non-imprinted: <br>
                        1 to 3 days <br>
                        <br>
                        Imprinted: <br>
                        10 to 15 days <br>
                        Custom Medallion Watch: <br>
                        6 weeks (new medallion) <br>
                        4 weeks (re-order) <br>
                        Providing inventory is in stock
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-11" aria-expanded="false" aria-controls="collapse-11">
                    <i class="fa fa fa-chevron-right"></i><b> What payment options are available?</b>
                    </button>
                    <div id="collapse-11" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Overstock merchandise:
                        Price is for blank goods and while supplies last.
                        An additional running charge applies (depending on the item)
                        plus a setup charge for a one color imprint.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-12" aria-expanded="false" aria-controls="collapse-12">
                    <i class="fa fa fa-chevron-right"></i><b> Why is sales tax added to my order?</b>
                    </button>
                    <div id="collapse-12" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. has made payment process easy and secure. While accepting major credit cards, we are able to process payments over the phone with eCheck service. For special orders or in some cases you can mail the check to our offices, once the check clears we will start with the process of your order.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-13" aria-expanded="false" aria-controls="collapse-13">
                    <i class="fa fa fa-chevron-right"></i><b> Art Specifications and policy</b>
                    </button>
                    <div id="collapse-13" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. has made payment process easy and secure. While accepting major credit cards, we are able to process payments over the phone with eCheck service. For special orders or in some cases you can mail the check to our offices, once the check clears we will start with the process of your order.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-14" aria-expanded="false" aria-controls="collapse-14">
                    <i class="fa fa fa-chevron-right"></i><b> What type of file formats can I submit for use?</b>
                    </button>
                    <div id="collapse-14" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. is operating out of NY state. We do not collect sales tax from our customers, we require your tax ID number associated with your industry number.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-15" aria-expanded="false" aria-controls="collapse-15">
                    <i class="fa fa fa-chevron-right"></i><b> Are there any file types you prefer that I don't submit?</b>
                    </button>
                    <div id="collapse-15" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        There is a onetime $40.00(v) art charge to create your artwork in a vector usable format. What does your one-time art charge allows you to:
                        Store this artwork in our servers, for use on future products
                        Use this artwork on any other product or re-order
                        Please read point 14 for art specifications.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-16" aria-expanded="false" aria-controls="collapse-16">
                    <i class="fa fa fa-chevron-right"></i><b> Can I use a specific font in my artwork?</b>
                    </button>
                    <div id="collapse-16" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        At Lexar Global, LLC. art department, we can work with any kind of art: emailed art, downloaded art, or even a mailed hard copy of your art. When you send us your art, a member of our art department will personally handle your project to ensure it turns out exactly how you envisioned it. <br>
                        To make the imprint process as fast and efficient as possible, we prefer artwork to be submitted in vector format: <br>
                        Adobe Illustrator .EPS or .AI files
                        Adobe PhotoShop (all versions), (300 dpi or higher) .PSD files
                        High resolution (300 dpi or higher) .JPG, .TIFF or .PNG files
                        CorelDraw (300 DPI or higher) .CDR files
                        <br> 
                        Please email artwork to art@LexarGlobal.com , please include order number, part number of the item for imprint.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-17" aria-expanded="false" aria-controls="collapse-17">
                    <i class="fa fa fa-chevron-right"></i><b> Can I use my own PMS color?</b>
                    </button>
                    <div id="collapse-17" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        We want to ensure that your logo or artwork is represented in the best possible way. Therefore, the following file types will require more attention and may slow the process of your order: Files set up for Web presentation, such as low-resolution JPEG, GIF, PNG etc. These graphics are made to load quickly, resulting in a lower quality image. Any artwork imported into a word processing program such as Microsoft Word, WordPerfect, PowerPoint, Publisher, etc
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-18" aria-expanded="false" aria-controls="collapse-18">
                    <i class="fa fa fa-chevron-right"></i><b> How long will you keep my artwork on your servers?</b>
                    </button>
                    <div id="collapse-18" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. art department has access to thousands of fonts to provide you with the perfect font choice. If a specific font is used in your artwork, please e-mail the font file (in a true type font) to art department art@LexarGlobal.com. If you are submitting an .EPS or .AI file, please make sure all fonts are outlined and converted to vector format in your artwork file.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-19" aria-expanded="false" aria-controls="collapse-19">
                    <i class="fa fa fa-chevron-right"></i><b> Can I add, cancel or delete items on my order if I change my mind?</b>
                    </button>
                    <div id="collapse-19" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. art department has full PMS color-matching ability unless otherwise stated. If PMS color-matching is not possible on an item, the closest available color will be selected. One of our graphic design members can help you select imprint colors for the best presentation of your artwork.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-20" aria-expanded="false" aria-controls="collapse-20">
                    <i class="fa fa fa-chevron-right"></i><b> Can I get a sample of the product?</b>
                    </button>
                    <div id="collapse-20" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Your digital artwork will be kept on file for as long as your account stays active. And remember, when you use an existing logo on a new product or reorder, you will not be charged additional art fees.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-21" aria-expanded="false" aria-controls="collapse-21">
                    <i class="fa fa fa-chevron-right"></i><b> Am I limited to the items shown on the website or can I request different items?</b>
                    </button>
                    <div id="collapse-21" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Lexar Global, LLC. staff is committed to provide fastest service to you. We process all received orders immediately to save time. If you will inform us either by phone or by email within 24hrs after placing order, we will do all we can to modify your order. If the order is a repeat order, we might process your process immediately, in this case modification to the order will not be possible. Please contact our for any change request as soon as possible.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-22" aria-expanded="false" aria-controls="collapse-22">
                    <i class="fa fa fa-chevron-right"></i><b> What if I want a larger or smaller quantity than those listed on the site?</b>
                    </button>
                    <div id="collapse-22" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Yes, you can order a sample, just place an order for one item without imprint..
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-23" aria-expanded="false" aria-controls="collapse-23">
                    <i class="fa fa fa-chevron-right"></i><b> What if I receive more or less than I ordered?</b>
                    </button>
                    <div id="collapse-23" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        We, at Lexar Global, LLC. are actively seeking new ideas and products to provide you with variety and choices. If you have seen an item somewhere else or have idea of a product you want, please contact us ether by mail: support@LexarGlobal.com.
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-24" aria-expanded="false" aria-controls="collapse-24">
                    <i class="fa fa fa-chevron-right"></i><b> What is your return policy?</b>
                    </button>
                    <div id="collapse-24" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Since we can’t put all available price range grid on the website, please contact us with any other request ether by mail: support@LexarGlobal.com
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-25" aria-expanded="false" aria-controls="collapse-25">
                    <i class="fa fa fa-chevron-right"></i><b> Can I order a print catalog?</b>
                    </button>
                    <div id="collapse-25" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                        Since all product imprint is done by machines, it is possible to either overrun or under run and order. It not uncommon to have a quantity variation of 1-5%. Please contact us immediately upon receipt of your order with any questions or concerns. We will do all we can to solve the issue immediately.
                        <br> <br>
                        Since all of our products are personalized, we are unable to accept returns. If you feel your order was produced incorrectly, please email us at support@LexarGlobal.com within 30 days of the invoice date. If it is determined there is a material or manufacturing defect with your order, we will issue a RMA and accept your return. Upon receipt of your RMA product, out expert customer service, art department and quality control team will evaluate the items. You will be promptly informed of our finding and decision.
                         <br> <br>
                        All claims for shortages, loss or non-delivery must be made within 10 days from the date of the invoice. Claims for damages in transit must be made with the individual carrier when you receive the shipment, so please save all shipping boxes for inspection. Please take photos and email our customer service team at support@LexarGlobal.com .
                      </div>
                    </div>
                  </div> <!-- /.card -->
                  <div class="card">
                    <button class="cloaapsBtn collapsed" type="button" data-toggle="collapse" data-target="#collapse-26" aria-expanded="false" aria-controls="collapse-26">
                    <i class="fa fa fa-chevron-right"></i><b> How can I contact Lexar Global, LLC..com directly?</b>
                    </button>
                    <div id="collapse-26" class="collapse" data-parent="#accordionFaq">
                      <div class="card-body">
                      Lexar Global, LLC. is a web based company. We do not have a full printed catalog. All of our product line is on the website. You can request PDF version of our products. Please call or email out customer support team with your request at LexarGlobal.com. <br> <br>
                      We are Ad Specialty supplier, please use your distributor access tools to find our contact information. You can reach us via email support@LexarGlobal.com. All inquiries will be verified prior to call back.
                      Thank you for visiting Lexar Global, LLC..com
                      <br> <br>
                      management
                      </div>
                    </div>
                  </div> <!-- /.card -->
                </div>
              </div> <!-- /.privacy-text -->
          </div>
        </div>
      </div>
    </section>
@endsection

@section('script')
<script>
    $(function(){
        var $grid = $('.masonry-wrapper').masonry({
            itemSelector: '.item',
            columnWidth: '.item',
            percentPosition: true,
            transitionDuration: 0,
        });
    
        $grid.imagesLoaded().progress( function() {
            $grid.masonry();
        });
    })
    $('.cloaapsBtn').on('click', function() {
    $('.cloaapsBtn').each(function() {
        $(this).find('i').removeClass('.fa fa-chevron-down');
        $(this).find('i').addClass('.fa-angle-right');
    })
    if($(this).hasClass('collapsed')){
        $(this).find('i').removeClass('.fa-angle-right');
        $(this).find('i').addClass('.fa fa-chevron-down');
    }
    
    })
</script>
@endsection