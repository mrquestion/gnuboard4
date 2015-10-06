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

// 출력된 캡챠이미지의 키값과 입력한 키값이 같은지 비교한다.
function check_kcaptcha(input_key)
{
    if (typeof(input_key) != 'undefined') {
        if (hex_md5(input_key.value+get_cookie('PHPSESSID')) != md5_norobot_key) {
            alert('자동등록방지용 글자가 제대로 입력되지 않았습니다.');
            input_key.select();
            return false;
        }
    }
    return true;
}