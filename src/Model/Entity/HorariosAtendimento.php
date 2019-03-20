<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HorariosAtendimento Entity
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $dia_semana
 * @property int $turno
 * @property \Cake\I18n\FrozenTime $hora_inicio
 * @property \Cake\I18n\FrozenTime $hora_fim
 *
 * @property \App\Model\Entity\Empresa $empresa
 */
class HorariosAtendimento extends Entity
{
    const DOMINGO = 0;
    const SEGUNDA_FEIRA = 1;
    const TERCA_FEIRA = 2;
    const QUARTA_FEIRA = 3;
    const QUINTA_FEIRA = 4;
    const SEXTA_FEIRA = 5;
    const SABADO = 6;

    const MANHA = 1;
    const TARDE = 2;
    const NOITE = 3;

    public static function getDiaSemanaList(){
        return [
          self::DOMINGO => 'Domingo',
          self::SEGUNDA_FEIRA => 'Segunda-feira',
          self::TERCA_FEIRA => 'Terça-feira',
          self::QUARTA_FEIRA => 'Quarta-feira',
          self::QUINTA_FEIRA => 'Quinta-feira',
          self::SEXTA_FEIRA => 'Sexta-feira',
          self::SABADO => 'Sábado',
        ];
    }

    public static function getTurnoList(){
        return [
            self::MANHA => 'Manhã',
            self::TARDE => 'Tarde',
            self::NOITE => 'Noite',
        ];
    }

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
        'empresa_id' => true,
        'dia_semana' => true,
        'turno' => true,
        'hora_inicio' => true,
        'hora_fim' => true,
        'empresa' => true
    ];
}
