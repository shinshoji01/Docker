#FROM nvidia/cuda:10.1-cudnn7-runtime-ubuntu18.04
FROM nvidia/cuda:11.3.1-runtime-ubuntu20.04
#FROM nvidia/cuda:10.2-runtime-ubuntu18.04

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
	    libsndfile-dev \
	    sudo \
	    wget \
	    vim

WORKDIR /opt

# Install Python 3.7 v1
# https://www.python.org/ftp/python/
#RUN sudo apt install -y build-essential zlib1g-dev libncurses5-dev libgdbm-dev libnss3-dev libssl-dev libreadline-dev libffi-dev
#WORKDIR /build_context/python/Python-3.7.0
#RUN ./configure && \
	#make install && \
	#apt-get install -y python3-pip

# Install Python 3.7 v2
RUN sudo apt-get install -y git python3-pip make build-essential libssl-dev zlib1g-dev libbz2-dev libreadline-dev libsqlite3-dev curl && \
	    sudo pip install virtualenvwrapper && \
	    git clone https://github.com/yyuu/pyenv.git ~/.pyenv && \
	    git clone https://github.com/yyuu/pyenv-virtualenvwrapper.git ~/.pyenv/plugins/pyenv-virtualenvwrapper

RUN echo 'export PYENV_ROOT="$HOME/.pyenv"' >> ~/.bashrc && \
    echo 'export PATH="$PYENV_ROOT/bin:$PATH"' >> ~/.bashrc && \
    echo 'eval "$(pyenv init -)"' >> ~/.bashrc && \
    echo 'pyenv virtualenvwrapper' >> ~/.bashrc

RUN pyenv install 3.7.4 && pyenv local 3.7.4 && pyenv global 3.7.4

# python packages
#RUN pip3 install --upgrade pip --user && \
	    #pip3 install -r /build_context/requirements.txt

WORKDIR /work

CMD ["bash"]
