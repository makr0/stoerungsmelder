# console
#
# VERSION               0.0.1

FROM ubuntu:14.04

# Maintainer
MAINTAINER mdt <mdt@wegewerk.com>

# Install Apache2
RUN DEBIAN_FRONTEND=noninteractive apt-get update -y \
 && DEBIAN_FRONTEND=noninteractive apt-get install -y openssh-server \
                                                      php5-gd php5-curl \
                                                      php5-mysql php5-intl \
                                                      php5-cli build-essential \
                                                      git \
                                                      curl vim mc graphicsmagick

# install nodejs
RUN curl -sL https://deb.nodesource.com/setup_4.x | bash - && DEBIAN_FRONTEND=noninteractive apt-get install -y nodejs

# install composer and bower
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer
RUN npm install -g bower grunt-cli yo gulp grunt-init aglio

# some dotfiles
ADD .bash_aliases /root/
ADD .bashrc /root/
ADD .gitconfig /root/

# make sshd happy
RUN mkdir /var/run/sshd
RUN mkdir /root/.ssh && chmod 600 /root/.ssh
ADD sshd_config /etc/ssh/sshd_config
ADD authorized_keys /root/.ssh/

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]
