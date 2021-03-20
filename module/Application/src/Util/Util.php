<?php

namespace Application\Util;


use Zend\View\Model\ViewModel;
use DateTime;
use DateTimeZone;

class Util {


    /*     * ********************
     * FLESHMESSAGER DINAMIC
     * ************************ *

      /**
     * Cria o modelo do flashMessager
     * @param string $class - tipo da classe
     * @param string $type - tipo da msg
     * @param string $onliText - retorna apenas a msg sem tags
     * @param type $messagem - mensagem que será exibida
     * @return type
     */

    public function GetFlash($class, $type, $onliText = false, $messagem = null) {
        $retorno = null;

        if (!empty($class)) {

            $classe = null;
            switch ($class) {
                case 'success':
                    $classe = "alert-success";
                    break;
                case 'error':
                    $classe = "alert-danger";
                    break;
                case 'aviso':
                    $classe = "alert-warning";
                    break;
                case 'info':
                    $classe = "alert-info";
                    break;
                case 'primary':
                    $classe = "alert-primary";
                    break;
            }

            $messagem = (empty($messagem)) ? $this->GetMessenger($type) : $messagem;

            if ($onliText) {
                $retorno = $messagem;
            } else {
                $retorno = "$messagem";
            }
        }
        return $retorno;
    }

    /*     * ********************
     * FLESHMESSAGER DINAMIC
     * FUNÇÃO DA SUPORTE A GetFlash
     * ************************ *

      /**
     * retorna as menssagem padrão do sistema
     * @param type $type
     */

    public function GetMessenger($type) {
        $messagem = null;
        switch ($type) { 	  
            case 'atualizado_sucesso':
                $messagem = "Os dados foram atualizados com sucesso.";
                break;          
            case 'cadastrado_sucesso':
                $messagem = "Seu cadastro foi efetuado com sucesso.";
                break;
            case 'excluido_sucesso':
                $messagem = "Item excluído com sucesso.";
                break;
            case 'excluido_erro':
                $messagem = "Ocorreu um erro ao tentar excluir.";
                break;
            
        }
        return $messagem;
    }
    

}
