<h3>Proyecto AaxisTest, realizado por Sebastián Vilo.</h3>

<h4>Versiones</h4>
<li>Symfony: 7.0.1</li>
<li>PostgreSQL: 14.10</li>
<li>PHP: 8.2.13</li>

<h4>Traspaso de proyecto a equipo local</h4>
1. Clonar proyecto y guardarlo en la carpeta principal del Usuario del equipo (Ej: C:\Users\Seba)<br>
2. Abrir programa terminal (ideal Git Bash).<br>
3. Ejecutar comando <b>"cd AaxisTest"</b>.<br>
4. Ejecutar comando <b>"composer install"</b> para regenerar paquetes/dependencias de Composer utilizadas en este proyecto.<br>
5. Iniciar proyecto con <b>"php -S localhost:8000 -t public"</b>.<br>
6. Ir a navegador e ingresar la url <b>localhost:8000</b>

<h4>Apertura de Base de Datos</h4>
1. Abrir interpretador de Bases de Datos DBeaver.<br>
2. Crear una nueva conexión con PostgreSQL.<br>
3. En las opciones de conexión, ingresar los siguientes parámetros:<br>
<li>Connect By: Host</li>
<li>Host: localhost</li>
<li>Port: 5432</li>
<li>Database: aaxis_test</li>
<li>Authentication: Database Native</li>
<li>Nombre de usuario: postgres</li>
<li>Contraseña: A4x1s.2023</li>

<h4>Consumo de API</h4>
1. Para hacer uso de la API, usar programa Postman.<br>
2. Crear nueva conexión HTTP.<br>

<h5>Crear nuevo producto</h5>
<li>Método "POST".</li>
<li>URL: http://localhost:8000/producto/agregar</li>
<li>En Body, seleccionar opción raw y en el selector que se ubica al final de la misma fila, seleccionar la opción "JSON".</li>
<li>Ingresar el siguiente código: <b>[{"sku": "A001", "nombre_producto": "Plancha Zinc Acanalada 3.6mt", "descripcion" : "Hecha con acero inoxidable"},{"sku": "A002", "nombre_producto": "Plancha Zinc Acanalada 2.0mt", "descripcion" : "Hecha con acero inoxidable"}]</b></li>
<li>Pinchar en Send</li>
<li>El resultado es el listado de los SKU's agregados.</li>

<h5>Listar productos</h5>
<li>Método "GET".</li>
<li>URL: http://localhost:8000/producto/lista</li>
<li>Pinchar en Send</li>
<li>El resultado es el listado de los SKU's existentes en la base de datos.</li>

<h5>Editar productos</h5>
<li>Método "PUT".</li>
<li>URL: http://localhost:8000/producto/editar</li>
<li>Ingresar el siguiente código: <b>[{"sku": "A001", "nombre_producto": "Plancha Zinc Acanalada 3.6mt Verde", "descripcion" : "Hecha con acero inoxidable de larga duración"},{"sku": "A002", "nombre_producto": "Plancha Zinc Acanalada 2.0mt Azul", "descripcion" : "Hecha con acero inoxidable"}]</b><br>
<li>Pinchar en Send</li>
<li>El resultado es el listado de los SKU's actualizados.</li>

<h5>Eliminar productos</h5>
<li>Método "DELETE".</li>
<li>URL: http://localhost:8000/producto/eliminar/codigo_del_sku_a_eliminar</li>
<li>Pinchar en Send</li>
<li>El resultado es el listado de los SKU's actualizados.</li>
