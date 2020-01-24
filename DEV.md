
## Build local Docker image

Navigate to the root of the project. Execute following command to build atomium.zip file:

	./make-zip.sh /directory-outside-project
Directory outside the project should be used. It will generate atomium.zip archive. Move generated archive into /path-to-project/docker/atomium.zip.
Run following commands:

	docker-compose build
	docker-compose up -d

## Publish image to Docker Hub

If local image has already been built it should already exist in local Docker environment. Execute following command to acquire image name:

	docker images
It will generate output like:

	REPOSITORY                    TAG                 IMAGE ID            CREATED             SIZE
	docker_atomium_targetapache   latest              1015ce181727        46 minutes ago      146MB
	docker_atomium_targetphp      latest              a0c9c41bb52a        46 minutes ago      416MB
	softmetrixgroup/atomium       latest              96ff77356fb7        2 hours ago         518MB
	atomium_atomium               latest              96ff77356fb7        2 hours ago         518MB
	php                           7.2-fpm             35e8b4a99154        3 hours ago         398MB
	php                           7.2-apache          d0e98d20a124        3 weeks ago         410MB
	mysql                         5.7.23              1b30b36ae96a        15 months ago       372MB
	httpd                         2.4.33-alpine       73a557ff177a        18 months ago       91.3MB
In this case atomium_atomium image is an local Docker image containing Atomium application.
Use following commands to authenticate and deploy image to Docker Hub:

	docker tag atomium_atomium softmetrixgroup/atomium:latest
	docker login
	docker push softmetrixgroup/atomium:latest

