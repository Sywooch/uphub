function myFunction() {
 
    var j = $('#inp').val();
    var n = parseInt(j);
    var i=0;
     while (i < n) {
    $('<input type="text" id="fname" name="floor[]" /><button onclick="myFunction()">Try it</button><br/><br/>').appendTo($('#demo'));
    i++;
}
}
public function init()
{
	parent::init();
	$this->publishOptions['forceCopy'] = true;
}