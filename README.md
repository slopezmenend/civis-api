<p align="center">
	<a href="https://civis-api.herokuapp.com/public" target="_blank">
		<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2e/Spanish_Congress_of_Deputies_after_2004_election.png/160px-Spanish_Congress_of_Deputies_after_2004_election.png" width="400">
	</a>
</p>

## Sobre Civis-API

Civis-API nace como <abbr title="Trabajo Fin de Master">TFM</abbr> de un alumno de la <abbr title="Universitat Oberta de Catalunya">UOC</abbr>.

## ¿No tenemos ya un opendata del Congreso de los diputados?¿Por qué esta API?

La principal razón de crear esta API, aparte del propio <abbr title="Trabajo Fin de Master">TFM</abbr>, es precisamente generar una verdadera API de datos públicos (no oficial).

Si vamos a la <a href="https://www.congreso.es/datos-abiertos">Web de Datos Abiertos del Congreso de los Diputados</a> veremos que tenemos varias opciones y cada una con sus rarezas/problemas:
- Votaciones: No hay un endpoint para acceder directamente a votaciones sino que tienes que seleccionar en un calendario la fecha, para luego abrir en un árbol el tipo de proposición votada para luego acceder a un fichero de cada votación.
	+ ¿No tendría más sentido un endpoint/varios endpoints y que puedas recuperar fácilmente los votos de un diputado, de un día, etc?
- Diputados y diputadas: Tenemos un fichero por legislatura con datos parciales que cambia de nombre diariamente. Por ejemplo los datos de biografía en el perfil html del listado de diputados y en el json de diputados activos no son iguales, en el json no están incluidas las redes sociales del diputado, etc. Mucha de esta información además no es reutilizable (PDFs).
	+ ¿No tiene sentido que podamos acceder directamente a los datos de un diputado de forma centralizada y completa?¿Que tengamos todos sus datos como accesibles y reutilizables?
- Intervenciones: Hay un único fichero generado diariamente, con nombres distintos, con todas las intervenciones de la legislatura. Esto quiere decir que para ver las últimas intervenciones te tienes que descargar un fichero de 50/60Mb.
	+ ¿No tendría sentido que endpoint sea fijo?
	+ ¿No sería lo lógico que podamos buscar las intervenciones de una fecha o de un diputado concreto?

## ¿Y cómo puedo usarlo?

Civis-API tiene una página asociada en la siguiente <a href="https://civis-api.herokuapp.com/public">URL</a> donde podrás registrarte.

Una vez que creamos un usuario en nuestro perfil podremos ver un Token que tendremos que añadir como autentificación en nuestras peticiones a los endpoints y acceder a la consulta que queramos.

## ¿Cómo se obtiene la información de la API?

Una vez registrado en la <a href="https://civis-api.herokuapp.com/public">página de Civis-API</a> podremos revisar mediante una web tipo Dashboard los datos que maneja la API importando nuevos datos, actualizando los existentes, etc lo que transforma esta API en una herramienta colaborativa.

## Puntos abiertos

Como esta API ha nacido dentro de un <abbr title="Trabajo Fin de Master">TFM</abbr> ha nacido también con unos requerimientos de tiempos acotados.

Esto ha forzado que no toda la información:
- La generación de endpoints para la consulta de iniciativas no se ha abordado. Son necesarios porque se generan diariamente ficheros desagregados por tipo de forma diaria y no relaccionados con intervenciones, diputados, etc.
- Ampliación de información de diputados de cara a inclusión de la declaración de bienes (PDFs parciales en el perfil del propio diputado), Intereses económicos, diputados de legislaturas anteriores y cargos o pertenencia a órganos de gobierno.
- Creación de tipos de usuario para la administración/colaboración/consulta en lugar de un único tipo de usuario.

## Licencia

Esta obra está sujeta a una licencia de Reconocimiento-NoComercial <a href="https://creativecommons.org/licenses/by-nc/3.0/es/">3.0 España de Creative Commons</a>
