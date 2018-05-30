<template>
    <div class="custom-container">
      <div class="row">
        <div class="col-12">
          <h3 class="page-title w-100 text-center mt-2 mb-4">
            Dashboard
          </h3>
        </div>
      </div>
      <div class="row mb-2">
          <div class="col-lg-3  col-sm-6 mb-3">
              <div class="text-center white-box admin-white-box">
                  <div class="text-ash">
                      <h4 class="mt-2 proj-num">102</h4>
                      <p class="m-0 proj-name">Running Projects</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3  col-sm-6 mb-3">
              <div class="text-center white-box admin-white-box ">
                  <div class="text-ash">
                      <h4 class="mb-0 mt-2 proj-num">3</h4>
                      <p class="m-0 proj-name">Pending Project Approval</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3  col-sm-6 mb-3">
              <div class="text-center white-box admin-white-box">
                  <div class="text-ash">
                      <h4 class="mb-0 mt-2 proj-num">$9</h4>
                      <p class="m-0 proj-name">Earnings Till Now</p>
                  </div>
              </div>
          </div>
          <div class="col-lg-3  col-sm-6 mb-3">
              <div class="text-center white-box admin-white-box">
                  <div class="text-ash">
                      <h4 class="mb-0 mt-2 proj-num">$90</h4>
                      <p class="m-0 proj-name">My Unpaid Payments</p>
                  </div>
              </div>
          </div>
      </div>
      <successAlert></successAlert>
      <div class="row chart-info">
        <div class="col-md-6 col-12">
          <p class="text-bold">Here is the graph showing information about No of project working actively per month</p>
        </div>
        <div class="col-md-3 col-6">
          <div class="form-group">
            <select class="form-control">
              <option>Per Month</option>
              <option>Per 3 Month</option>
              <option>Per 6 Month</option>
              <option>Per Year</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-6">
          <div class="form-group">
            <select class="form-control">
              <option>2018</option>
              <option>2017</option>
              <option>2016</option>
              <option>2015</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <div class="mb-4 mt-2 white-box chart-box">
            <h4 class="chart-title">
              Project Infographic Information
            </h4>
            <div class="row">
              <div class="col-12">
                <h4 class="w-100 border-dotted chart-summary">
                  Total Projects : 320 
                  <span class="float-right">
                    Showing Result of the year 2018
                  </span>
                </h4>
                <img src="~/img/admin-chart.png" class="img-fluid mt-2"/>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="mb-4 mt-2 white-box chart-box">
            <h4 class="chart-title">
              Earning Infographic Information
            </h4>
            <div class="row">
              <div class="col-12">
                <h4 class="w-100 border-dotted chart-summary">
                  Total Earnings : $ 12,140 
                  <span class="float-right">
                    Showing Result of the year 2018
                  </span>
                </h4>
                <img src="~/img/admin-chart.png" class="img-fluid mt-2"/>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-12 mb-4 mb-md-2">
          <div class="white-box chart-box summary-box">
            <h4 class="chart-title">
              Payment Summary
            </h4>
            <ul class="box-list">
              <li>
                Pending payment $210 from <span>publisher_name</span>
              </li>
              <li>
                <span>Publisher_name</span> just paid $100 for project <span>project_name</span>
              </li>
              <li>
                Pending payment worth $15 to <span>tester_name</span> since 25 Jan,2018
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4 mb-md-2">
          <div class="white-box chart-box summary-box">
            <h4 class="chart-title">
              Activites
            </h4>
            <ul class="box-list">
              <li><span>Project_name</span> is submitted for approval on 10th Jan 2018</li>
              <li> <span>Project_name</span> is marked as completed</li>
              <li><span>Testername</span> is accepted <span>project_name</span> for testing
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-2 mb-md-2">
          <div class="white-box chart-box summary-box">
            <h4 class="chart-title">
              Project summary
            </h4>
            <p>
              Running Projects : <span class="text-orange">219</span>
            </p>
            <p>
              Need Approval Projects : <span>3</span>
            </p>
            <p>
              completed Projects : <span class="text-green">186</span>
            </p>
            <p>
              Pending Payment Of Projects : <span class="text-red">137</span>
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 mt-3 mb-5">
          <div class="white-box admin-tab-wrap">
            <b-tabs>
              <b-tab title="Projects (367)" active>
                <div class="row">
                  <div class="col-12">
                   <div class="filter-row">
                     <span class="">Showing latest 5 projects</span>
                    <!-- <div class="form-group d-inline-block choose-proj-selectbox">
                      <select class="form-control">
                        <option>All Projects</option>
                        <option>completed Projects</option>
                        <option>Running Projects</option>
                        <option>Unpaid Projects</option>
                        <option>Waiting For Approval</option>
                      </select>
                    </div> -->
                    <a href="#" class="d-inline-block view-all-link float-right">View All</a>
                   </div>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Project Name 2.2
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Publisher :
                            </span>
                            Publisher_name
                          </p>
                          <p>
                            <span class="text-bold"> Devices :
                            </span>
                            Oculus Rift, HTC Vive
                          </p>
                          <p>
                            <span class="text-bold"> Type :
                            </span>
                            AR Apps
                          </p>
                          <p>
                            <span class="text-bold"> Tester Needed :
                            </span>
                            6 Testers
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-md-5 mt-sm-2 mb-0">
                          <span class="green-badge">
                            Approve
                          </span>
                          </p>
                          <p class="mt-3">
                            <span class="text-bold">
                              Submitted on :
                            </span>
                            2 January,2018
                          </p>
                        </div>
                        <div class="col-md-4  col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge grey-outline-badge">
                              Waiting for Approval
                            </span>
                          </p>
                          <p>
                            <span class="text-bold"> Project Total Amount :
                            </span>
                            <span class="proj-amt"> $ 210</span>
                          </p>
                          <p>
                            <span class="text-bold"> Start Date :
                            </span>
                            1 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> End Date :
                            </span>
                            15 January, 2018
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-btn">View</a>
                  </div>
                 <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Project 1
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Publisher :
                            </span>
                            Publisher_name
                          </p>
                          <p>
                            <span class="text-bold"> Devices :
                            </span>
                            Cardboard, Oculus Rift
                          </p>
                          <p>
                            <span class="text-bold"> Type :
                            </span>
                            AR Apps
                          </p>
                          <p>
                            <span class="text-bold"> Tester Needed :
                            </span>
                            6 Testers
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-md-5 mt-sm-2">
                            <span class="text-bold">
                              Started Date :
                            </span>
                            2 January,2018
                          </p>
                          <p>
                            <span class="text-bold">
                              End Date :
                            </span>
                            15 January,2018
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge green-outline-badge">
                              Completed
                            </span>
                          </p>
                          <p>
                            <span class="text-yellow">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            </span>
                            <span class="text-bold">
                              4.0
                            </span>
                          </p>
                          <p>
                            <span class="text-bold"> Start Date :
                            </span>
                            1 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> Project Total Amount :
                            </span>
                            <span class="text-darkgreen text-bold">Exemplary</span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-btn">View</a>
                  </div>
                  <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Project 0.1
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Publisher :
                            </span>
                            Publisher_name
                          </p>
                          <p>
                            <span class="text-bold"> Devices :
                            </span>
                            Cardboard, Oculus Rift
                          </p>
                          <p>
                            <span class="text-bold"> Type :
                            </span>
                            AR Apps
                          </p>
                          <p class="text-truncate">
                            <span class="text-bold"> Tester Needed :
                            </span>
                            5 (tester1, tester2, tester3,...<a href="#" class="">more</a>)
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-md-5 mt-sm-3">
                            <span class="text-bold">
                              Submitted On :
                            </span>
                            2 January,2018
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge green-outline-badge">
                              Running
                            </span>
                          </p>
                          <p>
                          </p>
                          <p class="mt-md-5 mt-sm-2">
                            <span class="text-bold"> Start Date :
                            </span>
                            1 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> End Date :
                            </span>
                            15 January, 2018
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-btn">View</a>
                  </div>
                  <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Project 1.2
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Publisher :
                            </span>
                            Publisher_name
                          </p>
                          <p>
                            <span class="text-bold"> Devices :
                            </span>
                            Oculus Rift, HTC Vive
                          </p>
                          <p>
                            <span class="text-bold"> Type :
                            </span>
                            AR Apps
                          </p>
                          <p class="text-truncate">
                            <span class="text-bold"> Tester Needed :
                            </span>
                            6 Testers
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-md-5 mt-sm-2">
                            <span class="text-bold">
                              Approved On :
                            </span>
                            3 January,2018
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge red-outline-badge">
                             Unpaid
                            </span>
                          </p>
                          <p>
                            <span class="text-bold">
                              Amount :
                            </span>
                            <span class="text-bold proj-amt">
                              $ 210
                            </span>
                          </p>
                          <p>
                            <span class="text-bold"> Start Date :
                            </span>
                            1 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> End Date :
                            </span>
                            15 January, 2018
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-btn">View</a>
                  </div>
                  <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Project 0.1
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Publisher :
                            </span>
                            Publisher_name
                          </p>
                          <p>
                            <span class="text-bold"> Devices :
                            </span>
                            CArdboard, Oculus Rift
                          </p>
                          <p>
                            <span class="text-bold"> Type :
                            </span>
                            AR Apps
                          </p>
                          <p class="text-truncate">
                            <span class="text-bold"> Tester Needed :
                            </span>
                            5 (tester1, tester2, tester3,...<a href="#" class="">more</a>)
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-md-5 mt-sm-2">
                            <span class="text-bold">
                              Submitted On :
                            </span>
                            2 January,2018
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge orange-outline-badge">
                             Running
                            </span>
                          </p>
                          <p>
                            <span class="text-bold">
                              Amount :
                            </span>
                            <span class="text-bold proj-amt">
                              $ 210
                            </span>
                          </p>
                          <p>
                            <span class="text-bold"> Start Date :
                            </span>
                            1 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> End Date :
                            </span>
                            15 January, 2018
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-btn">View</a>
                  </div>
                </div>
              </b-tab>
              <b-tab title="Testers (58)">
                <div class="row">
                  <div class="col-12">
                   <div class="filter-row">
                     <span class="">Showing latest 5 testers based on their activities</span>
                    <!-- <div class="form-group d-inline-block choose-proj-selectbox">
                      <select class="form-control">
                        <option>All Projects</option>
                        <option>completed Projects</option>
                        <option>Running Projects</option>
                        <option>Unpaid Projects</option>
                        <option>Waiting For Approval</option>
                      </select>
                    </div> -->
                    <a href="#" class="d-inline-block view-all-link float-right">View All</a>
                   </div>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Tester Name 1
                      </h4>
                      <div class="row">
                        <div class="col-md-6 col-12 text-left">
                          <p>
                            <span class="text-bold"> Email :
                            </span>
                            <a href="#" class="">info@example.com</a>
                          </p>
                          <p>
                            <span class="">Male |</span>
                            <span class="">
                              30 years |
                            </span>
                            <span class="">United states</span>
                          </p>
                          <p class="mt-3 mb-3 mb-md-0">
                            <span class="text-bold mr-2 align-top d-inline-block">
                              Devices:
                            </span>
                            <span class="align-top d-inline-block">
                              <img src="~img/test-device-1.png" class="img-fluid mr-2"/>
                              <img src="~img/test-device-2.png" class="img-fluid mr-2"/>
                              <img src="~img/test-device-3.png" class="img-fluid mr-2"/>
                            </span>
                          </p>
                        </div>
                        <div class="col-md-6 col-12 text-md-right text-left">
                          <p>
                            <span class="outline-badge orange-outline-badge">
                              Under Approval
                            </span>
                          </p>
                          <p>
                            <span class="text-bold"> Registered on :
                            </span>
                            1 January,2018
                          </p>
                          <p>
                            <span class="text-bold"> Test Started on :
                            </span>
                            3 January, 2018
                          </p>
                          <p>
                            <span class="text-bold"> Test submitted on :
                            </span>
                            5 January, 2018
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-profile-btn">View Profile</a>
                  </div>
                 <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Tester Name 2
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Email :
                            </span>
                            <a href="#" class="">info@example.com</a>
                          </p>
                          <p>
                             <span class="">Male |</span>
                            <span class="">
                              30 years |
                            </span>
                            <span class="">United states</span>
                          </p>
                          <p class="mt-3 mb-3 mb-md-0">
                            <span class="text-bold mr-2 align-top d-inline-block">
                              Devices:
                            </span>
                            <span class="align-top d-inline-block">
                              <img src="~img/test-device-1.png" class="img-fluid mr-2"/>
                              <img src="~img/test-device-2.png" class="img-fluid mr-2"/>
                              <img src="~img/test-device-3.png" class="img-fluid mr-2"/>
                            </span>
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left text-bold">
                          <!-- <p class="mt-2 text-orange">
                            Project Requested : 2
                          </p> -->
                          <p class="mt-2">
                            Running Projects : 3
                          </p>
                          <p class="mt-2 text-darkgreen">
                            Completed Projects : 10
                          </p>
                          <p class="mt-2">
                            Total Projects : 15
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                           <p>
                            <span class="outline-badge green-outline-badge">
                              Active
                            </span>
                          </p>
                          <p>
                            <span class="text-yellow">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            </span>
                            <span class="text-bold">
                              4.0
                            </span>
                          </p>
                          <p class="">
                            <span class="text-bold"> Active on :
                            </span>
                            1 January,2018
                          </p>
                          <p class="text-red">
                            <span class="text-bold"> Pending Payments : 
                            </span>
                            $50
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-profile-btn">View Profile</a>
                  </div>
                </div>
              </b-tab>
              <b-tab title="Publishers (27)">
                <div class="row">
                  <div class="col-12">
                   <div class="filter-row">
                     <span class="">Showing latest 5 publishers based on their activities</span>
                    <!-- <div class="form-group d-inline-block choose-proj-selectbox">
                      <select class="form-control">
                        <option>All Projects</option>
                        <option>completed Projects</option>
                        <option>Running Projects</option>
                        <option>Unpaid Projects</option>
                        <option>Waiting For Approval</option>
                      </select>
                    </div> -->
                    <a href="#" class="d-inline-block view-all-link float-right">View All</a>
                   </div>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Publisher Name 2
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Email :
                            </span>
                            <a href="#" class="">info@example.com</a>
                          </p>
                          <p class="mt-2 text-red">
                            <span class="text-bold">Waiting for approval : 3</span>
                          </p>
                          <p class="mt-2">
                            <span class="text-bold">Running Projects : 5</span>
                          </p>
                          
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                          <p class="mt-2 text-orange ">
                            <span class="text-bold">Pending payment : 1</span> 
                          </p> 
                          <p class="mt-2 text-darkgreen">
                            <span class="text-bold">Completed Projects : 6</span> 
                          </p> 
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p class="mt-sm-2 mt-md-0">
                           <span class="outline-badge red-outline-badge">
                              Pending payment
                            </span>
                          </p>
                          <p class="mt-2">
                            <span class="text-bold"> Active on :
                            </span>
                            1 January,2018
                          </p>
                          <!-- <p class="text-red">
                            <span class="text-bold"> Type : 
                            </span>
                            Partnership
                          </p> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-profile-btn">View Profile</a>
                  </div>
                 <hr>
                </div>
                <div class="row align-items-center">
                  <div class="col-xl-10 col-12">
                    <div class="project-block-wrap">
                      <h4 class="proj-title">
                        Publisher Name 3
                      </h4>
                      <div class="row">
                        <div class="col-md-4 col-12 text-left">
                          <p>
                            <span class="text-bold"> Email :
                            </span>
                            <a href="#" class="">info@example.com</a>
                          </p>
                          <p class="mt-2 text-red">
                            <span class="text-bold">Waiting for approval : 3</span>
                          </p>
                          <p class="mt-2">
                            <span class="text-bold">Running Projects : 5</span>
                          </p>
                        </div>
                        <div class="col-md-4 col-12 text-md-center text-left">
                            <p class="mt-2 text-orange">
                            <span class="text-bold">Pending payment : 1</span> 
                          </p> 
                          <p class="mt-2 text-darkgreen">
                            <span class="text-bold">Completed Projects : 6</span> 
                          </p> 
                        </div>
                        <div class="col-md-4 col-12 text-md-right text-left">
                          <p class="mt-sm-2 mt-md-0">
                           <span class="outline-badge green-outline-badge">
                              Pending Activation
                            </span>
                          </p>
                          <p class="mt-2">
                            <span class="text-bold"> Active on :
                            </span>
                            1 January,2018
                          </p>
                          <!-- <p class="text-red">
                            <span class="text-bold"> Type : 
                            </span>
                            Partnership
                          </p> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-2 col-12">
                    <a href="#" class="purple-btn view-profile-btn">View Profile</a>
                  </div>

                </div>
              </b-tab>
            </b-tabs>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import successAlert from 'components/pages/admin-success-alert.vue';

    export default {
        name: "Dashboard",
        components:{
          successAlert
        },
         data() {
          return{
            visible : false
          }
        }
    }
