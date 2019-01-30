$(document).ready(function(){
	$('#btn1').click(function(){
		var s= ('#an1').val();
		s= $.trim(s);
		$.post('aphp.php',{se:s},function(data){
			$('#rep1').html(data);
			$('#rep1').show();
		});
	});
});