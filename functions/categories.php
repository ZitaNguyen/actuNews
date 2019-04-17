<?php

    function getCategories() {
        global $db;
        $query = $db->query('SELECT * FROM categorie');
        return $query->fetchAll();
    }

?>