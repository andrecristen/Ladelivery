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
        if (!$lucroMensalDelivery) {
            $lucroMensalDelivery = '0.00';
        }
        $lucroMensalComandas = $this->getValorVendidoComandas($this->empresaUtils->getUserEmpresaId());
        if (!$lucroMensalComandas) {
            $lucroMensalComandas = '0.00';
        }
        $produtosMaisComprados = $this->getProdutosMaisComprados();
        $produtos = [];
        if ($produtosMaisComprados) {
            foreach ($produtosMaisComprados as $produtoMaisComprado) {
                $produtos[] = ['quantidade' => $produtoMaisComprado['total'], 'nome' => $produtoMaisComprado['nome_produto']];
            }
        }
        $vendasDiasSemana = $this->getVendasPorDiaSemana();
        $vendasFormatadas = [];
        foreach ($vendasDiasSemana as $venda) {
            $vendasFormatadas[] = ['dia_semana' => $this->sqlDiaSemanaToString($venda['dia_semana']), 'vendas' => $venda['quantidade']];
        }
        $this->set(compact('pedidos', 'clientes', 'lucroMensalDelivery', 'lucroMensalComandas', 'produtos', 'vendasFormatadas'));
    }

    public function metricas()
    {

    }

    public function entregas()
    {
        $entregas = $this->getEntregasMes($this->empresaUtils->getUserEmpresaId());
        $this->set(compact('entregas'));
    }

    public function entregasGeral()
    {
        $entregas = $this->getEntregasTotal($this->empresaUtils->getUserEmpresaId());
        $this->set(compact('entregas'));
    }

    public function produtos()
    {
        $data = $this->getRequest()->getData();
        $dataAtual = new \DateTime();
        $anoVendas = isset($data['ano_vendas']) ? $data['ano_vendas'] :$dataAtual->format('Y');
        $mesProduto = isset($data['mes_produtos']) ? $data['mes_produtos'] :$dataAtual->format('m');
        $anoProduto = isset($data['ano_produtos']) ? $data['ano_produtos'] :$dataAtual->format('Y');
        $mesCategoria = isset($data['mes_categorias']) ? $data['mes_categorias'] :$dataAtual->format('m');;
        $anoCategoria = isset($data['ano_categorias']) ? $data['ano_categorias'] :$dataAtual->format('Y');
        $mesEntregas = isset($data['mes_entregas']) ? $data['mes_entregas'] :$dataAtual->format('m');;
        $anoEntregas = isset($data['ano_entregas']) ? $data['ano_entregas'] :$dataAtual->format('Y');
        $produtosMaisComprados = $this->getProdutosMaisComprados($mesProduto, $anoProduto);
        $produtos = [];
        if ($produtosMaisComprados) {
            foreach ($produtosMaisComprados as $produtoMaisComprado) {
                $produtos[] = ['quantidade' => $produtoMaisComprado['total'], 'nome' => $produtoMaisComprado['nome_produto']];
            }
        }
        $meses = $this->getVendasAgrupadasMes($anoVendas);
        $categorias = $this->getCategoriasMaisCompradas($mesCategoria, $anoCategoria);
        $entregas = $this->getEntregasMetricas($mesEntregas, $anoEntregas);

        $this->set(compact('produtos', 'categorias', 'entregas', 'meses', 'anoVendas', 'mesProduto', 'anoProduto', 'mesCategoria', 'anoCategoria', 'mesCategoria', 'mesEntregas', 'anoEntregas'));
    }

    private function getVendasAgrupadasMes($ano)
    {
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT 
                   SUM(valor_produtos + COALESCE(valor_acrescimo, 0) - COALESCE(valor_desconto, 0) + COALESCE(valor_entrega, 0)) as valor,
                 MONTH(data_pedido) as mes,
                 YEAR(data_pedido) as ano
                  FROM pedidos 
             LEFT JOIN pedidos_entregas
                    ON pedidos_entregas.pedido_id = pedidos.id
                 WHERE (status_pedido = ' . Pedido::STATUS_ENTREGUE . ' OR status_pedido = ' . Pedido::STATUS_FECHADA . ')
                   AND YEAR(data_pedido) = ' . $ano . '
              GROUP BY mes,ano';
        $results = $connection->execute($sql)
            ->fetchAll('assoc');
        return $results;
    }

    private function getEntregasTotal($empresa)
    {
        $connection = ConnectionManager::get('default');
        $sql = "SELECT sum(valor_entrega) AS valor, 
                       count(pedidos_entregas.id) AS quantidade , 
                       nome_completo,  
                       MONTH(data_pedido) mes, 
                       YEAR(data_pedido) ano
                  FROM pedidos_entregas 
                  JOIN pedidos ON pedidos_entregas.pedido_id = pedidos.id
                  JOIN users ON users.id = pedidos_entregas.user_id
                 WHERE pedidos.empresa_id = " . $empresa . "
              GROUP BY pedidos_entregas.user_id, mes, ano
              ORDER BY ano, mes DESC";
        $results = $connection->execute($sql)->fetchAll('assoc');
        return $results;
    }

    private function getEntregasMes($empresa)
    {
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT sum(valor_entrega) AS valor, 
                       count(pedidos_entregas.id) AS quantidade , 
                       nome_completo
                  FROM pedidos_entregas 
                  JOIN pedidos ON pedidos_entregas.pedido_id = pedidos.id
             LEFT JOIN users ON users.id = pedidos_entregas.user_id
                 WHERE MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
                   AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
              GROUP BY pedidos_entregas.user_id
              ORDER BY 1 DESC';
        $results = $connection->execute($sql)->fetchAll('assoc');
        return $results;
    }

    private function getEntregasMetricas($mes = 'MONTH(CURRENT_TIMESTAMP)', $ano = 'YEAR(CURRENT_TIMESTAMP)')
    {
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT AVG(valor_entrega) AS media, 
                       COUNT(pedidos_entregas.id) realizadas,
                       MIN(valor_entrega) barata,
                       MAX(valor_entrega) cara,
                       MONTH(data_pedido) mes,
                       YEAR(data_pedido) ano
                  FROM pedidos_entregas 
                  JOIN pedidos 
                    ON pedidos_entregas.pedido_id = pedidos.id
                 WHERE MONTH(data_pedido) = '.$mes.'
                   AND YEAR(data_pedido) = '.$ano.'
                   GROUP BY mes, ano';
        $results = $connection->execute($sql)->fetchAll('assoc');
        if (isset($results[0])) {
            $results = $results[0];
        }
        return $results;
    }

    private function getProdutosMaisComprados($mes = 'MONTH(CURRENT_TIMESTAMP)', $ano = 'YEAR(CURRENT_TIMESTAMP)')
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT produto_id, 
                                                      sum(quantidade) AS total,
                                                      nome_produto 
                                                      FROM pedidos_produtos 
                                                      JOIN pedidos 
                                                      ON pedidos.id = pedidos_produtos.pedido_id 
                                                      JOIN produtos 
                                                      ON produtos.id = pedidos_produtos.produto_id 
                                                      WHERE MONTH(data_pedido) = '.$mes.'
                                                      AND YEAR(data_pedido) =  '.$ano.'
                                                      GROUP BY 1 
                                                      ORDER BY 2 
                                                      DESC LIMIT 10')->fetchAll('assoc');
        return $results;
    }

    private function getCategoriasMaisCompradas($mes = 'MONTH(CURRENT_TIMESTAMP)' , $ano = 'YEAR(CURRENT_TIMESTAMP)')
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT categorias_produtos.*, 
                                                      sum(quantidade) AS total
                                                      FROM pedidos_produtos 
                                                      JOIN pedidos 
                                                      ON pedidos.id = pedidos_produtos.pedido_id 
                                                      JOIN produtos 
                                                      ON produtos.id = pedidos_produtos.produto_id
                                                      JOIN categorias_produtos 
                                                      ON produtos.categorias_produto_id = categorias_produtos.id 
                                                      WHERE MONTH(data_pedido) = '.$mes.'
                                                      AND YEAR(data_pedido) =  '.$ano.'
                                                      GROUP BY 1
                                                      ORDER BY total 
                                                      DESC LIMIT 10')->fetchAll('assoc');
        return $results;
    }

    private function getVendasPorDiaSemana()
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT count(1) as quantidade, weekday(data_pedido) as dia_semana from pedidos WHERE MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)  AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP) group by 2')->fetchAll('assoc');
        return $results;
    }

    public function comissaoEntregador()
    {
        $entregadores = $this->getTableLocator()->get('Users')->find('list')->where(['tipo' => User::TIPO_ENTREGADOR]);
        $this->set(compact('entregadores'));
        if ($this->getRequest()->is('post')) {
            $data = $this->getRequest()->getData();
            $valorComissao = $this->getComissaoEntregador($data['entregador'], $data['inicio_periodo'], $data['fim_periodo'], $data['porcentagem']);
            $this->Flash->info(__('Comissão calculada, valor obtido: R$' . $valorComissao));
            return;
        }
    }

    private function getComissaoEntregador($entregadorId, $inicio, $fim, $porcentagem)
    {
        $connection = ConnectionManager::get('default');
        $sql = "SELECT sum(valor_entrega) AS valor
                  FROM pedidos_entregas 
                  JOIN pedidos ON pedidos_entregas.pedido_id = pedidos.id
                  JOIN users ON users.id = pedidos_entregas.user_id
                 WHERE pedidos_entregas.user_id = " . $entregadorId . "
                   AND data_pedido BETWEEN '" . $inicio . "' AND '" . $fim . "'
                 LIMIT 1";
        $results = $connection->execute($sql)->fetchAll('assoc');
        return ($results[0]['valor'] * ($porcentagem / 100));
    }

    private function getValorVendidoDelivery($empresa)
    {
        $connection = ConnectionManager::get('default');
        $sql = 'SELECT SUM(valor_produtos + COALESCE(valor_acrescimo, 0) - COALESCE(valor_desconto, 0) + COALESCE(valor_entrega, 0)) as valor_total
                  FROM pedidos 
             LEFT JOIN pedidos_entregas
                    ON pedidos_entregas.pedido_id = pedidos.id
                 WHERE status_pedido = ' . Pedido::STATUS_ENTREGUE . '
             AND MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
              AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
                   AND tipo_pedido = ' . Pedido::TIPO_PEDIDO_DELIVERY;
        $results = $connection->execute($sql)
            ->fetchAll('assoc');
        return $results[0]['valor_total'];
    }

    private function getValorVendidoComandas($empresa)
    {
        $connection = ConnectionManager::get('default');
        $results = $connection->execute('SELECT SUM(valor_produtos) as valor_total
                                                 FROM pedidos 
                                                WHERE empresa_id = ' . $empresa . '
                                                  AND status_pedido = ' . Pedido::STATUS_FECHADA . ' 
                                                  AND MONTH(data_pedido) = MONTH(CURRENT_TIMESTAMP)
                                                  AND YEAR(data_pedido) = YEAR(CURRENT_TIMESTAMP)
                                                  AND tipo_pedido = ' . Pedido::TIPO_PEDIDO_COMANDA)
            ->fetchAll('assoc');
        return $results[0]['valor_total'];
    }

    private function sqlDiaSemanaToString($diaSemana)
    {
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