<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Model\Entity\Pedido;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\Locator\TableLocator;

class SiteUtilsPedido
{

    protected $tableLocator;

    protected $empresaUtils;


    public function __construct()
    {
        $this->tableLocator = new TableLocator();
        $this->empresaUtils = new EmpresaUtils();
    }

    public function existsPedidoEmAberto($clienteId, $returnModel = false){
        $pedidoAberto = $this->getTableLocator()->get('Pedidos')->find()->where(['user_id' => $clienteId, 'status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_CLIENTE])->first();
        if($pedidoAberto && !$returnModel){
            return $pedidoAberto->id;
        }elseif($pedidoAberto && $returnModel){
            return $pedidoAberto;
        }
        return false;
    }

    public function getProdutosMaisVendidos($limit = 3){
        $sql = 'SELECT produto_id, COUNT(produto_id) as quantidade FROM pedidos_produtos GROUP BY produto_id ORDER BY quantidade DESC LIMIT '.$limit;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)
            ->fetchAll('assoc');
        $produtos = [];
        foreach ($results as $result){
            $produtos[] = $this->getTableLocator()->get('Produtos')->find()->where(['id' => $result['produto_id']])->first();
        }
        return $produtos;
    }

    public function empresaAberta($empresaId = null){
        if(!$empresaId){
            $empresaId = $this->empresaUtils->getEmpresaBase();
        }
        $data = date('Y-m-d');
        //Condiz com a lista de dias da semana Em HorariosAtendimento
        $diasemana = date('w', strtotime($data));
        $horaAtual =  date('H:i:s');
        $horario = $this->tableLocator->get('HorariosAtendimentos')
            ->find()
            ->where(['empresa_id' => $empresaId,
                     'dia_semana' => intval($diasemana),
                     'hora_inicio <=' => $horaAtual,
                     'hora_fim >= ' => $horaAtual,
            ])->first();

        $feriado = $this->tableLocator->get('DiasFechados')
            ->find()
            ->where(['empresa_id' => $empresaId,
                     'dia_fechado' => $data,
            ])
            ->first();
        if($horario && !$feriado){
            return true;
        }
        return false;
    }

    /**
     * @return TableLocator
     */
    public function getTableLocator()
    {
        return $this->tableLocator;
    }

    /**
     * @param TableLocator $tableLocator
     */
    public function setTableLocator($tableLocator)
    {
        $this->tableLocator = $tableLocator;
    }


}