<?php

namespace App\Repositories;

use App\DataObjects\JournalistDto;
use App\Models\Journalist;

class JournalistRepository extends Repository{

    /**
     * @param bool|int $groupId
     * @return array
     */
    public function getAllJournalist($groupId = 0) {
        $sqlSnippet = "";
        if($groupId != 0) {
            $sqlSnippet = " WHERE g.id = :group_id";
        }
        $statement = $this->db->prepare("
            SELECT j.id, j.name, j.alias, g.name as group_name FROM journalist j 
            LEFT JOIN groups g ON j.group_id = g.id $sqlSnippet
        ");
        $statement->execute($groupId != 0 ? ["group_id" => $groupId] : []);

        $journalists = $statement->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\\Models\\Journalist");

        $journalists = array_map(function($item) {
            return new JournalistDto($item);
        }, $journalists);

        $statement->closeCursor();
        return $journalists;
    }

    public function getAllGroup() {
        $statement = $this->db->prepare("
            SELECT *  FROM groups
        ");
        $statement->execute();

        $groups = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $statement->closeCursor();
        return $groups;
    }

    public function getJournalistById($id) {
        $statement = $this->db->prepare("
            SELECT j.id, j.name, j.alias, g.name as group_name FROM journalist j 
            LEFT JOIN groups g ON j.group_id = g.id
            WHERE j.id = :id
        ");
        $statement->execute([
            'id' => $id
        ]);
        $journalists = $statement->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, "App\\Models\\Journalist");
        $journalists =  isset($journalists[0]) ? new JournalistDto($journalists[0]) : [];

        $statement->closeCursor();
        return $journalists;
    }

    public function addJournalist(array $data) {
        $statement = $this->db->prepare("
          INSERT INTO journalist(
              name,
              alias,
              group_id
            ) VALUES (
              :name,
              :alias,
              :group_id
            )
          ");
        $statement->execute([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'group_id' => $data['group_id']
        ]);

        $statement->closeCursor();

        return true;
    }

    public function editJournalist(array $data) {
        $statement = $this->db->prepare("
          UPDATE journalist SET
              name = :name,
              alias = :alias,
              group_id = :group_id
          WHERE id=:id
        ");
        $statement->execute([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'group_id' => $data['group_id'],
            'id' => $data['id']
        ]);
        $statement->closeCursor();

        return true;
    }

}