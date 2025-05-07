require('./bootstrap');
$.ajax({
    url: '/bookings',
    method: 'POST',
    data: { name: $('#name').val(), room_id: $('#room_id').val(), _token: '{{ csrf_token() }}' },
    success: function(response) {
        alert('Booking successful!');
    },
    error: function(xhr) {
        console.log(xhr.responseText);
    }
});