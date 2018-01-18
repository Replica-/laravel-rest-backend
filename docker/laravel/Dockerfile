FROM ubuntu:16.04
MAINTAINER Daniel Santoro (www.torosolutions.com.au) <ddsantoro@gmail.com>

VOLUME ["/var/www/api"]

RUN apt-get update
RUN apt-get install -y apt-utils

RUN apt-get install -y language-pack-en-base
RUN export LC_ALL=en_US.UTF-8
RUN export LANG=en_US.UTF-8

RUN apt-get install -y software-properties-common python-software-properties

RUN LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
RUN add-apt-repository ppa:git-core/ppa
RUN add-apt-repository ppa:webupd8team/java

RUN apt-get install net-tools -y

RUN apt-get update

RUN apt-get install git -y

RUN apt-get install iputils-ping -y

RUN apt-get install -y \
      apache2 \
      php7.1 \
      php7.1-cli \
      libapache2-mod-php7.1 \
      php7.1-gd \
      php7.1-json \
      php-xdebug \
      php7.1-mbstring \
      php7.1-mysql \
      php7.1-xml \
      php-memcached \
      curl \
      php7.1-curl

RUN apt-get install -y build-essential checkinstall
RUN apt-get install -y ntp
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get install -y php7.1-curl php7.1-mbstring php7.1-bcmath php7.1-mcrypt php-imagick zip unzip php7.1-zip

RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get install -y nodejs

RUN npm install bower@1.3.3 -g
RUN npm install -g bower
RUN npm install component@0.19.9 -g
RUN npm install uglify-js@2.4.15 -g
RUN npm install -g less 
RUN npm install recess@1.1.9 -g

RUN apt-get install -y php-geoip
RUN apt-get install -y poppler-utils
RUN apt-get install -y python-poppler

# SSH Server #
RUN apt-get update && apt-get install -y openssh-server
RUN mkdir /var/run/sshd

# Root password #
RUN echo "root:root" | chpasswd

RUN useradd -ms /bin/bash ubuntu
# USER ubuntu
# WORKDIR /home/ubuntu
RUN echo "ubuntu:ubuntu" | chpasswd

# SSH login fix. Otherwise user is kicked off after login
RUN sed 's@session\s*required\s*pam_loginuid.so@session optional pam_loginuid.so@g' -i /etc/pam.d/sshd

ENV NOTVISIBLE "in users profile"
RUN echo "export VISIBLE=now" >> /etc/profile

COPY ./apache2/sites/* /etc/apache2/sites-available/
COPY ./apache2/apache2.conf /etc/apache2/apache2.conf
COPY ./php7.1/xdebug.ini /etc/php/7.1/mods-available/xdebug.ini

RUN a2enmod headers
RUN a2enmod rewrite
RUN a2dissite 000-default
RUN a2ensite 10-api
RUN a2ensite 10-cdn

EXPOSE 22
EXPOSE 80
EXPOSE 9000

#
# Quality of life
#
RUN apt-get install -y vim

#
# Supervisor (Currently using an infinite loop script)
#
#RUN apt-get update && apt-get install -y supervisor
#RUN mkdir -p /var/log/supervisor
#COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
#COPY ./apache2 my_first_process
#COPY ./sshd my_second_process
#CMD ["/usr/bin/supervisord"]

RUN apt-get install sudo -y

# Geo location db
# RUN wget -O- http://updates.maxmind.com/app/update\?license_key\=JDyEkCsPwJkN | gunzip > /usr/share/GeoIP/GeoIP.dat
RUN wget -O- http://download.maxmind.com/app/geoip_download\?edition_id\=133\&date\=20130917\&suffix\=tar.gz\&license_key\=JDyEkCsPwJkN | tar xzvf - --strip-components 1 -C /usr/share/GeoIP/ GeoIP-133_20130917/GeoIPCity.dat

#
# RABBIT MQ
#
# RUN echo 'deb http://www.rabbitmq.com/debian/ testing main' | sudo tee /etc/apt/sources.list.d/rabbitmq.list
# RUN wget -O- https://www.rabbitmq.com/rabbitmq-release-signing-key.asc | sudo apt-key add -
# RUN apt-get update
# RUN apt-get install rabbitmq-server

#
# MYSQL Client
#
RUN apt-get install -y mysql-client

# Correct date time
RUN echo "Australia/Melbourne" > /etc/timezone 
RUN /usr/sbin/service ntp restart

#
# Run multiple services
#

COPY ./scripts/sshd.sh my_second_process
COPY ./scripts/apache2.sh my_first_process
COPY ./scripts/docker_entry_point.sh docker_entry_point.sh
CMD ./docker_entry_point.sh
