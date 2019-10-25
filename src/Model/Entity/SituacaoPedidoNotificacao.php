<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SituacaoPedidoNotificacao Entity
 *
 * @property int $id
 * @property int $situacao_pedido
 * @property string $template_titulo
 * @property string $template_mensagem
 */
class SituacaoPedidoNotificacao extends Entity
{

    const USER_NAME = '{{cliente}}';
    const LINK_SITE = '{{linkSite}}';
    const NOME_SITEMA = '{{nomeSistema}}';
    const NOME_LOJA= '{{nomeLoja}}';
    const PEDIDO_ID = '{{pedido}}';
    const PEDIDO_VALOR = '{{valorTotal}}';
    const PEDIDO_DESCONTO = '{{valorDesconto}}';
    const PEDIDO_ACRESCIMO = '{{valorAcrescimo}}';
    const PEDIDO_PRODUTOS = '{{valorProdutos}}';
    const PEDIDO_REJEICAO = '{{rejeicao}}';
    const TEMPO_PRODUCAO = '{{tempoProducao}}';
    const FORMA_PAGAMENTO = '{{formaPagamento}}';
    const PEDIDO_STATUS = '{{situacao}}';

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'situacao_pedido' => true,
        'template_titulo' => true,
        'template_mensagem' => true
    ];
}
