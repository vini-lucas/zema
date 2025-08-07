<?php

namespace Sts\Models\helper;

use PDO;
use PDOException;

/**
 * Caso o usuário tente acessar a página sem ser pelo arquivo index, acessa este if.
 */
if (!defined('L4bar3tTA!')) {
    header("Location: /");
}

/**
 * Helper responsável em deletar registros no banco de dados.
 */
class StsDelete extends StsConn
{
    
}