</script>
<!-- styles -->
<!-- adding scoped attribute will apply the css to this component only -->

<style lang="scss" scoped>
@import "../layouts/css/customvariables";

    .custom-container{
      max-width: 100%;
      margin: 0 auto;
    }
    .page-title{
      font-size: 30px;
      color: #363e48; 
      font-family: $font-family-UniNeue-bold;
    }
    .text-yellow{
      color: #ffcc00;
    }
    .text-orange{
      color: #ff8a0e;
    }
    .text-green{
      color: #02c505;
    }
    .text-darkgreen{
      color: #2cac3d;
    }
    .text-red{
      color: #f83636;
    }
    .text-bold{
      font-family: $font-family-brandon-bold;
    }
    .white-box{
      background-color: #fff;
      box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
      border-radius: 4px;
      font-family: $font-family-brandon-medium;
      font-size: 15px;
      color: #606368;
    }
    .sucess-alertwrap{
      background-color: #fff;
      border: 2px solid #2cac3d;
      color: #2cac3d;
      font-family: $font-family-brandon-medium;
      border-radius: 4px;
      font-size: 18px;
      padding: 5px;
      .close{
        font-size: 30px;
        padding: 5px;
        color: #2cac3d;
        opacity: 1;
      }
    }
    .admin-white-box{
        padding: 20px 0;
        .proj-num{
          font-size: 40px;
          color: #3e3a94;
          margin-bottom: 0;
          line-height: 36px;
          font-family: $font-family-UniNeue-bold;
        }
        .proj-name{
          font-size: 17px;
          color:#606368;
        }
    }
     .chart-info{
        color: #363e48;
        margin-top: 10px;
        p{
          max-width: 100%;
          font-size: 16px;
        }
      }
    .chart-box{
      padding: 15px;
      border-radius: 4px;
      letter-spacing: 0;
      .chart-title{
        text-align: left;
        font-size: 20px;
        color: #3e3a94;
        border-bottom: 1px solid #dadada;
        padding-bottom: 15px;
        font-family: $font-family-UniNeue-bold;
        margin-bottom: 15px;
      }
      .chart-summary{
        padding: 5px 0 10px;
        font-size: 14px;
        font-family: $font-family-brandon-black;
        span{
          font-family: $font-family-brandon-regular;
        }
      }
      .border-dotted{
        border-bottom: 1px dashed #dadada;
      }
     
      .box-list{
        list-style: none;
        padding-left: 0;
        margin-bottom: 0;
        li{
          padding-left: 20px;
          position: relative;
          &::before{
            content: "";
            height: 6px;
            width: 6px;
            background-color: #606368;
            position: absolute;
            left: 1px;
            top: 8px;
            border-radius: 50%;
          }
          span{
            color: #14c1bf;
          }
        }
      }
    }
    .summary-box{
      min-height: 215px;
      max-height: 215px;
      p{
        line-height: 19px;
        span{
          font-size: 20px;
          font-family: $font-family-brandon-bold;
        }
      }
    }
    .admin-tab-wrap{
      padding: 20px;
      hr{
        display: block;
        width: 98%;
        border-color: #dadada;
      }
      .filter-row{
        border-top: 1px solid #dadada;
        border-bottom: 1px solid #dadada;
        padding: 10px 0;
        margin-bottom: 10px;
        .choose-proj-selectbox{
          min-width: 320px;
          margin-bottom: 10px;
        }
        .view-all-link{
          color: #14c1bf;
          text-decoration: underline !important;
          margin-top: 0px;
        }
      }
      .project-block-wrap{
        margin-top: 5px;
        font-family: $font-family-brandon-regular;
        font-size: 14px;
        color: #606368;
        position: relative;
        &::after{
          content: "";
          position: absolute;
          right: -15px;
          top: 0;
          height: 100%;
          width: 1px;
          background-color: #dadada;
        }
        p{
          margin-bottom: 5px;
        }
        a{
          color: #14c1bf;
          text-decoration: underline !important;
        }
        .proj-title{
          font-family: $font-family-brandon-bold;
          font-size: 16px;
          text-transform: uppercase;
          color: #363e48;
          margin-bottom: 10px;
        }
        .green-badge{
          background-color: #2cac3d;
          border: 2px solid #118921;
          padding: 0 10px 3px;;
          border-radius: 16px;
          color: #fff;
          font-size: 15px;
        }
        .grey-badge{
          background-color: #898a8c;
          border: 2px solid #606368;
          padding: 0 10px 3px;;
          border-radius: 16px;
          color: #fff;
          font-size: 15px;
        }
       
        .grey-outline-badge{
          color: #878888;
          border: 1px solid #989898;
        }
        .green-outline-badge{
          color: #2cac3d;
          border: 1px solid #2cac3d;
        }
        .red-outline-badge{
          color: #e80000;
          border: 1px solid #e80000;
        }
        .orange-outline-badge{
          color: #ff7802;
          border: 1px solid #ff7802;
        }
        .outline-badge{
          padding: 2px 0px 2px 15px;
          border-top-left-radius: 16px;
          border-bottom-left-radius: 16px;
          font-family: $font-family-brandon-bold;
          border-right: none;
          font-size: 15px;
        }
        .proj-amt{
          font-size: 20px;
          font-family: $font-family-brandon-black;
        }
      }
       .view-btn{
          max-width: 80px;
          margin: 0px auto;
          display: block;
          text-align: center;
          border-radius: 25px;
        }
        .view-profile-btn{
         width: 100%;
          margin: 0px auto;
          display: block;
          text-align: center;
          border-radius: 25px;
          
        }
    }
