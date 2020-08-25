<?php
/**
 * Description
 * @param type $sql recebe um script sql select
 * @return type retorna um array com a consulta sql recebida no parametro
 */
function abre_conexao()
{
    $link  = mysqli_connect(DBHOST, USER, PASSWORD, BD); // homologação    
    return $link;
}
function fecha_conexao()
{
    mysqli_close();
}
function retorna_consulta($sql)
{   
    $link = abre_conexao();
      
    try{         

        $retorno_consulta = mysqli_query($link, $sql);  
        $numRegistros = mysqli_num_rows($retorno_consulta);
        $results = array();
        
        if($numRegistros > 0)
        {         
            while ($result = mysqli_fetch_array($retorno_consulta)) 
            {
                $results[] = array_map("utf8_encode", $result);
            }
        }

        return $results;
        fecha_conexao();
    
    } catch (Exception $e){
       fecha_conexao();
       return $e; 
    }
}
function retorna_consulta2($sql)
{   
    $link = abre_conexao();
      
    try{         

        $retorno_consulta = mysqli_query($link, $sql);  
        $numRegistros = mysqli_num_rows($retorno_consulta);
        $results = array();
        
        if($numRegistros > 0)
        {         
            while ($result = mysqli_fetch_array($retorno_consulta)) 
            {
                $results[] = $result["id_cliente"];
            }
        }

        return $results;
        fecha_conexao();
    
    } catch (Exception $e){
       fecha_conexao();
       return $e; 
    }
}
/**
 * Description
 * @param type $sql recebe um script sql insert ou update
 * @return type se inseriu no banco de dados retorna true senao inseriu retorna false
 */
function salvar($sql)
{   
    $link = abre_conexao();

    try{

        $sucess = mysqli_query($link, $sql);
        $id = mysqli_insert_id($link);
        
        if($sucess)
            return $id;
        else
            return false;

        fecha_conexao();    
    
    } catch (Exception $e){
        fecha_conexao();
        return false; 
    }
}
function salvarSpecial($sql)
{   
    $link = abre_conexao();

    try{

        $sucess = mysqli_query($link, $sql);
        
        if($sucess)
            return true;
        else
            return false;

        fecha_conexao();    
    
    } catch (Exception $e){
        fecha_conexao();
        return false; 
    }
}
function editar($sql)
{
    $link = abre_conexao();

    try{

        $sucess = mysqli_query($link, $sql);
        
        if($sucess)
            return true;
        else
            return false;

        fecha_conexao();    
    
    } catch (Exception $e){
        fecha_conexao();
        return false; 
    }  
}
function deletar($sql)
{
    $link = abre_conexao();

    try{

        $sucess = mysqli_query($link, $sql);
        
        if($sucess)
            return true;
        else
            return false;

        fecha_conexao();    
    
    } catch (Exception $e){
        fecha_conexao();
        return false; 
    }  
}
/**
 * Description
 * @param type $size recebe um valor do tipo inteiro que será o tamanho da string base para criptografar dados 
 * @return type retona uma string gerada randomicamente do tamanho passado como parametro que será usada no hash da criptografia
 */
function generateRandomString($size)
{
    if ( $size % 2 != 0 ) throw new Exception("O parametro da funcao generateRandomString deve ser um numero par", 1);

    $size   = $size / 2;
    $bytes  = openssl_random_pseudo_bytes( $size );
    $random = bin2hex( $bytes );

    return $random;
}
/**
 * Description
 * @param type $param_name recebe um variavel $_POST ou $_GET e limpa seu conteudo protegendo contra sql injection ou outras invasões
 * @return type retona o valor limpo de invasões
 */
function sanitize( $param_name )
{
    $link  = mysqli_connect(DBHOST, USER, PASSWORD, BD ) or die(mysqli_error()); // homologação    
    
    if ( isset($_GET[$param_name]) ) return strtoupper(utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string($link, $_GET[$param_name])))))));
    else if ( isset($_POST[$param_name]) ) return strtoupper(utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string($link, $_POST[$param_name])))))));
    else return null;
}
/**
 * Description
 * @param type $dado parametro passado pela função sanitize_array
 * @return type retonar posicao por posicao do array limpo para a funcao sanitize_array
 */
function sanitize2( $dado )
{   
    $link  = mysqli_connect(DBHOST, USER, PASSWORD, BD); // homologação        
    return strtoupper(utf8_decode(trim(preg_replace('/\s+/', ' ',(strip_tags(mysqli_real_escape_string( $link, $dado)))))));
}
/**
 * Description
 * @param type $array recebe um array do tipo $_POST ou $_GET e limpa seu conteudo protegendo contra sql injection ou outras invasões
 * @return type retorna o array limpo
 */
function sanitize_array( $array )
{
    if( ! is_array( $array ) ) return false;

    foreach( $array as $key => $value )
    {
        $array[$key] = sanitize2( $array[$key] );
    }

    return $array;
}
function dataParaBanco( $data )
{
    if ($data == '' )
        return null;
    
    $date = date_create_from_format('d/m/Y', $data);

    return date_format($date, 'Y-m-d').' 00:00:00';
}
function dataParaBanco2( $data )
{
    if ($data == '' )
        return null;
    
    $date = date_create_from_format('d/m/Y', $data);

    return date_format($date, 'Y-m-d');
}
function ip()
{
    if(!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function curl_info($url)
{
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_HEADER, 1);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 30 );
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
    
    $content = curl_exec( $ch );
    $info = curl_getinfo( $ch );
    curl_close($ch);

    return $info;
}
function get_request( $url ) 
{
    if( ! isset( $url ) ) return false;
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    $data = curl_exec( $ch );
    curl_close( $ch );
    return $data;
}
function getLastId($id, $tabela)
{
    $sql = "select max($id) id from $tabela";
    $result = retorna_consulta($sql);

    return $result[0]["id"];
}
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}