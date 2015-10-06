if (typeof(FILTER_JS) == 'undefined') // 한번만 실행
{
    if (typeof g4_cf_filter == 'undefined')
        alert('g4_cf_filter 변수가 선언되지 않았습니다. js/filter.js');

    var FILTER_JS = true;

    // 금지단어 필터링
    function word_filter_check(v)
    {
        var filter = g4_cf_filter;
        var s = filter.split(",");

        for (i=0; i<s.length; i++) 
        {
            if (v.indexOf(s[i]) != -1)
                return s[i];
        }
        return "";
    }
}
