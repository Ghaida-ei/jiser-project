window.onload = function() {
    var message = getUrlParameter('message');
    if (message) {
        alert(message);
        setTimeout(function() {
            window.location.href = "welcome.html"; // Redirect to welcome page after OK is clicked on alert
        }, 100); // Delay the redirection for 100 milliseconds
    }
};

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
}
