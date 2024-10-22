<?php  

function conectarDB()
{

    $servername = "localhost";
    $dbname = "bancoexplopping";
    $username = "admin";
    $passwd = "123";

    try{
    $con = new PDO("mysql:host=" . $servername . "; dbname=" . $dbname, $username, $passwd, 
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
if($con){

    // echo "sucesso";
    return$con;
}else{
    return null;
}

}catch(Exception $e){
        print($e);
    }

}

// conectarDB();

function gravarDados($con, $tabela, array $dados){

    $sql = "INSERT INTO $tabela (Nome, Email, Senha)
    VALUES ('".$dados[0]."', '".$dados[1]."', '".$dados[2]."');";
    
    $query = $con->prepare($sql);
    
    $resultado = $query->execute(); //execulta query do Bando de Dados
    
    if($resultado){
    
        return true;
    }else{
        
        return false;
    }
}

function login($con, $username){
    
    $sql = "SELECT Email, Senha FROM usuario WHERE Email = '".$username."';";

    $query = $con->prepare($sql);//execulta a query no banco

    $query->execute();

    $rs = $query->fetchAll(PDO::FETCH_ASSOC);

    return $rs;
}

?>
