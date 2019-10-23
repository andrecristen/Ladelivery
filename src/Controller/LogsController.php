<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Log;
use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\TableLocator;

/**
 * Logs Controller
 *
 * @property \App\Model\Table\LogsTable $Logs
 *
 * @method \App\Model\Entity\Log[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogsController extends AppController
{
    public function __construct(ServerRequest $request = null, Response $response = null, $name = null, $eventManager = null, $components = null)
    {
        parent::__construct($request, $response, $name, $eventManager, $components);
        $this->setPublicAction('countNotificacaoSite');
        $this->validateActions();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($isNotificacao = false)
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $fixed = [];
        if($isNotificacao){
            $fixed = [
                'Logs.tipo' => Log::TIPO_NOTIFICACAO_USUARIO
            ];
        }
        $logs = $this->paginate($this->Logs->find()->where($this->generateConditionsFind(false, $fixed)));

        $this->set(compact('logs'));
    }

    /**
     * View method
     *
     * @param string|null $id Log id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $log = $this->Logs->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('log', $log);
    }

    public static function newInstanceLog($tipo, $mensagem, $userId = false){
        $tableLocator = new TableLocator();
        $tableLogs = $tableLocator->get('Logs');
        $newLog = $tableLogs->newEntity();
        $newLog->tipo = $tipo;
        $newLog->descricao = $mensagem;
        if($userId){
            $newLog->user_id = $userId;
        }
        $newLog->situacao = Log::SITUACAO_LIDA;
        if($tipo == Log::TIPO_NOTIFICACAO_USUARIO){
            $newLog->situacao = Log::SITUACAO_PENDENTE;
        }
        $newLog->data_hora = new \DateTime();
        $tableLogs->save($newLog);
    }

    public function countNotificacaoSite(){
        $this->render(false);
        $count = 0;
        if($this->Auth->user('id')){
            $count = $this->Logs->find()->where(['user_id' => $this->Auth->user('id'), 'tipo' => Log::TIPO_NOTIFICACAO_USUARIO, 'situacao' => Log::SITUACAO_PENDENTE])->count();
        }
        echo json_encode(['notificacoes' => $count]);
    }
}
