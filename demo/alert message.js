window.onload = function() {
    var idNumberInput = document.getElementById('id_number');
    var errorMessage = document.getElementById('id_number_error');
    
    idNumberInput.addEventListener('input', function() {
        // Remove any non-numeric characters
        var cleanedValue = idNumberInput.value.replace(/[^0-9]/g, '');

        // Update the input value
        idNumberInput.value = cleanedValue;

        // Check the length and set the border color
        if (cleanedValue.length !== 10) {
            idNumberInput.style.borderColor = 'red';
            errorMessage.textContent = 'Please enter exactly 10 numbers';
        } else {
            idNumberInput.style.borderColor = 'green';
            errorMessage.textContent = '';
        }
    });

    // Reset border color and error message on form submit
    var form = document.getElementById('myformdata');
    form.addEventListener('submit', function() {
        idNumberInput.style.borderColor = '';
        errorMessage.textContent = '';
    });
};

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
