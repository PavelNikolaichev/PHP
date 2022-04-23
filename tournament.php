<?php
Class Tournament
{
    private string $name;
    private string $date;
    private array $players;

    public function __construct(string $name, string $date = '')
    {
        $this->name = $name;
        $date = str_replace('.', '-', $date);

        $this->date = ($date === '') ? strtotime('today') : strtotime($date);
    }

    final public function addPlayer(Player $player): Tournament
    {
        $this->players[] = $player;
        return $this;
    }

    final public function createPairs(): array
    {
        $players = $this->players;
        $rounds = Array();

        if (count($players) % 2 === 1)
        {
            $players[] = new Player('Bye');
        }

        $away = array_splice($players, count($players) / 2);
        $home = $players;

        for ($i = 0; $i < count($home) + count($away) - 1; $i++)
        {
            for ($j = 0, $jMax = count($home); $j < $jMax; $j++)
            {
                $rounds[$i][$j]['Home'] = $home[$j];
                $rounds[$i][$j]['Away'] = $away[$j];
            }

            if (count($home) + count($away) - 1 > 2)
            {
                $temp = array_splice($home, 1, 1);
                array_unshift($away, array_shift($temp));
                $home[] = array_pop($away);
            }
        }

        $this->printRounds($rounds);
        return $rounds;
    }

    final public function printRounds(array $rounds): void
    {
        foreach ($rounds as $round => $games)
        {
            ++$round;

            echo "$this->name, " . date('d.m.Y', strtotime("+$round days", $this->date)) . '<br>';
            echo "Round: $round<br>";

            foreach ($games as $play)
            {
                if ('Bye' !== $play['Home']->getName() && 'Bye' !== $play['Away']->getName())
                {
                    echo $play['Home']->getName() . ' - ' . $play['Away']->getName() . '<br>';
                }
            }

            echo '<br>';
        }
    }

    final public function getName(): string
    {
        return $this->name;
    }

    final public function getDate(): string
    {
        return date('d.m.Y', $this->date);
    }

    final public function getPlayers(): array
    {
        return $this->players;
    }
}