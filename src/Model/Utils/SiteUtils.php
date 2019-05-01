<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


use Cake\Datasource\ConnectionManager;

class SiteUtils
{
    public function showStarsByNota($nota){
        switch (intval($nota)){
            case 0:
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 1:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 2:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 3:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 4:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 5:
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                echo '<span class="fa fa-star checked-star"></span>';
                break;
            default:
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;

        }
    }

    public function getValueStarsProduto($produtoId){
        $sql = 'SELECT AVG(nota) as stars FROM produtos_avaliacoes WHERE produto_id = '.$produtoId;
        $connection = ConnectionManager::get('default');
        $results = $connection->execute($sql)->fetchAll('assoc');
        if(isset($results[0]['stars'])){
            return number_format($results[0]['stars'], 2, ',','');
        }
        return 0;
    }

    public function getStarsProduto($produtoId){
        $intNota = intval($this->getValueStarsProduto($produtoId));
        $this->showStarsByNota($intNota);
    }

}