$(document).ready(function(){
	$('#se').keyup(function(){
		var se= $(this).val();
		se= $.trim(se);
		if(se!=="")
		{
			    $('#res').show();
				$.post('payephp.php',{ser:se},function(data){
				$('#res .lis').html(data);
			});
		}
	});
});