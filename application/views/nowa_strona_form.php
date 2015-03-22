


<div class="container" >
	
	<form class="form_vraper" action='{przycisk_zapisz_akcja_do_wykonania}' method='post' accept-charset="utf-8">
		<?php echo validation_errors();?>
		Tytul artykulu:<br>	
		<input type="text" name="tytul" class="small_form" value='{tytul_artykulu}' ><br><br>
		Wpisz nowy artykul:<br>
		<textarea name="tresc"  class="big_form" >{tekst}</textarea>
		<br>
		<input type="submit" value="Zapisz">
		<br>
		<br>
	</form>
</div>	