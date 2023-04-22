function Alert(message, type) {
    const alert_types = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark']
    const alert = $(`<div class="alert alert-${type}" role="alert"></div>`).text(message);

    if (alert_types.includes(type)) {
        $('#alerts').append(alert);

        setTimeout(function() {
            alert.addClass('show');
        }, 100);

        setTimeout(function() {
            alert.removeClass('show');
            setTimeout(function() {
                alert.remove();
            }, 1000);
        }, 2000);
    } else {
        console.error('The alert type entered is invalid or not supported.')
    }
}