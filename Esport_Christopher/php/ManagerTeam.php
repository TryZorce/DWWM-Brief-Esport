<?php

$currentDir = __DIR__;
$root = dirname($currentDir, 2);
require($root . '/php/DBManager.php');
require($root . '/php/team/Team.php');



class ManagerTeam extends DBManager
{
    public function getAllTeam()
    {
        $res = $this->getConnexion()->query('SELECT * FROM team');

        $teams = [];

        foreach ($res as $team) {
            $newTeam = new Team;
            $newTeam->setName($team['name']);
            $newTeam->setDescription($team['description']);

            $teams[] = $newTeam;
        }

        return $teams;
    }

    public function create($team)
    {

        $request = 'INSERT INTO team(name, description) VALUE (?, ?)';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([
            $team->getName(), $team->getDescription()
        ]);
        header('Refresh:0');
        return true;
    }
    public function remove($id)
    {
        $request = 'DELETE FROM team WHERE id = ?';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$id]);
        header('Refresh:0');
        return true;
    }


}
?>