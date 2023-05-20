$(function(){
    $("#profile-avatar").on("change", function() {
        const [file] = this.files;

        if(file) {
            $("#user-avatar").attr("src", URL.createObjectURL(file));
        }
    })

    $(".toast").fadeIn();
    window.setTimeout(function() {
        $(".toast").fadeOut();
    }, 3000)
})