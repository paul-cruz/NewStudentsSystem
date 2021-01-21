# New Studnets System
The following project its a web based one, using technologies as HTML5, CSS3, jQuery, Bootstrap, MySQL and PHP.

It is used to emulate the sign up new students in [ESCOM IPN](https://www.escom.ipn.mx/), which asks for the basic students info and assign a evaluation time and group, this evaluation is an ESCOM internal proccess so we don't own the logic neither resources like photos, links, etc.

### Requirements 📋
To make possible the system implementation you need to install following:
* [Docker](https://docs.docker.com/engine/install/) - Docker Engine is an open source containerization technology for building and containerizing your applications.
* [Docker-Compose](https://docs.docker.com/compose/install/) - Compose is a tool for defining and running multi-container Docker applications.

## Getting started 🚀

_Below is shown the required steps to launch the system._

_In your local system or in a server the first thing you need to do is **clone** the repository as below:_
```
$ git clone https://github.com/paul-cruz/NewStudentsSystem.git
```

_Once cloned the repo, you have to set your work directory as the repo one_
```
$ cd NewStudentsSystem/
```

_Finally you should be at **docker-compose.yaml** level, so just exec the docker compose:_
```
$ docker-compose up -d
```

## Next Steps 🛠️

_Once finished the **Getting Started** steps you need to set up the data base and accessed the system:_

_To set up you have to access to your server ip address in the 5000 port:_

_For local environment_
```
http://localhost:5000/
```

_For external server environment_
```
http://your-ip-addres:5000/
```
_Once there you have to create a DB named **students_system** and run the [students_system.sql](https://github.com/paul-cruz/NewStudentsSystem/blob/main/db/students_system.sql)_

_To accede the system you have to type your server ip address in the 8080 port:_

_For local environment_
```
http://localhost:8080/
```

_For external server environment_
```
http://your-ip-addres:8080/
```

## Licencia 📄

All code is copyright (c) 2021 Juan Paul Cruz Cruz, Eduardo Martinez Mendez and Miguel Angel Islas Hernandez under the [MIT license](LICENSE).
