<?php

?>


<h2>Min sida</h2>

<article>
	<fieldset id="ego">
		<legend>Personliga uppgifter</legend>
		<form action="scripts/updateValues.php?type=ego&id=<?php echo $user['id'];?>" method="post" class="jUpdate">
			<ul>
				<li><label for="txtFirstName">Förnamn:</label><input type="text" id="txtFirstName" name="ego[firstName]" value="<?php echo $user['firstName']; ?>" /></li>
				<li><label for="txtLastName">Efternamn:</label><input type="text" id="txtLastName" name="ego[lastName]" value="<?php echo $user['lastName']; ?>" /></li>
				<li><label for="txtEmail">Epost:</label><input type="text" id="txtEmail" name="ego[email]" value="<?php echo $user['email']; ?>" /></li>
			</ul>
			<button type="submit">Spara</button>
		</form>
	</fieldset>

	<fieldset id="notifications">
		<legend>Meddelanden</legend>
		<form action="scripts/updateValues.php?type=notifications&id=<?php echo $user['id'];?>" method="post" class="jUpdate">
			<ul>
				<li><input type="checkbox" name="ego[notifyBoard]" id="txtNotifyBoard" value="1"<?php if($user['notifyBoard']) echo ' checked="checked" '; ?> /><label for="txtNotifyBoard" class="choice">Skicka ett mail varje gång någon skriver på planket.</label></li>
			</ul>
			<button type="submit">Spara</button>
		</form>
	</fieldset>


	<fieldset id="changePass">
		<legend>Byt lösenord</legend>
		<form action="scripts/updateValues.php?type=password&id=<?php echo $user['id'];?>" method="post" class="jUpdate">
			<ul>
				<li><label for="txt_new1">Nytt Lösenord</label><input type="password" name="pass1" id="txt_new1" value="" /><li/>
				<li><label for="txt_new2">... och en gång till</label><input type="password" name="pass2" id="txt_new2" value="" /></li>
			</ul>
			<button type="submit">Spara</button>
		</form>
	</fieldset>
</article>
