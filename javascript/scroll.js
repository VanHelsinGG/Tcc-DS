window.onscroll = function() {NavBar()};

function NavBar(){
    if(document.body.scrollTop >= 580 || document.documentElement.scrollTop >= 580){
        document.getElementById("header").className = "header2";
        document.getElementById("home").className = "navitem2";
        document.getElementById("contact").className = "navitem2";
        document.getElementById("profile").className = "navitem2";
        document.getElementById("about").className = "navitem2";
        document.getElementById("title").className = "title2";
    }else{
        document.getElementById("header").className = "header";
        document.getElementById("home").className = "navitem";
        document.getElementById("contact").className = "navitem";
        document.getElementById("profile").className = "navitem";
        document.getElementById("about").className = "navitem";
        document.getElementById("title").className = "title";
    }
}
