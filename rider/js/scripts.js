// Search table row
$(document).ready(function(){
    $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#tablerecord tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    });
});

// Back button to go back previous page
function goback() {
    window.history.back();
}
