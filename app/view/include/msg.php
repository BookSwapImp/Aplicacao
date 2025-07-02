<?php
	if(isset($msgErro) and (trim($msgErro) != "")){
		echo("<div class='form-control is-invalid' id='msgErro'>" . $msgErro . "</div>");
	}

	if(isset($msgSucesso) and (trim($msgSucesso) != "")){
		echo("<div class='form-control is-valid' id='msgSucesso'>" . $msgSucesso . "</div>");
	}
?>