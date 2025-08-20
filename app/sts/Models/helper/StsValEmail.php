<?php

namespace Sts\Models\helper;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em verificar se os campos foram preenchidos.
 */
class StsValEmail
{
    private bool $result; // -> Recebe o resultado da QUERY.
    private string|array $data = ""; // -> Recebe os inputs que serão validados por este helper.

    /**
     * Recebe true se preencheu com sucesso ou false se não preencheu.
     * @return boolean
     */
    public function getResult(): bool
    {
        return $this->result;
    }

    public function valEmail(string $data)
    {
        $this->data = $data;
        $arrayOfCaracteres = str_split($this->data);
        if (in_array('@', $arrayOfCaracteres)) { // -> Retorna TRUE se existir algum @(arroba) no array.
            $index = array_search('@', $arrayOfCaracteres); // -> Retorna a posição do array que o valor é o @.
            $index1 = $index + 1;
            $index2 = $index + 2;
            $index3 = $index + 3;
            if (isset($arrayOfCaracteres[$index3])) {
                if (preg_match('/^[a-zA-Z]$/', $arrayOfCaracteres[$index3]) === 1) {
                    if (in_array('.', $arrayOfCaracteres)) {
                        $indexPoint = array_search('.', $arrayOfCaracteres);
                        $indexPoint1 = $indexPoint + 1;
                        $indexPoint2 = $indexPoint + 2;
                        if (isset($arrayOfCaracteres[$indexPoint2])) {
                            if (preg_match('/^[a-zA-Z]$/', $arrayOfCaracteres[$indexPoint2]) === 1) {
                                $this->result = true;
                            } else {
                                $_SESSION['msg'] = "<p style='color: red;'>Proibido números na extensão do e-mail!</p>";
                                $this->result = false;
                            }
                        } else if (isset($arrayOfCaracteres[$indexPoint1])) {
                            if (preg_match('/^[a-zA-Z]$/', $arrayOfCaracteres[$indexPoint1]) === 1) {
                                $_SESSION['msg'] = "<p style='color: red;'>Informe a extensão completa do domínio do e-mail!</p>";
                                $this->result = false;
                            } else {
                                $_SESSION['msg'] = "<p style='color: red;'>Proibido números na extensão do e-mail!</p>";
                                $this->result = false;
                            }
                        } else {
                            $_SESSION['msg'] = "<p style='color: red;'>Complete a extensão do domínio do e-mail!</p>";
                            $this->result = false;
                        }
                    } else {
                        $_SESSION['msg'] = "<p style='color: red;'>Informe a extensão do domínio do e-mail!</p>";
                        $this->result = false;
                    }
                } else {
                    $_SESSION['msg'] = "<p style='color: red;'>Proibido números no domínio do e-mail!</p>";
                    $this->result = false;
                }
            } else if (isset($arrayOfCaracteres[$index2])) {
                if (preg_match('/^[a-zA-Z]$/', $arrayOfCaracteres[$index2]) === 1) {
                    $_SESSION['msg'] = "<p style='color: red;'>Complete o domínio do e-mail!</p>";
                    $this->result = false;
                } else {
                    $_SESSION['msg'] = "<p style='color: red;'>Proibido números no domínio do e-mail!</p>";
                    $this->result = false;
                }
            } else if (isset($arrayOfCaracteres[$index1])) {
                if (preg_match('/^[a-zA-Z]$/', $arrayOfCaracteres[$index1]) === 1) {
                    $_SESSION['msg'] = "<p style='color: red;'>Complete o domínio do e-mail!</p>";
                    $this->result = false;
                } else {
                    $_SESSION['msg'] = "<p style='color: red;'>Proibido números no domínio do e-mail!</p>";
                    $this->result = false;
                }
            } else {
                $_SESSION['msg'] = "<p style='color: red;'>Informe o domínio do e-mail e sua extensão!</p>";
                $this->result = false;
            }
        } else {
            $_SESSION['msg'] = "<p style='color: red;'>Informe o '@', o domínio do e-mail e sua extensão!</p>";
            $this->result = false;
        }
    }
}
