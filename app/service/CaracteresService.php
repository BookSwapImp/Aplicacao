<?php
    class CaracteresService{
        public function CaracteresInvalidos($validarString){
            $ivalidChars = ['<','>','/','\\','\'','"',';','""',"''"];
            for($i = 0; $i < strlen($validarString); $i++){
                if (str_contains($validarString, $ivalidChars[$i])) {
                    $errorMsg = "Caracteres inválidos detectados.";
                    return $errorMsg;
                }
            }
        }
        public function PontuacaoEspacamento($validarString){
            $pontuacao = ['.','!','?','-','_'];
            for($i = 0; $i < strlen($validarString); $i++){
                if (str_contains($validarString, $pontuacao[$i])) {
                    $errorMsg = "Caracteres inválidos detectados.";
                    return $errorMsg;
                }
            }
        }
    }
    