@media screen and(max-width:1199px) {
  .admin-tab-wrap{
    .project-block-wrap{
      &::after{
        display: none;
      }
    }
    .view-btn{
      padding: 5px 20px;
      max-width: 150px;
      float: right;
      margin: 0px 0 10px;
    }
    .view-profile-btn{
      margin: 0px 0 10px;
      text-align: center;
      max-width: 145px;
      padding: 5px 8px;
      float: right;
    }
  }
}
@media screen and(max-width:1112px) {
  .admin-white-box{
    .proj-num{
      font-size: 34px;
      line-height: 32px;
    }
    .proj-name{
      font-size: 14px;
    }
  }
  .chart-box{
    .chart-title{
      font-size: 18px;
      padding-bottom: 10px;
      margin-bottom: 10px;
    }
  }
  .summary-box{
    p {
      span{
        font-size: 18px;
      }
    }
  }
  .admin-tab-wrap{
    .project-block-wrap{
      margin-top: 10px;
      .proj-title{
        margin-bottom: 5px;
      }
    }
    .view-btn{
      margin: 10px 0 5px;
    }
    hr{
      margin-bottom: 0;
    }
  }
  .chart-box{
    .chart-summary{
      padding: 5px 0 30px;
      span{
        display: block;
        width: 100%;
        margin-top: 5px;
      }
    }
  }
  .summary-box{
    min-height: 250px;
    max-height: 260px;
  }
}
@media screen and(max-width:1024px) {
  .page-title{
    margin-top: 0 !important;
  }
  .admin-white-box{
    padding: 15px 0;
    .proj-name{
      font-size: 12px;
    }
  }
  .sucess-alertwrap{
    font-size: 16px;
    .close{
      font-size: 30px;
    }
  }
  .admin-tab-wrap{
    padding: 15px;
    .view-profile-btn{
      margin: 10px 0;
    }
  }
}
@media screen and(max-width:767px) {
  .chart-info{
    p{
      font-size: 14px;
      line-height: 18px;
    }
  }
  .chart-box{
    img{
      display: block;
      margin:  0 auto;
    }
  }
  .summary-box{
    min-height: 100%;
    max-height: 100%;
    p{
      line-height: 14px;
    }
  }
  .admin-tab-wrap{
    .view-btn{
      float: left;
    }
    .view-profile-btn{
      float: left;
    }
    .project-block-wrap{
      .green-badge{
        padding: 0 5px 3px;
        font-size: 13px;
      }
      .outline-badge{
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
        border-left: 0;
        border-right: 1px solid;
        padding: 0px 15px 2px 5px;
      }
    }
  }
}
@media screen and(max-width:576px) {
  .sucess-alertwrap{
    font-size: 15px;
  }
  .admin-white-box{
    padding: 10px 0 15px;
  }
  .admin-tab-wrap{
    .filter-row{
      float: left;
      position: relative;
      width: 100%;
      .choose-proj-selectbox{
        min-width: 100%;
      }
      .view-all-link{
        margin-bottom: 5px;
        margin-top: 0;
      }
    }
  }
}
</style>
