<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Controller;


use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use App\Model\Table\PedidosProdutosTable;
use App\Model\Utils\EmpresaUtils;
use Cake\Datasource\ConnectionManager;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

class FinanceiroController extends AppController
{
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
        $this->validateActions();
    }

    public function painel()
    {
        $pedidosModel = $this->getTableLocator()->get('Pedidos')
            ->find();
        $pedidos = $pedidosModel->where(
            [
                'empresa_id' => $this->empresaUtils->getUserEmpresaId(),
                'status_pedido' => Pedido::STATUS_AGUARDANDO_CONFIRMACAO_EMPRESA
            ])->count();
        $mensagens = 0;
        $dataAtual = new \DateTime();
        $mes = $dataAtual->format('m');
        $lucroMensalDelivery = $this->getValorVendidoDelivery($mes, $this->empresaUtils->getUserEmpresaId());
        if(!$lucroMensalDelivery){
            $lucroMensalDelivery = '0.00';
        }
        $lucroMensalComandas = $this->getValorVendidoComandas($mes, $this->empresaUtils->getUserEmpresaId());
        if(!$lucroMensalComandas){
            $lucroMensalComandas = '0.00';
        }
        $produtosMaisComprados = $this->getProdutosMaisComprados($mes);
        $produtos = [];
        foreach ($produtosMaisComprados as $produtoMaisComprado) {
            $produtos[] = ['quantidade' => $produtoMaisComprado['total'], 'nome' => $produtoMaisComprado['produto_id']];
        }
        $vendasDiasSemana = $this->getVendasPorDiaSemana($mes);
        $vendasFormatadas = [];
        foreach ($vendasDiasSemana as $venda){
            $vendasFormatadas[] = ['dia_semana' => $this->sqlDiaSemanaToString($venda['dia_semana']), 'vendas' => $venda['quantidade']];
        }
        $this->set(compact('pedidos', 'mensagens', 'lucroMensalDelivery', 'lucroMensalComandas', 'produtos', 'vendasFormatadas'));
    }

    public function metricas(){

    }

    private function getProdutosMaisComprados($mes)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT produto_id, sum(quantidade) AS total FROM pedidos_produtos JOIN pedidos ON pedidos.id = pedidos_produtos.pedido_id  WHERE MONTH(data_pedido) = '.$mes.' GROUP BY 1 ORDER BY 2 DESC LIMIT 10')->fetchAll('assoc');
        return $results;
    }

    private function getVendasPorDiaSemana($mes){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT count(1) as quantidade, weekday(data_pedido) as dia_semana from pedidos WHERE MONTH(data_pedido) = '.$mes.' group by 2')->fetchAll('assoc');
        return $results;
    }

    private function getValorVendidoDelivery($mes, $empresa){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT SUM(valor_total_cobrado) as valor_total
                                                 FROM pedidos 
                                                WHERE empresa_id = '.$empresa.'
                                                  AND status_pedido in ('.Pedido::STATUS_ENTREGUE.','.Pedido::STATUS_AGUARDANDO_COLETA_CLIENTE.','.Pedido::STATUS_SAIU_PARA_ENTREGA.') 
                                                  AND MONTH(data_pedido) = '.$mes.'
                                                  AND tipo_pedido = '.Pedido::TIPO_PEDIDO_DELIVERY)
            ->fetchAll('assoc');
        return $results[0]['valor_total'];
    }

    private function getValorVendidoComandas($mes, $empresa){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT SUM(valor_total_cobrado) as valor_total
                                                 FROM pedidos 
                                                WHERE empresa_id = '.$empresa.'
                                                  AND status_pedido = '.Pedido::STATUS_FECHADA.' 
                                                  AND MONTH(data_pedido) = '.$mes.'
                                                  AND tipo_pedido = '.Pedido::TIPO_PEDIDO_COMANDA)
            ->fetchAll('assoc');
        return $results[0]['valor_total'];
    }

    private function sqlDiaSemanaToString($diaSemana){
        $diasSemana = [
            0 => 'Segunda-Feira',
            1 => 'Terça-Feira',
            2 => 'Quarta-Feira',
            3 => 'Quinta-Feira',
            4 => 'Sexta-Feira',
            5 => 'Sábado',
            6 => 'Domingo',
        ];
        return $diasSemana[$diaSemana];
    }
}