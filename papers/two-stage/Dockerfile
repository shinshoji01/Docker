#FROM ubuntu:22.04
#FROM ubuntu:20.04

FROM tadeugr/ubuntu-python:3.6

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
	    libsndfile-dev \
	    #python3 \
	    #python3-pip \
	    sudo \
	    wget \
	    vim

# python packages
RUN pip3 install --upgrade pip && \
	    pip3 install -r /build_context/requirements.txt

#RUN pip3 install --upgrade pip 

ENV HOME /opt

WORKDIR /work

CMD ["bash"]
