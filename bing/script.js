$(document).ready(function() {
    // Fonction pour afficher les messages
    function showMessages() {
        $.ajax({
            url: "chat.php",
            type: "POST",
            data: {action: "show"},
            success: function(data) {
                $("#messages").html(data);
                $("#messages").scrollTop($("#messages")[0].scrollHeight);
            }
        });
    }

    // Appel de la fonction au chargement de la page
    showMessages();

    // Appel de la fonction toutes les 5 secondes
    setInterval(showMessages, 5000);

    // Fonction pour envoyer un message
    function sendMessage() {
        var message = $("#message").val();
        if (message != "") {
            $.ajax({
                url: "chat.php",
                type: "POST",
                data: {action: "send", message: message},
                success: function(data) {
                    $("#message").val("");
                    showMessages();
                }
            });
        }
    }

    // Appel de la fonction au clic sur le bouton Envoyer
    $("#form").submit(function(e) {
        e.preventDefault();
        sendMessage();
    });

});