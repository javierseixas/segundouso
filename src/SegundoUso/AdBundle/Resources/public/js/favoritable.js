
$(document).ready(function() {
    var favorite = function() {
        $('.favorite-marker.btn-default').click(function() {
            var marker = this;
            $.ajax({
                type: "POST",
                url: $(marker).data('favorite-url'),
                data: 'hola',
                success: function() {
                    $(marker).removeClass('btn-default').addClass('btn-success').addClass('unfavoritable');
                    $(marker).find('span.favorite-text').text('Favorito');
                    $(marker).off('click');
                    unfavorite();
                },
                dataType: 'json'
            });
        });
    };
    var unfavorite = function() {
        setUnfavoritable();
        $('.favorite-marker.btn-success').click(function() {
            var marker = this;
            $.ajax({
                type: "POST",
                url: $(marker).data('unfavorite-url'),
                data: 'hola',
                success: function() {
                    unsetUnfavoritable();
                    $(marker).removeClass('btn-danger').removeClass('btn-success').addClass('btn-default').removeClass('unfavoritable');
                    $(marker).find('span.favorite-text').text('Favorito');
                    $(marker).off('click');
                    favorite();
                },
                dataType: 'json'
            });
        });
    };
    var setUnfavoritable = function() {
        $('.unfavoritable').mouseover(function() {
            $(this).addClass('btn-danger').removeClass('btn-success');
            $(this).find('span.favorite-text').text('Desfavoritear');
        });
        $('.unfavoritable').mouseout(function() {
            $(this).removeClass('btn-danger').addClass('btn-success');
            $(this).find('span.favorite-text').text('Favorito');
        });
    };
    var unsetUnfavoritable = function() {
        $('.unfavoritable').off('mouseover');
        $('.unfavoritable').off('mouseout');
    };
    favorite();
    unfavorite();
    setUnfavoritable();
});