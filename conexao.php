<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "company";

    if ($conn = mysqli_connect($server, $user, $pass, $bd)) {
        echo "";
    }
    else {
        echo "Erro";
    }

    function mostra_data($data) {
    if (!$data) return ""; // Caso a data esteja vazia no banco
    
    // O separador correto é o hífen "-" que vem do MySQL
    $d = explode("-", $data); 
    
    // Monta no padrão brasileiro: dia/mes/ano
    $dt = $d[2] . "/" . $d[1] . "/" . $d[0]; 
    
    return $dt;
}

    /**
     * Nome da coluna de chave primária em `pessoas` (ex.: id ou cod_pessoa).
     * Usa SHOW COLUMNS, depois SHOW INDEX, depois inspeção de uma linha.
     */
    function pessoas_primary_key($conn) {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }
        // Este projeto: PK da tabela `pessoas` = `cod_pessoa` (INT), conforme DBeaver.
        if (!$conn instanceof mysqli) {
            $cache = "cod_pessoa";
            return $cache;
        }
        $ordered = [];
        $res = mysqli_query($conn, "SHOW COLUMNS FROM `pessoas` WHERE `Key` = 'PRI'");
        if ($res && ($row = mysqli_fetch_assoc($res)) && !empty($row["Field"])) {
            $ordered[] = $row["Field"];
        }
        $res2 = mysqli_query($conn, "SHOW INDEX FROM `pessoas` WHERE `Key_name` = 'PRIMARY' AND `Seq_in_index` = 1");
        if ($res2 && ($row2 = mysqli_fetch_assoc($res2)) && !empty($row2["Column_name"])) {
            $ordered[] = $row2["Column_name"];
        }
        $r3 = mysqli_query($conn, "SELECT * FROM `pessoas` LIMIT 1");
        if ($r3 && ($row3 = mysqli_fetch_assoc($r3))) {
            foreach (["cod_pessoa", "id"] as $c) {
                if (array_key_exists($c, $row3)) {
                    $ordered[] = $c;
                }
            }
        }
        $ordered = array_unique($ordered);
        foreach ($ordered as $field) {
            if (preg_match("/^[a-zA-Z0-9_]+$/", $field)) {
                $cache = $field;
                return $cache;
            }
        }
        $cache = "cod_pessoa";
        return $cache;
    }

    /**
     * Valor do ID na linha (para montar o link Editar), tentando PK e nomes comuns.
     */
    function pessoas_row_id(array $linha, $conn) {
        $pk = pessoas_primary_key($conn);
        foreach (array_unique(array_filter([$pk, "cod_pessoa", "id"])) as $col) {
            if (!isset($linha[$col])) {
                continue;
            }
            $v = $linha[$col];
            if ($v === null || $v === "") {
                continue;
            }
            return trim((string) $v);
        }
        return "";
    }

    /**
     * Valor SQL seguro para WHERE `coluna_pk` = … (inteiro sem aspas ou string entre aspas).
     *
     * @return array{0:bool,1:string} [ok, fragmento depois do =]
     */
    function pessoas_sql_pk_value(mysqli $conn, $pkColumn, $rawId) {
        $rawId = trim((string) $rawId);
        if ($rawId === "" || !preg_match("/^[a-zA-Z0-9_]+$/", (string) $pkColumn)) {
            return [false, ""];
        }
        if (ctype_digit($rawId)) {
            return [true, $rawId];
        }
        if (preg_match("/^[A-Za-z0-9_.-]+$/", $rawId)) {
            return [true, "'" . mysqli_real_escape_string($conn, $rawId) . "'"];
        }
        return [false, ""];
    }

?>

