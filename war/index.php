<?php
abstract class Component
{
    protected $parent;

    public function setParent(Component $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Component
    {
        return $this->parent;
    }

    public function add(Component $component): void { }

    public function remove(Component $component): void { }


    public function isComposite(): bool
    {
        return false;
    }


    abstract public function operation();
}
interface Unit
{
    public static function createArmy();
}

class calculate
{
    public static function calc_army_damage_health (array $army, array $standartArmy, bool $rain, bool $ice) : array
    {
        $damage = 0;
        $health = 0;
        $pehota = $standartArmy['pehota'];
        $luchniki = $standartArmy['luchniki'];
        $konnica = $standartArmy['konnica'];

        ($rain == true) ? $luchniki = $luchniki['damage'] / 2 : $luchniki;

        foreach ($army['units'] as $unit => $count)
        {
            $damage += ${$unit}['damage'] * $count;

            if($ice == true) $health += ${$unit}['health'] * $count;
            elseif($ice == false) $health += ${$unit}['health'] * $count + ${$unit}['armour'] * $count;

        }
        return ['damage' => $damage, 'health' => $health];
    }

}



class Aleksandr extends Component implements Unit
{

    public static function createArmy()
    {
        return [
            'name' => 'Александр Ярославич',
            'units' => [
                'pehota' => 200,
                'luchniki' => 30,
                'konnica' => 15,
            ]
        ];
    }
    public function operation()
    {
        $army = [Aleksandr::createArmy(), Ulf::createArmy()];

        //Для удобства
        $armyLiving = [
            'pehota' => $army[0]['units']['pehota'] - $army[1]['units']['pehota'],
            'luchniki' => $army[0]['units']['luchniki'] - $army[1]['units']['luchniki'],
            'konnica' => $army[0]['units']['konnica'] - $army[1]['units']['konnica'],
        ];

        //Для удобства
        $armyDead = [
            'pehota' => abs($army[0]['units']['pehota']) - abs($armyLiving['pehota']),
            'luchniki' => abs($army[0]['units']['luchniki']) - abs($armyLiving['luchniki']),
            'konnica' => abs($army[0]['units']['konnica']) - abs($armyLiving['konnica']),
        ];

        //Удаляем отрицательные числа и заменяем нулями
        foreach ($armyLiving as $key => $val)
        {
            if($armyLiving[$key] <= 0) $armyLiving[$key] = 0;
            if($armyDead[$key] <= 0) $armyDead[$key] = 0;
        }

        //Выжившие
        foreach ($armyLiving as $key => $val)
        {
            $armyLivingSum += abs($val);
        }

        //Погибшие
        foreach ($armyDead as $key => $val)
        {
           $armyDeadSum += abs($val);
        }

        $result = [
            'armyLiving' => $armyLiving,
            'armyDead' => $armyDead,
            'armyLivingSum' => $armyLivingSum,
            'armyDeadSum' => $armyDeadSum
            ];


        return $result;
    }
}


class Ulf extends Component implements Unit
{
    public static function createArmy()
    {
        return [
            'name' => 'Ульф Фасе',
            'units' => [
                'pehota' => 90,
                'luchniki' => 65,
                'konnica' => 25,
            ]
        ];
    }

