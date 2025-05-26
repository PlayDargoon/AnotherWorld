function updateVitality() {
    var userId = <?php echo $userId; ?>;
    $.ajax({
        url: 'home/host1421897/sakhwow.su/htdocs/www/templates/user/update_vitality.php?id=' + userId,
        type: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
            $('#health-value').text(data.health);
            $('#vitality-value').text(data.vitality);
        },
        error: function(error) {
            console.error(error);
        }
    });
}

// Вызов функции при загрузке страницы
$(document).ready(function() {
    updateVitality();
});