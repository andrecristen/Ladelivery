<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Controller;


use App\Model\Entity\Pedido;
use App\Model\Utils\EmpresaUtils;
use Cake\Http\Response;
use Cake\Http\ServerRequest;

class FinanceiroController extends AppController
{
    protected $empresaUtils;

    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, \Cake\Event\EventManager $eventManager = null, ComponentRegistry $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->empresaUtils = new EmpresaUtils();
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
        $mensagens = 1;
        $dataAtual = new \DateTime();
        $mes = $dataAtual->format('m');
        $ano = $dataAtual->format('Y');
        $lucroMensal = $pedidosModel->where(
            [
                'empresa_id' => $this->empresaUtils->getUserEmpresaId(),
                'MONTH(data_pedido)' => $mes
            ]
        )->sumOf('valor_total_cobrado');

        $lucroAnual =  $this->getTableLocator()->get('Pedidos')
            ->find()->where(
            [
                'empresa_id' => $this->empresaUtils->getUserEmpresaId(),
                'YEAR(data_pedido)' => $ano
            ]
        )->sumOf('valor_total_cobrado');
        $this->set(compact('pedidos', 'mensagens', 'lucroMensal', 'lucroAnual'));
     }
}