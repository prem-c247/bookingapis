
 //===================== Add booking ====================
 $(document).on('click', '.save-booking', function() {
    var id = $(this).attr('data-id')
    url = '/booking-save'
    method = 'POST'
    $.ajax({
        url: url,
        method: method,
        data: $('#addBookingForm').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(response) {
          console.log(response)
            if (response.status == 'error') {
                $.each(response.error, function(index, value) {
                    $('.' + index + '-error').html(value)
                    $('.' + index + '-error').show()
                })
            } else if (response.status == 'success') {
                
                $('#addBookingForm')[0].reset()
                $('.close').trigger('click')
                 location.reload();
                $('.error').html('')
            }
        },
    })

})

// validation for alphabate

function testInput(event) {

    //  alert('test')

    var value = String.fromCharCode(event.which);

    var pattern = new RegExp(/[a-zåäö ]/i);

    return pattern.test(value);

}

$('.alpha').on('keypress', testInput);