<?php
Class Tournament
{
    private $name;
    private $date;
    private $players = Array();

    function __construct($name, $date=null)
    {
        $this->name = $name;
        $date = str_replace('.', '-', $date);

        if ($date == null)
        {
            $this->date = strtotime('today');
        }
        else
        {
            $this->date = strtotime($date);
        }
    }

    function addPlayer($player)
    {
        $this->players[] = $player;
        return $this;
    }

    function createPairs()
    {
        $players = $this->players;

        if (count($players) % 2 == 1)
        {
            $players[] = new Player('Bye');
        }

        $away = array_splice($players,(count($players)/2));
        $home = $players;

        for ($i=0; $i < count($home)+count($away) - 1; $i++)
        {
            for ($j=0; $j<count($home); $j++)
            {
                $round[$i][$j]['Home']=$home[$j];
                $round[$i][$j]['Away']=$away[$j];
            }
            if(count($home)+count($away)-1 > 2)
            {
                $temp = array_splice($home, 1, 1);
                array_unshift($away, array_shift($temp));
                $home[] = array_pop($away);
            }
        }

        $this->printRound($round);
        return $round;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDate(): string
    {
        return date('d.m.Y', $this->date);
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    protected function printRound(array $rounds): void
    {
        foreach ($rounds as $round => $games)
        {
            echo "$this->name, " . date('d.m.Y', strtotime('+' . $round + 1 . ' days', $this->date)) . '<br>';
            echo 'Round: ' . ($round + 1) . '<br>';

            foreach ($games as $play)
            {
                if ('Bye' != $play['Home']->getName() and 'Bye' != $play['Away']->getName())
                {
                    echo $play['Home']->getName() . ' - ' . $play['Away']->getName() . '<br>';
                }
            }

            echo '<br>';
        }
    }
}