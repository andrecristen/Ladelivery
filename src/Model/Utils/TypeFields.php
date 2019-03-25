<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


interface TypeFields
{
    //Para campos de tipo numerico
    const TYPE_NUMBER = 0;

    //Para campos de tipo de texto
    const TYPE_TEXT = 1;

    //Para campos booleanos/ Verdadeiro e Falso/ Sim e Nao
    const TYPE_BOOLEAN = 2;

    //Para campos data
    const TYPE_DATE = 3;

    //Para campos data e hora
    const TYPE_DATE_TIME = 4;

    //Para campos User cliente/Admin
    const TYPE_USER = 5;

    //Para campos que tem-se de retorno um josn
    const TYPE_JSON = 6;

    //Para campos que temos uma lista de possibilidades.

    const TYPE_LIST = 7;

    const TYPE_WIDTH_PX = 1;

    const TYPE_WIDTH_PORCENT = 2;

}