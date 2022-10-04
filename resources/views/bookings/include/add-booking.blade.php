  <!-- Modal -->
  <div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><i class="fe-icon mr-2" data-feather="sliders"
                          color="#727CF5"></i>{{ __('add_booking') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i class="fe-icon" data-feather="x"></i>
                  </button>
              </div>
              <div class="modal-body">
                  <form id="addBookingForm">
                      @csrf
                      @method('post')
                      <div class="examAlertMsg"></div>
                      <div class="row">
                          <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                  <label for="name">{{ __('purpose') }}<span class="text-danger">*</span>
                                  </label>
                                  <input type="text" class="form-control alpha" name="purpose" value=""
                                      id="purpose" data-rule-required="true" data-rule-minlength="2"
                                      data-rule-maxlength="20" data-msg-required="{{ __('required_purpose') }}">
                                    <span class="text-danger error purpose-error"></span>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                  <label for="name">{{ __('start_date') }}<span class="text-danger">*</span>
                                  </label>
                                  <input type="date" class="form-control alpha" name="start_date" value=""
                                      id="start_date" data-rule-required="true" data-rule-minlength="2"
                                      data-rule-maxlength="20" data-msg-required="{{ __('required_start_date') }}">
                                  <span class="text-danger error start_date-error"></span>
                              </div>
                          </div>

                          <div class="col-lg-12 col-md-12">
                              <div class="form-group">
                                  <label for="name">{{ __('end_date') }}<span class="text-danger">*</span>
                                  </label>
                                  <input type="date" class="form-control" value="" id="end_date"
                                      data-rule-required="true" data-rule-end_date="true" name="end_date"
                                      data-msg-required="{{ __('required_end_date') }}">
                                  <span class="text-danger error end_date-error"></span>
                              </div>
                          </div>
                          <div class="col-lg-12 col-md-12">
                              <div class="form-group mt-2 text-center">
                                  <button type="button" data-id=""
                                      class="btn btn-primary common-btn save-booking">Submit</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
 