<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


interface TypeFields
{
    //Para campos de tipo numerico
    const TYPE_NUMBER = 'number';

    //Para campos de tipo de texto
    const TYPE_TEXT = 'text';

    //Para campos booleanos/ Verdadeiro e Falso/ Sim e Nao
    const TYPE_BOOLEAN = 'bool';

    //Para campos data
    const TYPE_DATE = 'date';

    //Para campos data e hora
    const TYPE_DATE_TIME = 'datetime';

    //Para campos User cliente/Admin
    const TYPE_USER = 'user';

    //Para campos que tem-se de retorno um josn
    const TYPE_JSON = 'json';

    //Para campos que temos uma lista de possibilidades.

    const TYPE_LIST = 'select';

    const TYPE_WIDTH_PX = 1;

    const TYPE_WIDTH_PORCENT = 2;

}