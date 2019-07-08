<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model;


class ExceptionSQLMessage
{
    private $exceptions = [
            "unique_lista_id_opcoes"=>'Esta lista já está associada a este adicional.',
            "unique_lista_produto"=>'Esta lista já está associada a este produto.',
            "listas_produtos_ibfk_2"=>'Esta lista possui associação a um ou mais produtos, portanto não é possivel exclui-la.',
            "categorias_produto_id"=>'Esta categoria possui um ou mais produtos nela, certifique-se de mudar esses produtos de categoria antes de excluir esta categoria.',
            "uq_pedido_entrega" => 'Este pedido já possui uma entrega definida, caso necessite alterar valor utilize a conta de Entregas.'
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