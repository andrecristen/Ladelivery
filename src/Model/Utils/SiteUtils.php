<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


class SiteUtils
{
    public function getStarsProduto($produto_id){
        $intNota = 2;
        switch ($intNota){
            case 0:
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 1:
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 2:
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 3:
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 4:
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star"></span>';
                break;
            case 5:
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                echo '<span class="fa fa-star checked"></span>';
                break;
        }
    }

}