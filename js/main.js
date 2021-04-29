(function ($) {
    // page upを消す
    $('#back-to-top').hide();
    
    // スクロールされたら表示
    $(window).scroll(function () {
      if ($(this).scrollTop() > 60) {
        $('#back-to-top').fadeIn();
      } else {
        $('#back-to-top').fadeOut();
      }
    });
    //クリックされたら上に戻る
    $('#back-to-top a').click(function () {
      $('html,body').animate({
        scrollTop: 0
      }, 500);
      return false;
    });
    // お気に入り追加/削除
    $(".favoButton").click(function() {
      var num = $(this).data('shopid');
      var userid = $(this).data('userid');
      var button = this;
      console.log($(this).data('condition'));
      console.log(num);
      console.log(userid);
      //お気に入り追加
      if($(this).data('condition') == false){
   
        $.ajax({
          url: 'favorite.php',
          type: 'POST',
          data: {'shopid': num,
                 'userid':userid}
        })
        .done(function(data, textStatus, jqXHR) {
            $(button).css('color', '#FF0');
            $(button).data('condition',true);
        })
        .fail(function(data) {
          console.log("error");
          console.log(data);
        });
      }
    
      else if($(this).data('condition') == true){
        //お気に入り削除
        $.ajax({
          url: 'favoritedel.php',
          type: 'POST',
          data: {'shopid':num,
                 'userid':userid}
        })
        .done(function(data, textStatus, jqXHR) {
            $(button).css('color', '');
            $(button).data('condition',false);
            $("a").removeClass("favocolor_2");
        })
        .fail(function(data) {
          console.log("error");
          console.log(data);
        });
      }
    });
})(jQuery);