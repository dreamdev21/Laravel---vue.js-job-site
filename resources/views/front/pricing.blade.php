@extends('master')

@section('main_section_class', 'pricing-section')
@section('sub_section_class','container custom-container')
@section('top_content')
  <div class="row">
    <div class="col-12 text-center">
      <div class="d-block d-md-inline-block pricing-block">
        <label>
          <div>
            <input name="package" type="radio" value="1" />
            <div class="pricing-top-block">
              <h3 class="text-green block-main-title">
                Gameplay Package
              </h3>
            </div>
            <div class="pricing-bottom-block">
              <p class="help-txt">
                Are you a publisher with big VR dreams? We can help you play test with this package!
              </p>
              <h4 class="text-uppercase text-green block-small-title">
                Included:
              </h4>
              <ul>
                <li>
                  Online report
                </li>
                <li>
                  Publisher portal
                </li>
                <li>
                  Rubric and personalized question area
                </li>
                <li>
                  In app recordings
                  <br>(Min: 15 minutes/Max: 1 hour)
                </li>
              </ul>
              <h4 class="text-uppercase text-green block-small-title">
                Pricing:
              </h4>
              <p class="special-price-txt">
                SPECIAL PRICING FOR 1
                <sup>st</sup> TIME ORDERS Limited Time Offer
              </p>
              <p class="">
                $40/Tester
              </p>
              <h4 class="text-uppercase text-green block-small-title">
                STANDARD PRICING:
              </h4>
              <p class="">

                $80/Tester
                <br> $375/5 Testers
              </p>
              <a href="#" class="btn green-btn order-btn" data-toggle="modal" data-target="#publisherSignup" data-dismiss="modal">
                order now
              </a>
            </div>
          </div>
        </label>
      </div>
      <div class="d-block d-md-inline-block pricing-block active">
        <label>
          <div>
            <input name="package" type="radio" value="2" checked />
            <div class="pricing-top-block">
              <h3 class="text-green block-main-title">
                Premium Hourly Package
              </h3>
            </div>
            <div class="pricing-bottom-block">
              <p class="help-txt">
                Do you need a bit more flexibility and customized testing to meet your needs? We can help you with this package!
              </p>
              <h4 class="text-uppercase text-green block-small-title">
                Included:
              </h4>
              <ul>
                <li>
                  Same as Gameplay Package
                </li>
                <label class="text-uppercase">
                  plus :
                </label>
                <li>
                  In app recordings
                  <span>
                    <br> (Min: 90m /Max: 4.5 hrs monthly ) </span>
                </li>
                <li>
                  Downloadable Full Report
                </li>
                <li>
                  Choose from testing services menu
                </li>
                <li>
                  Dedicated Account Manager
                </li>
                <li>
                  Full development lifecycle testing
                </li>
              </ul>
              <h4 class="text-uppercase text-green block-small-title">
                Pricing:
              </h4>
              <p class="">
                <span>Pay as You Go: </span>$420
              </p>
              <p class="">
                <span>Subscription: </span>$375 Monthly
                <br> No Commitment, Cancel Anytime, Auto Renew
              </p>
              <p class="">
                <span>Subscription (Yearly Installment):</span> $4,050 Year
                <br>
                <span class="text-red">Savings of 10% - $450</span>
              </p>
              <a href="#contact" class="btn green-btn order-btn" >
                contact us
              </a>
            </div>
          </div>
        </label>
      </div>
      <div class="text-center d-block d-md-inline-block pricing-block">
        <label>
          <div>
            <input name="package" type="radio" value="3" />
            <div class="pricing-top-block">
              <h3 class="text-green block-main-title">
                Set Your Own
              </h3>
            </div>
            <div class="pricing-bottom-block">
              <p class="help-txt">
                Looking for something a bit different? Need to modify what is shown here to meet your needs?
              </p>
              <p class="text-uppercase text-green reach-out-txt">
                Reach out and we can discuss.
              </p>
              <div class="img-wrap">
                <img src="{{url('images/reach-out-img.png')}}" class="" />
              </div>
              <a href="#contact" class="btn green-btn order-btn">
                contact us
              </a>
            </div>
          </div>
        </label>
      </div>
    </div>
  </div>
@endsection