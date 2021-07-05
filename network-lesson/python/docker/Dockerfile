#FROM nvidia/cuda:10.2-runtime-ubuntu18.04
FROM ubuntu:18.04

COPY . /build_context
WORKDIR /opt

ENV TZ Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
	    libsndfile-dev \
        libsndfile1 \
	    python3 \
	    python3-pip \
	    sudo \
	    wget \
	    vim

# python packages
RUN pip3 install --upgrade pip && \
	    pip3 install -r /build_context/requirements.txt

WORKDIR /work
