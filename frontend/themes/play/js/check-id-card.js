$('#sub').hide(1000);
var n = $('#inp').val();
$('#inp').change(function(){
	n = $('#inp').val();
		console.log(n);
		if(n.length != 13) {
			alert("กรุณากรอกเลขให้ครบ 13 หลัก");
			//$( "กรุณากรอกเลขให้ครบ 13 หลัก" ).appendTo( "#demo" );
		
		}else{
			var sum = 0;
			for(i=0; i < 12; i++){
			sum += parseFloat(n.charAt(i))*(13-i); 
			
			}
			if((11-sum%11)%10!=parseFloat(n.charAt(12))){
				//alert("เลขประจำตัวประชาชนไม่ถูกต้อง");
				$("#demo").append("เลขประจำตัวประชาชนไม่ถูกต้อง");
			}else{
				$("#demo").append("เลขประจำตัวประชาชนถูกต้อง");
				//alert("เลขประจำตัวประชาชนถูกต้อง");
				$('#sub').show(1000);
				
			}
		
	}});

/*
function checkID(){
}
	
	
	
	if(n.length != 13) {
		$(
				'กรุณากรอกเลขให้ครบ 13 หลัก'
		)
				.appendTo($('#demo'));
	}else{
		for(i=0, sum=0; i < 12; i++)
			sum += parseFloat(n.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))
			return false; return true;
		}

function checkForm() {
	if(!checkID(document.form1.txtID.value))
alert('รหัสประชาชนไม่ถูกต้อง');
else alert('รหัสประชาชนถูกต้อง เชิญผ่านได้');

}
*/