@extends('layouts.app')
@section('content')
    <div class="row mt-5">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="main-card mb-3 card">
                 <div class="card-header d-flex align-items-center"><i class="fe-icon mr-2" data-feather="briefcase"
                        color="#727CF5"></i>
                    <h5 class="card-title mb-0 flex-grow-1"> {{ __('booking_list') }}</h5>
                    <div>
                        <button id="add_booking" data-toggle="modal" data-target="#addBookingModal"
                            class="btn btn-primary "><i class="fa fa-plus mr-2"></i>
                            {{ __('add_booking') }}</button>

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-2">
                        <thead>
                            <tr>
                                <th class="text-center">{{ __('s_no') }}</th>
                                <th>{{ __('purpose') }}</th>
                                <th class="text-center">{{ __('start_date') }}</th>
                                <th class="text-center">{{ __('end_date') }}</th>
                            </tr>
                        </thead class="booking-table">
                        @include('bookings/include/booking-table')
                    </table>
                </div>



            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
@endsection
