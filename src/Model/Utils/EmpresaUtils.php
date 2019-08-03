<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use App\Controller\AppController;
use App\Model\Entity\Empresa;
use App\Model\Entity\EnderecosEmpresa;
use App\Model\Entity\GoogleMapsApiKey;
use Cake\ORM\Locator\TableLocator;

/*
 * Classe usada para minimizar buscas ao banco de dados
 * trata-se de uma configuracao para o sistema
 * deve ser utilizada para o nicho de uma empresa so.
 */
class EmpresaUtils extends AppController
{
    const NOME_EMPRESA_LOJA = 'Baiucas & Bonna';
    const ANO_HOMOLOGACAO_EMPRESA = 2019;
    const IMAGE_LOGIN_PATH = 'empresa/logologin.png';
    const IMAGE_SITE_PATH = 'empresa/logoSite.png';

    /*
     * Id da empresa unica que fornece produtos.
     *
     * Usado para enquanto tivermos apenas uma empresa no sistema,
     * posteriormente, se tivermos mais empresas vamos ter que filtrar pela
     * empresa do produto, ou do usuário que estiver realizando a operação.
     */
    protected $empresaBaseId = 1;

    /*
     * Id da empresa que fornece sistema
     *
     * Usado para cadastro de clientes, e configurações gerais do sistema.
     */
    protected $empresaSoftwareId = 2;

    /**
     * @return int
     */
    public function getEmpresaBase()
    {
        return $this->empresaBaseId;
    }

    /**
     * @return Empresa
     */
    public function getEmpresaBaseModel()
    {
        $tableLocator = new TableLocator();
        /** @var $empresa Empresa*/
        $empresa = $tableLocator->get('Empresas')->find()->where(['id' => $this->empresaBaseId])->first();
        return $empresa;
    }

    public function getEmpresaBaseEnderecoModel(){
        $tableLocator = new TableLocator();
        /** @var $empresaEndereco EnderecosEmpresa*/
        $empresaEndereco = $tableLocator->get('EnderecosEmpresas')->find()->where(['empresa_id' => $this->empresaBaseId])->first();
        return $empresaEndereco;
    }

    public function getEmpresaBaseEnderecoIFrameSrc(){
        $tableLocator = new TableLocator();
        /** @var $empresaEndereco GoogleMapsApiKey*/
        $empresaEndereco = $tableLocator->get('GoogleMapsApiKey')->find()->where(['empresa_id' => $this->empresaBaseId])->first();
        return $empresaEndereco->src_iframe_maps;
    }



    /**
     * @return int
     */
    public function getEmpresaSoftware()
    {
        return $this->empresaSoftwareId;
    }

    /**
     * @param $user
     * @param $empresaId
     *
     * Será usado para verificar se as ações de um usuário são permitidas ou não
     * pois se ele for de outra empresa, não poderá modificar de outras empresas.
     */
    public function validaPrivilegioEmpresa($empresaId){

    }

    public function getUserEmpresaId(){
        return $this->Auth->user('empresa_id');
    }

    /**
     * @return Empresa|null
     */
    public function getUserEmpresaModel(){
        $empresaId = $this->Auth->user('empresa_id');
        $tableLocator = new TableLocator();
        /** @var $empresa Empresa*/
        $empresa = $tableLocator->get('Empresas')->find()->where(['id' => $empresaId])->first();
        return $empresa;
    }

    public function getUserName(){
        return $this->Auth->user('nome_completo');
    }

    public function getUserTipo(){
        return $this->Auth->user('tipo');
    }

    public function getUserId(){
        return $this->Auth->user('id');
    }

    public function isEmpresaBase(){
        if($this->Auth->user('empresa_id')){
            if($this->Auth->user('empresa_id') == $this->getEmpresaBase()){
                return true;
            }
        }
        return false;
    }

    public function isEmpresaSoftware(){
        if($this->Auth->user('empresa_id')){
            if($this->Auth->user('empresa_id') == $this->getEmpresaSoftware()){
                return true;
            }
        }
        return false;
    }


}