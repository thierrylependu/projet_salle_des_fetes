function toggleNav(){
    $("#navbar").toggleClass( "header-navPhone" );
}

$("#buttonNav").on("click", toggleNav);


$(window).on('load',function(){
    let loginError = document.getElementById("loginError");
    if(loginError != null){
        $('#connexion').modal('show');
    }
    let registerSucces = document.getElementById("registered");
    if(registerSucces != null){
        $('#registered').modal('show');
    }
});

if ( location.href.includes("index.php")){
    $(document).ready(function(){
        $('.slider').slick({
            infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 4000,
      arrows:false,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
      });
    });
}

if ( location.href.includes("livre_d_or.php")){
    
    $(document).ready(function(){

        $("#star1").click(function(){
            $(this).addClass("star-selected");
            $("#star2, #star3, #star4, #star5").removeClass("star-selected");
            $("input[name=mark][value=1]").attr("checked",true);
            $("input[name=mark][value=2], input[name=mark][value=3], input[name=mark][value=4],input[name=mark][value=5]").attr("checked",false);

        });
        $("#star2").click(function(){
            $(this).addClass("star-selected");
            $("#star1").addClass("star-selected");
            $("#star3, #star4, #star5").removeClass("star-selected");
            $("input[name=mark][value=2]").attr("checked",true);
            $("input[name=mark][value=1], input[name=mark][value=3], input[name=mark][value=4],input[name=mark][value=5]").attr("checked",false);
        });
        $("#star3").click(function(){
            $(this).addClass("star-selected");
            $("#star1, #star2").addClass("star-selected");
            $("#star4, #star5").removeClass("star-selected");
            $("input[name=mark][value=3]").attr("checked",true);
            $("input[name=mark][value=2], input[name=mark][value=1], input[name=mark][value=4],input[name=mark][value=5]").attr("checked",false);
        });
        $("#star4").click(function(){
            $(this).addClass("star-selected");
            $("#star1, #star2, #star3").addClass("star-selected");
            $("#star5").removeClass("star-selected");
            $("input[name=mark][value=4]").attr("checked",true);
            $("input[name=mark][value=2], input[name=mark][value=3], input[name=mark][value=1],input[name=mark][value=5]").attr("checked",false);
        });
        $("#star5").click(function(){
            $(this).addClass("star-selected");
            $("#star1, #star2, #star3, #star4").addClass("star-selected");
            $("input[name=mark][value=5]").attr("checked",true);
            $("input[name=mark][value=2], input[name=mark][value=3], input[name=mark][value=4],input[name=mark][value=1]").attr("checked",false);
        });
    });



}

if ( location.href.includes("messages.php")){
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
}
