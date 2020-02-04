var stripe = Stripe('pk_test_cjyGKm7rt72qKfimiTRVFCgz00jDZ0WJgM');

var $form = $('#form-pesan');

$form.submit(function (event) {
    $('#checkout-error').addClass('hidden');
    $form.find('button').prop('disabled', true);
    stripe.createToken({
        number: $('#card-number').val(),
        cvc: $('#card-cvc').val(),
        exp_month: $('#card-expiry-month').val(),
        exp_year: $('#card-expiry-year').val(),
      }, stripeResponseHandler);
      return false
});

function stripeResponseHandler(status, response) {
    if(response.error) {
        $('#checkout-error').removeClass('hidden');
        $('#checkout-error').text(response.error.message);
        $form.find('button').prop('disabled', false);
    } else {
        var token = response.id;
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        $form.get(0).submit();
    }
}