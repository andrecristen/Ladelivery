<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Controller;


use App\Model\Entity\Pedido;
use App\Model\Entity\PedidosProduto;
use App\Model\Entity\User;
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
        $clientes = $this->getTableLocator()->get('Users')->find()->where(['tipo' => User::TIPO_CLIENTE])->count();
        $lucroMensalDelivery = $this->getValorVendidoDelivery($this->empresaUtils->getUserEmpresaId());
        if(!$lucroMensalDelivery){
            $lucroMensalDelivery = '0.00';
        }
        $lucroMensalComandas = $this->getValorVendidoComandas($this->empresaUtils->getUserEmpresaId());
        if(!$lucroMensalComandas){
            $lucroMensalComandas = '0.00';
        }
        $produtosMaisComprados = $this->getProdutosMaisComprados();
        $produtos = [];
        foreach ($produtosMaisComprados as $produtoMaisComprado) {
            $produtos[] = ['quantidade' => $produtoMaisComprado['total'], 'nome' => $produtoMaisComprado['produto_id']];
        }
        $vendasDiasSemana = $this->getVendasPorDiaSemana();
        $vendasFormatadas = [];
        foreach ($vendasDiasSemana as $venda){
            $vendasFormatadas[] = ['dia_semana' => $this->sqlDiaSemanaToString($venda['dia_semana']), 'vendas' => $venda['quantidade']];
        }
        $this->set(compact('pedidos', 'clientes', 'lucroMensalDelivery', 'lucroMensalComandas', 'produtos', 'vendasFormatadas'));
    }

    public function metricas(){

    }

    public function entregas(){
        $entregas = $this->getEntregasMes($this->empresaUtils->getUserEmpresaId());
        $this->set(compact('entregas'));
    }

    public function produtos(){
        $produtos = $this->getProdutosMes($this->empresaUtils->getUserEmpresaId());
        $this->set(compact('produtos'));
    }

    private function getEntregasMes($empresa){
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT sum(valor_entrega) AS valor, count(pedidos_entregas.id) AS quantidade , nome_completo
                  FROM pedidos_entregas 
                  JOIN pedidos ON pedidos_entregas.pedido_id = pedidos.id
                  JOIN users ON users.id = pedidos_entregas.user_id
                 WHERE MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
                   AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
                   AND pedidos.empresa_id = '.$empresa.'
              GROUP BY pedidos_entregas.user_id
              ORDER BY 1 DESC';
        $results = $connection->execute($sql)->fetchAll('assoc');
        return $results;
    }

    private function getProdutosMaisComprados()
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT produto_id, sum(quantidade) AS total FROM pedidos_produtos JOIN pedidos ON pedidos.id = pedidos_produtos.pedido_id  WHERE MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP) AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP) GROUP BY 1 ORDER BY 2 DESC LIMIT 10')->fetchAll('assoc');
        return $results;
    }

    private function getVendasPorDiaSemana(){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT count(1) as quantidade, weekday(data_pedido) as dia_semana from pedidos WHERE MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)  AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP) group by 2')->fetchAll('assoc');
        return $results;
    }

    public function comissaoEntregador(){
        $entregadores = $this->getTableLocator()->get('Users')->find('list')->where(['tipo' => User::TIPO_ENTREGADOR]);
        $this->set(compact('entregadores'));
        if($this->getRequest()->is('post')){
            $data = $this->getRequest()->getData();
            $valorComissao = $this->getComissaoEntregador($data['entregador'], $data['inicio_periodo'], $data['fim_periodo'], $data['porcentagem']);
            $this->Flash->info(__('Comissão calculada, valor obtido: R$'.$valorComissao));
            return;
        }
    }

    private function getComissaoEntregador($entregadorId, $inicio, $fim, $porcentagem){
        $connection = ConnectionManager::get('default');
        $sql = "SELECT sum(valor_entrega) AS valor
                  FROM pedidos_entregas 
                  JOIN pedidos ON pedidos_entregas.pedido_id = pedidos.id
                  JOIN users ON users.id = pedidos_entregas.user_id
                 WHERE pedidos_entregas.user_id = ".$entregadorId."
                   AND data_pedido BETWEEN '".$inicio."' AND '".$fim."'
                 LIMIT 1";
        $results = $connection->execute($sql)->fetchAll('assoc');
        return ($results[0]['valor'] * ($porcentagem / 100));
    }

    private function getValorVendidoDelivery($empresa){
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT SUM(valor_total_cobrado) as valor_total
                  FROM pedidos 
                 WHERE empresa_id = '.$empresa.'
                   AND status_pedido = '.Pedido::STATUS_ENTREGUE.'
             AND MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
              AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
                   AND tipo_pedido = '.Pedido::TIPO_PEDIDO_DELIVERY;
        $results = $connection->execute($sql)
            ->fetchAll('assoc');
        return $results[0]['valor_total'];
    }

    private function getValorVendidoComandas($empresa){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT SUM(valor_total_cobrado) as valor_total
                                                 FROM pedidos 
                                                WHERE empresa_id = '.$empresa.'
                                                  AND status_pedido = '.Pedido::STATUS_FECHADA.' 
                                                  AND MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
                                                  AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
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