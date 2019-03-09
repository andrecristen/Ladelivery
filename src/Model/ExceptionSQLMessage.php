<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model;


class ExceptionSQLMessage
{
    private $exceptions = [
            "unique_lista_id_opcoes"=>'Está lista já está associada a este adicional.',
            "unique_lista_produto"=>'Está lista já está associada a este produto.',
            "listas_produtos_ibfk_2"=>'Está lista possui associação a um ou mais produtos, portanto não é possivel exclui-la.',
        ];

    public function getMessage(\Exception $exception)
    {
        foreach ($this->exceptions as $key => $value){
            if (strpos($exception->getMessage(), $key) !== false) {
                return $this->exceptions[$key];
            }
        }
        return 'Erro ao realizar operação - Erro recebido:' . $exception->getMessage();
    }
}
//Exemplo de uso
//try{
//    /**
//     * BLOCO DE TENTATIVA DE CODIGO, CRUD ACTIONS
//     */
//}catch (\Exception $exception){
//    $message = new ExceptionSQLMessage();
//    $this->Flash->error(__($message->getMessage($exception)));
//}