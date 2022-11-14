<?php
require_once './app/model/modelnews.php';
require_once './app/view/viewNews.php';

class NewApiController {
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new NewsModel();
        $this->view = new ApiView();

        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getNews($params = null) {
        if (isset($_GET["orden"]) && isset($_GET["tipo"])) {
            $orden = $_GET["orden"];
            $tipo = $_GET["tipo"];
            if ($orden == "titulo" || $orden == "descripcion" || $orden == "cuerpo" || $orden == "seccion" || $orden == "id") {
                if ($tipo == "desc" || $tipo = "asc") {
                    $noticias = $this->model->getAll($orden, $tipo);
                    $this->view->response($noticias);
                }else{
                    $this->view->response("No existe ese tipo de orden.", 400);
                }
            }else{
                $this->view->response("No se puede ordenar de esta manera.", 400);
            }
        }else{
            $news = $this->model->getAll("id");
            $this->view->response($news);
        }
    }

    public function getNew($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $noticia = $this->model->get($id);

        // si no existe devuelvo 404
        if ($noticia)
            $this->view->response($noticia);
        else 
            $this->view->response("La noticia con el id=$id no existe", 404);
    }

    public function insertNew($params = null) {
        $noticia = $this->getData();
        
        if (empty($noticia->titulo) || empty($noticia->descripcion) || empty($noticia->cuerpo) || empty($noticia->seccion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            if ($noticia->seccion == 6 || $noticia->seccion == 7) {            
            $id = $this->model->insert($noticia->titulo, $noticia->descripcion, $noticia->cuerpo, $noticia->seccion);
            $noticia = $this->model->get($id);
            $this->view->response($noticia, 201);
            } else{
                $this->view->response("Complete con la seccion correspondiente", 400);
            }
        }
    }





}