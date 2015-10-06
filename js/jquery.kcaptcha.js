var md5_norobot_key = '';

$(function() {
    $('#kcaptcha_image').bind('click', function() {
        $.ajax({
            type: 'POST',
            url: g4_path+'/'+g4_bbs+'/kcaptcha_session.php',
            cache: false,
            async: false,
            success: function(text) {
                $('#kcaptcha_image').attr('src', g4_path+'/'+g4_bbs+'/kcaptcha_image.php?t=' + (new Date).getTime());
                md5_norobot_key = text;
            }
        });
    })
    .css('cursor', 'pointer')
    .attr('title', '글자가 잘 안보이시는 경우 클릭하시면 새로운 글자가 나옵니다.')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');
});