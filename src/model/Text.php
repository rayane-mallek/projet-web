<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "BaseModel.php"));

class Text extends BaseModel
{
    public function getTextBySectionName($sectionName)
    {
        $sql = "SELECT value FROM text WHERE section_name = :section_name";
        $req = $this->pdo->prepare($sql);
        $req->execute(['section_name' => $sectionName]);
        $result = $req->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['value'])) {
            return $result['value'];
        }

        return '';
    }

    public function saveOrUpdateText($sectionName, $newText)
    {
        $sqlCheck = "SELECT COUNT(*) FROM text WHERE section_name = :section_name";
        $reqCheck = $this->pdo->prepare($sqlCheck);
        $reqCheck->execute(['section_name' => $sectionName]);
        $exists = $reqCheck->fetchColumn();

        if ($exists) {
            $sqlUpdate = "UPDATE text SET value = :value WHERE section_name = :section_name";
            $reqUpdate = $this->pdo->prepare($sqlUpdate);
            $reqUpdate->execute(['value' => $newText, 'section_name' => $sectionName]);
        } else {
            $sqlInsert = "INSERT INTO text (section_name, value) VALUES (:section_name, :value)";
            $reqInsert = $this->pdo->prepare($sqlInsert);
            $reqInsert->execute(['section_name' => $sectionName, 'value' => $newText]);
        }
    }
}