    public function operation()
    {

        $army = [Aleksandr::createArmy(), Ulf::createArmy()];
        //Для удобства
        $armyLiving = [
            'pehota' => $army[1]['units']['pehota'] - $army[0]['units']['pehota'],
            'luchniki' => $army[1]['units']['luchniki'] - $army[0]['units']['luchniki'],
            'konnica' => $army[1]['units']['konnica'] - $army[0]['units']['konnica'],
        ];

        //Для удобства
        $armyDead = [
            'pehota' => abs($army[1]['units']['pehota']) - abs($armyLiving['pehota']),
            'luchniki' => abs($army[1]['units']['luchniki']) - abs($armyLiving['luchniki']),
            'konnica' => abs($army[1]['units']['konnica']) - abs($armyLiving['konnica']),
        ];

        //Удаляем отрицательные числа и заменяем нулями
        foreach ($armyLiving as $key => $val)
        {
            if($armyLiving[$key] <= 0) $armyLiving[$key] = 0;
            if($armyDead[$key] <= 0) $armyDead[$key] = 0;
        }

        //Выжившие
        foreach ($armyLiving as $key => $val)
        {
           $armyLivingSum += abs($val);
        }

        //Погибшие
        foreach ($armyDead as $key => $val)
        {
           $armyDeadSum += abs($val);
        }

        $result = [
            'armyLiving' => $armyLiving,
            'armyDead' => $armyDead,
            'armyLivingSum' => $armyLivingSum,
            'armyDeadSum' => $armyDeadSum
        ];

        return $result;
    }
}



function clientCode(Component $component, $standartArmy, $rain, $ice)
{
    $Aleksandr = new Aleksandr();
    $Ulf = new Ulf();
    $army = [Aleksandr::createArmy(), Ulf::createArmy()];
    $healthAndDamage = [
        calculate::calc_army_damage_health(Aleksandr::createArmy(), $standartArmy, $rain, $ice),
        calculate::calc_army_damage_health(Ulf::createArmy(), $standartArmy, $rain, $ice)
    ];

        $armyDead1 = $Aleksandr->operation()['armyDead'];
        $armyDead2 = $Ulf->operation()['armyDead'];
        $armyDeadSum1 = $Aleksandr->operation()['armyDeadSum'];
        $armyDeadSum2 = $Ulf->operation()['armyDeadSum'];
        $armyLiving1 = $Aleksandr->operation()['armyLiving'];
        $armyLiving2 = $Ulf->operation()['armyLiving'];
        $armyLivingSum1 = $Aleksandr->operation()['armyLivingSum'];
        $armyLivingSum2 = $Ulf->operation()['armyLivingSum'];


    echo "<table border='1'>
            <tr>
            <th></th>
            <th>".$army[0]['name']."</th>
            <th>".$army[1]['name']."</th>
        </tr>
        <tr>
            <th>Army units:</th>
            <td>Пехота: ".$army[0]['units']['pehota'].", Лучники: ".$army[0]['units']['luchniki'].", Конница: ".$army[0]['units']['konnica']."</td>
            <td>Пехота: ".$army[1]['units']['pehota'].", Лучники: ".$army[1]['units']['luchniki'].", Конница: ".$army[1]['units']['konnica']."</td>
        </tr>
        <tr>";

        $duration = 0;
        while ($healthAndDamage[0]['health'] >= 0 && $healthAndDamage[1]['health'] >= 0)
        {
            $healthAndDamage[0]['health'] -= $healthAndDamage[0]['damage'];
            $healthAndDamage[1]['health'] -= $healthAndDamage[0]['damage'];

            $duration++;
        }

        echo " 
            <th>Погибшие</th>
            <td>Пехота: ".$armyDead1['pehota'].", Лучники: ".$armyDead1['luchniki'].", Конница: ".$armyDead1['konnica'].", Всего: ".$armyDeadSum1."</td>
            <td>Пехота: ".$armyDead2['pehota'].", Лучники: ".$armyDead2['luchniki'].", Конница: ".$armyDead2['konnica'].", Всего: ".$armyDeadSum2."</td>
        </tr>
        <tr>
            <th>Выжившие</th>
            <td>Пехота: ".$armyLiving1['pehota'].", Лучники: ".$armyLiving1['luchniki'].", Конница: ".$armyLiving1['konnica'].", Всего: ".$armyLivingSum1."</td>
            <td>Пехота: ".$armyLiving2['pehota'].", Лучники: ".$armyLiving2['luchniki'].", Конница: ".$armyLiving2['konnica'].", Всего: ".$armyLivingSum2."</td>
        </tr>
        
            <tr>
            <th>Health after $duration hits:</th>
            <td>" . $healthAndDamage[0]['health'] . "</td>
            <td>" . $healthAndDamage[1]['health'] . "</td>
        </tr>
        <tr>
            <th>Result</th>
            <td>" . ($healthAndDamage[0]['health'] > $healthAndDamage[1]['health'] ? 'WIN' : 'LOST') . "</td>
            <td>" . ($healthAndDamage[1]['health'] > $healthAndDamage[0]['health'] ? 'WIN' : 'LOST') . "</td>
        </tr>
        </table>";



}
$standartArmy =
    [
        'pehota' => [
            'health' => 100,
            'armour' => 10,
            'damage' => 10,
        ],
        'luchniki' => [
            'health' => 100,
            'armour' => 5,
            'damage' => 20,
        ],
        'konnica' => [
            'health' => 300,
            'armour' => 30,
            'damage' => 30,
        ]
    ];

$composite = new Aleksandr();
clientCode($composite, $standartArmy, false, true);


