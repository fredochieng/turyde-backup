$(document).ready(function () {

    if ($(window).width() < 900) {
        $(".fakeloader").fakeLoader({
            timeToHide: 1000,
            bgColor: "#fff",
            imagePath: "assets/images/splash-screen.jpg"
        });
    } else {
        $(".fakeloader").fakeLoader({
            timeToHide: 1000,
            bgColor: "#fff",
            imagePath: "assets/images/splash-screen-web.jpg"
        });
    }
});
