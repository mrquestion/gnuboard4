$(function() {
    var el_id = document.getElementById("daum_juso_wrap");
    new daum.Postcode({
        oncomplete: function(data) {
            var address1 = "", 
                address2 = "";
            // ����ڰ� ������ �ּ� Ÿ�Կ� ���� �ش� �ּ� ���� �����´�.
            if (data.userSelectedType === 'R') { // ����ڰ� ���θ� �ּҸ� �������� ���
                address1 = data.roadAddress;

                //���������� ���� ��� �߰��Ѵ�.
                if(data.bname !== ''){
                    address2 += data.bname;
                }
                // �ǹ����� ���� ��� �߰��Ѵ�.
                if(data.buildingName !== ''){
                    address2 += (address2 !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // �������ּ��� ������ ���� ���ʿ� ��ȣ�� �߰��Ͽ� ���� �ּҸ� �����.
                address2 = (address2 !== '' ? ' ('+ address2 +')' : '');
            } else { // ����ڰ� ���� �ּҸ� �������� ���(J)
                address1 = data.jibunAddress;
            }

            put_data5(data.zonecode, address1, "", address2, data.addressType);
        },
        width : "100%",
        height : "100%"
    }).embed(el_id);
});