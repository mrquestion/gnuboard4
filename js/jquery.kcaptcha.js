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
    .attr('title', '���ڰ� �� �Ⱥ��̽ô� ��� Ŭ���Ͻø� ���ο� ���ڰ� ���ɴϴ�.')
    .attr('width', '120')
    .attr('height', '60')
    .trigger('click');
});

// ��µ� ĸí�̹����� Ű���� �Է��� Ű���� ������ ���Ѵ�.
function check_kcaptcha(input_key)
{
    if (typeof(input_key) != 'undefined') {
        if (hex_md5(input_key.value+get_cookie('PHPSESSID')) != md5_norobot_key) {
            alert('�ڵ���Ϲ����� ���ڰ� ����� �Էµ��� �ʾҽ��ϴ�.');
            input_key.select();
            return false;
        }
    }
    return true;
}