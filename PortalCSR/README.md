secciones existentes* -> 6 y 7.
 ordenamientos posibles** -> titulo, descripcion, cuerpo, seccion e id.

1)http://localhost/web2/PortalCSR/api/news/ -> GET a la lista entera de noticias, por default ordenadas ascendentemente.

2)http://localhost/web2/PortalCSR/api/news/:ID -> GET a una noticia puntual (18, 19, 21, 27, 28, 32).
Ej: http://localhost/web2/PortalCSR/api/news/28

3)El formato para agregar elementos a la db mediante POST es:
    {
    "titulo": "titulo",
    "descripcion": "descripcion",
    "cuerpo": "cuerpo",
    "seccion": 6 o 7*.
    }

4)http://localhost/web2/PortalCSR/api/news?orden=*orden*&tipo=(asc o desc). Con este endpoint más cualquiera de los ordenamientos posibles** y tipos obtenemos nuevamente la lista completa de noticias, ordenadas de distintas maneras, según se desee.
Aclaración: el TIPO de ordenamiento es obligatorio.
Ej: http://localhost/web2/PortalCSR/api/news?orden=id&tipo=desc.

