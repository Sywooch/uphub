function myFunction() {
	var j = $('#inp').val();
	var n = parseInt(j);
	var i = 1;
	var text = "";
	while (i < n+1) {

		$(
				'<div class="form-group"> '
				+ '<br>ราคา <input type="text"  id="cost' 
				+ i
				+ '" name ="cost'+i+'cost[]"> <br>'
				
				+ 'ค่าประกัน <input type="text"  id="insurance' 
				+ i
				+ '" name ="f'+i+'insurance[]"> <br>'
				
				+ 'ประเภทห้อง <select  id="type_pay' 
				+ i
				+ '" name ="f'+i+'type_pay[]">'
				+  '<option value="1">รายเดือน</option>'
				+  '<option value="2">รายวัน</option>'
				+ '</select> <br> ชั้น '
						+ i
						+ ' จำนวนห้อง <input type="number" min ="1" value ="" id="floor'
						+ i
						+ '" name="floor[]" >'
						
						+ '<label onclick="addRoom(\''+ i+ '\')" class="btn btn-primary">สร้างห้อง </label><br>'
						
						
						
						
			+ '</div>'
			
			+ '<div class="roomonFloor'+ i +'"></div>'
		)
				.appendTo($('#demo'));

		i++;
	}
	return i;
}

function addRoom(id) {
	var floor = $('#floor'+id);
	var room = $('.roomonFloor'+id);
	var i = 1;
	
	var txt = '<div class="row">';
	while (i <= floor.val() ) {
		txt += '<div class="col-md-3">';
		txt += '<input type="text" min ="1" id="room' +i+'"  name="f'+id+'room[]" class="form-control"> ';
		txt += '</div>';
		i++;
	}
	txt += '</div>';
	

	$(txt).appendTo(room);
	
	
}

function execute(){
	
}
