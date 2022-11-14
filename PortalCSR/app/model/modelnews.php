<?php

class NewsModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db-news;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de noticias completa.
     */
    public function getAll($orden = null, $tipo = null) {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase

        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT * FROM news_db ORDER BY $orden $tipo");
        $query->execute();

        // 3. obtengo los resultados
        $noticias = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $noticias;
    }

    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM news_db WHERE id = ?");
        $query->execute([$id]);
        $noticia = $query->fetch(PDO::FETCH_OBJ);
        
        return $noticia;
    }

    /**
     * Inserta una tarea en la base de datos.
     */
    public function insert($title, $description, $body, $section) {
        $query = $this->db->prepare("INSERT INTO news_db (titulo, descripcion, cuerpo, seccion) VALUES (?, ?, ?, ?)");
        $query->execute([$title, $description, $body, $section]);

        return $this->db->lastInsertId();
    }

}