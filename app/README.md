CADENA DE CONEXION A BASE DE DATOS

mongo ds141108.mlab.com:41108/heroku_m4b97brj -u sidirtel -p sidirtel

Obtener cadena de conexion desde mongo

heroku config --app sidirtel | grep MONGODB_URI

//indexar una coleccion completa
db.personal.createIndex({"$**":"text"})

//RESTAURAR UNA BASE DE DATOS
mongorestore dump/sidirtel/ --db=sidirtel