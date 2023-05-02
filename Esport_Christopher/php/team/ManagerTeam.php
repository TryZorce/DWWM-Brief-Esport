<?php

$currentDir = __DIR__;
$root = dirname($currentDir, 2);
require_once($root . '/php/DBManager.php');
require($root . '/php/team/Team.php');



class ManagerTeam extends DBManager
{
    public function findById($teamID){

        $request = 'SELECT * FROM team WHERE id =' . $teamID;
        $query = $this->getConnexion()->query($request);
        $foundTeam= $query->fetch();

        if($foundTeam){
            $team = new Team();
            $team->setName($foundTeam['name']);
            $team->setDescription($foundTeam['description']);
            return $team;
        }else{
            return null;
        }
    }
        public function getAllTeam()
    {
        $res = $this->getConnexion()->query('SELECT * FROM team');

        $teams = [];

        foreach ($res as $team) {
            $newTeam = new Team;
            $newTeam->setName($team['name']);
            $newTeam->setDescription($team['description']);
            $newTeam->setId($team['id']);
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
    public function delete($teamID){
        $teamToDelete = $this->findById($teamID);

            if ($teamToDelete){
                $request = 'DELETE FROM team WHERE id = ' . $teamID;
                $query = $this->getConnexion()->prepare($request);
                $query->execute();

                header('Location:team.php');
                exit();
            }
    }

    public function update($teamID) {
        $teamToUpdate = $this->findById($teamID);

        if($teamToUpdate){
            $request = 'UPDATE FROM team WHERE id =' . $teamID;
            $query = $this->getConnexion()->prepare($request);
            $query->execute();

            header('Location:index.php');
            exit();

        }
    }

}
?>