


<div class="container" >
	<?php echo validation_errors();?>
	<form class="form_vraper" action={przycisk_zapisz_akcja_do_wykonania} method='post' accept-charset="utf-8">
		Tytul artykulu:<br>	
		<input type="text" name="tytul" class="small_form"><br><br>
		Wpisz nowy artykul:<br>
		<textarea name="tresc"  class="big_form" ></textarea>
		<br>
		<input type="submit" value="Zapisz">
		<br>
		<br>
	</form>
</div>	