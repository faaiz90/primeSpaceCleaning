// Booking Form AJAX
$('#booking_form').on('submit', function(e) {
    e.preventDefault(); // stops page reload
    $.ajax({
        url: 'booking.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response == 'sent') {
                $('#success_message').show();
                $('#error_message').hide();
                $('#booking_form')[0].reset(); // clears the form
            } else {
                $('#error_message').show();
                $('#success_message').hide();
            }
        },
        error: function() {
            $('#error_message').show();
        }
    });
});

// ===== Contact Form AJAX =====
$('#contact_form').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'contact.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.includes('successfully')) {
                alert('✅ Message sent successfully!');
                $('#contact_form')[0].reset();
            } else {
                alert('❌ Something went wrong. Please try again.');
            }
        },
        error: function() {
            alert('❌ Server error. Please try again.');
        }
    });
});