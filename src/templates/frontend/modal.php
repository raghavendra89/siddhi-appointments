<?php

?>

<div class="sa-modal" id="sa-booking-modal" tabindex="-1">
    <div class="sa-modal-dialog">
        <div class="sa-modal-content">
            <div class="sa-modal-header">
                <h4 class="sa-modal-title" id="exampleModalLabel">Book Appointment</h4>
                <span class="sa-pointer"><?php sa_view( 'icons._close' ); ?></span>
            </div>
            <div class="sa-modal-body sa-py-0">
                <div class="sa-row sa-d-none">
                    <div class="sa-col-md-4 sa-p-3 sa-booking-steps">
                        <div>
                            <ul>
                                <li class="sa-booking-step completed">
                                    <span><?php sa_view( 'icons._check' ); ?></span>
                                    Select Service
                                </li>
                                <li class="sa-booking-step completed">
                                    <span><?php sa_view( 'icons._check' ); ?></span>
                                    Date & Time
                                </li>
                                <li class="sa-booking-step">
                                    <span><?php sa_view( 'icons._check' ); ?></span>
                                    Contact Details
                                </li>
                                <li class="sa-booking-step">
                                    <span><?php sa_view( 'icons._check' ); ?></span>
                                    Pricing
                                </li>
                            </ul>
                        </div>

                        <div class="sa-bg-light sa-p-3" style="border-radius: 4px;">
                            <strong>Date:</strong><br>
                            25th October, 2022

                            <div class="sa-mt-2">
                                <strong>Timeslot:</strong><br>
                                10:00AM - 10:30AM
                            </div>
                        </div>
                    </div>

                    <div class="sa-col-md-8 sa-p-3">
                        <div class="sa-row">
                            <div class="sa-col-12">

                                <div class="sa-row sa-booking-step-content">
                                    <div class="sa-col-md-6">
                                        <div class="sa-booking-service sa-pointer">
                                            <div class="sa-me-3">
                                                <?php sa_view( 'icons._circle' ); ?>
                                            </div>
                                            <div>
                                                <h5 class="sa-mb-2">Online Consultancy</h5>
                                                <span>30 Mins, $ 29.99</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sa-col-md-6">
                                        <div class="sa-booking-service sa-pointer selected">
                                            <div class="sa-me-3">
                                                <?php sa_view( 'icons._circle' ); ?>
                                            </div>
                                            <div>
                                                <h5 class="sa-mb-2">One-to-one consultation</h5>
                                                <span>45 Mins, $ 79.99</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="sa-col-md-6">
                                        <div class="sa-booking-service sa-pointer">
                                            <div class="sa-me-3">
                                                <?php sa_view( 'icons._circle' ); ?>
                                            </div>
                                            <div>
                                                <h5 class="sa-mb-2">In-person Meeting</h5>
                                                <span>30 Mins, $ 49.99</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="sa-row sa-booking-step-content">
                                    <div class="sa-col">
                                        <div class="sa-booking-date-picker"></div>
                                        <!-- <input class="sa-booking-date-picker" type="text" name=""> -->
                                    </div>
                                    <div class="sa-col sa-timeslots-wrapper">
                                        <div class="sa-timeslot-scroll sa-timeslot-scrollup"></div>
                                        <div class="sa-timeslots">
                                            <div class="sa-time-slot">
                                                <span>09:00AM</span>
                                            </div>
                                            <div class="sa-time-slot disabled">
                                                <span>09:30AM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>10:00AM</span>
                                            </div>
                                            <div class="sa-time-slot checked">
                                                <span>10:30AM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>11:00AM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>11:30AM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>12:00PM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>12:30PM</span>
                                            </div>
                                            <div class="sa-time-slot">
                                                <span>01:00PM</span>
                                            </div>
                                        </div>
                                        <div class="sa-timeslot-scroll sa-timeslot-scrolldown"></div>
                                    </div>
                                </div>

                                <div class="sa-row sa-booking-step-content active">
                                    <div class="sa-col-12">
                                        <h4>Contact Information: </h4>

                                        <div class="sa-mb-3">
                                            <label class="sa-form-label">Name: </label>
                                            <input type="text" class="sa-form-control" name="">
                                        </div>

                                        <div class="sa-mb-3">
                                            <label class="sa-form-label">Email Address: </label>
                                            <input type="text" class="sa-form-control" name="">
                                        </div>

                                        <div class="sa-mb-3">
                                            <label class="sa-form-label">Phone Number: </label>
                                            <input type="text" class="sa-form-control" name="">
                                        </div>

                                        <div class="sa-mb-3">
                                            <label class="sa-form-label">Notes: </label>
                                            <textarea class="sa-form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="sa-row sa-booking-summary">
                    <div class="sa-col-12 sa-text-center sa-p-4">
                        <div class="sa-booked-icon"><?php sa_view( 'icons._check' ); ?></div>
                        <h3>Your appointment is booked!</h3>
                        <div class="sa-text-muted sa-my-3">
                            We have booked an appointment for you. You will receive a confirmation an email to your email address: <strong>someone@example.com.</strong>
                        </div>

                        <div class="sa-row sa-my-4">
                            <div class="sa-col-12 sa-col-md-10 sa-offset-md-1">
                                <div class="sa-row sa-bg-light sa-text-start" style="border-radius: 5px;">
                                    <div class="sa-col-6 sa-py-4">
                                        <strong>Date: </strong> <br>
                                        24th October, 2022
                                    </div>
                                    <div class="sa-col-6 sa-py-4">
                                        <strong>Timeslot: </strong> <br>
                                        10:00AM - 10:30AM
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="sa-modal-footer">
                <button type="button" class="sa-btn sa-btn-secondary">Back</button>
                <button type="button" class="sa-btn sa-btn-primary sa-float-end">Next Step</button>
            </div>
        </div>
    </div>
</div>

<div class="sa-modal-backdrop show"></div>