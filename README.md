# test_blog

Antes de nada, disculparme por si/que el readme se extiende demasiado.

Voy a resumir un poco lo hecho, y lo que dejo pendiente para no alargar el proceso.

* El punto de partida ha sido una máquina virtual con Ubuntu, en la que tengo instalado un entorno de Java extendido a Scala, y un entorno para python con conda. El entorno de desarrollo de PHP no está instalado ya que lo tenía en un PC antiguo no disponible ahora mismo.

* Instalo la última versión de Symfony (si no me equivoco, la 6), el Composer y el Visual Studio Code, para comenzar.

* Genero un nuevo proyecto de Symfony, al que añado algunos Controllers y entidades, junto con los repositorios. Por lo que he visto, ha habido algunos cambios en el sistema de anotaciones y algún otro detalle respecto a la versión que usé en su día. Como sólo voy a añadir un par de rutas que ya aparecen en las anotaciones, de momento dejo el routes.yaml por defecto.

* Configuro algunas rutas y compruebo los datos que devuelve la web sustituta de la base de datos. Aunque del autor hay un montón de ellos, de momento por simplicidad cojo los principales. El resto se obtendría de la misma manera del JSON.

* Las entidades y los repositorios que se generan son los habituales de base de datos, Doctrine. Como no tengo una base de datos, hago una adaptación para que más o menos dé el pego, pero hay cosas que no van a ser iguales. En Doctrine las entidades referenciadas se pueden obtener directamente a partir de sus ids, pero no estoy seguro de si se podría hacer lo mismo en este caso, y en cualquier caso llevaría un tiempo de investigación.

* Modifico un poco los twigs por defecto para que me presenten la información básica que quiero.

* Hago otro controlador, un API, para que responda a las peticiones GET y POST. El GET necesita que haga una obtención del post y luego los datos del autor. Comprobar que el id que nos pasan es válido, y en caso contrario devolvemos un código que indique el fallo. El POST me complica un poco la idea. En principio, los GET podrían ser públicos, pero los POST no tiene tanto sentido, lo normal es que fueran un usuario autenticado, pero eso requiere añadir un sistema de autenticación, así que asumo que el id de usuario me lo envía con el JSON y que es válido. También habría que comprobar las longitudes de los datos, y obtener el id del nuevo post. Si es una inserción en base de datos, además hay que tener especial cuidado con las posibles inyecciones de código malicioso en SQL (hay funciones que ya se encargan, al igual que otras para HTML). Como no tengo los recursos de base de datos, ya que no trabajo con ella, lo dejo más o menos anotado.

* De paso, echo un vistazo al OpenAPI y a los swaggers. Los había visto por mi cuenta, pero por encima, ya que en la otra empresa no los usaban (al menos de aquellas, en los dos productos que toqué). Por lo que recuerdo, además de proporcionar un método para automatizar el uso de los servicios, creo que también generaban documentación más o menos automáticamente con los servicios que se creaban. Pero de momento queda aparcado.

* Hago un mini test para la API, que habría que desarrollar. Como recuerdo bastante vagamente todo el tema de los mocks y por no alargar demasiado la prueba, de momento lo dejo así.

* A continuación intento dar un poco de formato a las salidas, así que intento instalar el Webpack Encore con Symfony. Sin embargo me empieza a dar errores en varios puntos. Finalmente veo que con la instalación que tengo de Hadoop para Spark y Scala, se instala una herramienta yarn, que no es la de gestión de paquetes que usaría con Symfony. El hecho es que no termina de instalarse bien, así que para presentar algún formato lo añado a mano.

Para no alargar más la entrega, creo que lo dejo así.

Cosas pendientes:
* Rehacer la instalación de Symfony y las herramientas a usar en una máquina "limpia".
* Meter los estilos con Webpack Encore o, al menos, en un css que pueda llamar desde twig con "assets".
* Hacer más código de pruebas del sistema, y revisar toda la información que da el profiler de Symfony, del cual he "pasado" bastante.
* Repasar los ficheros de configuración del sistema, desde los entornos a los yaml de rutas y servicios.
* Hacer todo el sistema de gestión de usuarios y permisos para cada acción, y las asegurar bien las coherencias de los datos (si es en base de datos, con todas las herramientas del ORM, y si no pues a mano o con alguna herramienta que pudiera existir).
* Y ya puestos, darle un repaso al OpenAPI, y a las otras herramientas.

Como resumen personal, he tardado más de lo que esperaba en desenterrar parte de lo que sabía de PHP, Symfony y demás, pero bueno. En cualquier caso, se decida lo que se decida, me he divertido -aún con las rompeduras de cabeza- y he adelantado una tarea que tenía prevista para estos próximos meses, así que el tiempo ha estado bien empleado.

Muchas gracias por vuestro tiempo y perdonad por el rollo.

Un saludo