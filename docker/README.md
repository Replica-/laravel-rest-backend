# Install

1. Docker network_type="host" mode is way too complicated. May fix this in the future. In the mean time please run "sudo ifconfig lo0 alias 192.168.3.1"
2. Run "docker-compose up -d"
3. SSH on port 2223, HTTP on 8000, Database on 33306
4. Navigate to localhost:8000/oauth to login

# Passwords


## Adapptr
u:test@gmail.com
p:abc123

## Mysql
u:root
p:root12

## SSH
u: ubuntu
p: ubuntu

u: root
p: root

# Fun Tips

There is some sort of "file disk leak" if you pull images and bring machines up constantly
To clear all cache, images, containers (effectively reset docker) run the following:

docker rm $(docker ps -a -q)
docker rmi $(docker images -q)
docker volume rm $(docker volume ls |awk '{print $2}')
rm -rf ~/Library/Containers/com.docker.docker/Data/*

## Temporary fix for time drift
/Volumes/src/docker:$ docker run -it --rm --privileged --pid=host docker_api nsenter -t 1 -m -u -n -i date -u $(date -u +%m%d%H%M%Y)

## Executing commands
# Example 1 - List queues in RABBITMQ
docker exec -it --privileged adapptrmq /usr/lib/rabbitmq/bin/rabbitmqctl list_queues



